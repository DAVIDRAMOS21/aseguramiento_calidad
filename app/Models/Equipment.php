<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipo';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'id_marca',
        'color',
        'valor',
        'serie',
        'extras',
        'tipo_alimentacion',
        'id_empleado',
        'estado',
        'tipo_elemento',
        'fecha_commit'
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'fecha_commit' => 'datetime',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($equipment) {
            if (empty($equipment->identificador)) {
                $equipment->identificador = static::generateCorrelative($equipment->tipo_elemento);
            }
        });
    }

    private static function generateCorrelative($tipoElemento)
    {
        $prefixes = [
            'informatica' => 'INF',
            'mobiliario' => 'MOB',
            'oficina' => 'OFI',
            'otros' => 'OTR'
        ];

        $prefix = $prefixes[$tipoElemento] ?? 'EQU';

        $lastEquipment = static::where('tipo_elemento', $tipoElemento)
                              ->where('identificador', 'LIKE', $prefix . '-%')
                              ->orderBy('id', 'desc')
                              ->first();

        if ($lastEquipment) {
            $lastNumber = (int) str_replace($prefix . '-', '', $lastEquipment->identificador);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix . '-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}