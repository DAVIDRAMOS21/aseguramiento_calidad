<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marca';

    public $timestamps = false;

    protected $fillable = [
        'nombre'
    ];

    public function equipos()
    {
        return $this->hasMany(Equipment::class, 'id_marca');
    }
}