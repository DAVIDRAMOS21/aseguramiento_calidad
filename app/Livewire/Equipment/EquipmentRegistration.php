<?php

namespace App\Livewire\Equipment;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Equipment;
use App\Models\Marca;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;

class EquipmentRegistration extends Component
{
    use WithPagination;

    public $nombre = '';
    public $tipo_elemento = 'informatica';
    public $id_marca = '';
    public $nueva_marca = '';
    public $mostrar_nueva_marca = false;
    public $color = '';
    public $valor = '';
    public $serie = '';
    public $extras = '';
    public $tipo_alimentacion = 'ninguna';
    public $id_empleado = null;
    public $estado = 'activo';

    public $marcas = [];
    public $empleados = [];

    public $successMessage = '';
    public $errorMessage = '';

    // Para edición
    public $editingId = null;
    public $isEditing = false;

    // Permisos
    public $canEdit = false;
    public $canDelete = false;

    public function mount()
    {
        $this->marcas = Marca::orderBy('nombre')->get();
        $this->empleados = Empleado::orderBy('primer_nombre')->get();
        $this->checkPermissions();
    }

    public function checkPermissions()
    {
        $user = auth()->user();
        // Administradores y superusuarios pueden editar
        $this->canEdit = $user->is_admin || $user->is_superuser;
        // Solo superusuarios pueden eliminar
        $this->canDelete = $user->is_superuser;
    }

    public function updatedIdMarca($value)
    {
        // Si selecciona "Otros", mostrar campo para nueva marca
        $marca = Marca::find($value);
        if ($marca && strtolower($marca->nombre) === 'otros') {
            $this->mostrar_nueva_marca = true;
        } else {
            $this->mostrar_nueva_marca = false;
            $this->nueva_marca = '';
        }
    }

    public function rules()
    {
        $rules = [
            'nombre' => 'required|string|max:50',
            'tipo_elemento' => 'required|in:informatica,mobiliario,oficina,otros',
            'id_marca' => 'required|exists:marca,id',
            'color' => 'required|string|max:50',
            'valor' => 'required|numeric|min:0',
            'serie' => 'required|string|max:50|unique:equipo,serie',
            'extras' => 'nullable|string',
            'tipo_alimentacion' => 'required|in:110v,220v,diesel,regular,super,bateria,ninguna',
            'id_empleado' => 'nullable|exists:empleado,id',
            'estado' => 'required|in:activo,inactivo,mantenimiento,suspendido'
        ];

        // Si está editando, permitir el mismo número de serie
        if ($this->isEditing && $this->editingId) {
            $rules['serie'] = 'required|string|max:50|unique:equipo,serie,' . $this->editingId;
        }

        // Si mostrar_nueva_marca es true, la nueva marca es requerida
        if ($this->mostrar_nueva_marca) {
            $rules['nueva_marca'] = 'required|string|max:50|unique:marca,nombre';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del equipo es obligatorio.',
            'tipo_elemento.required' => 'Debe seleccionar un tipo de elemento.',
            'tipo_elemento.in' => 'El tipo de elemento seleccionado no es válido.',
            'id_marca.required' => 'Debe seleccionar una marca.',
            'id_marca.exists' => 'La marca seleccionada no es válida.',
            'nueva_marca.required' => 'Debe ingresar el nombre de la nueva marca.',
            'nueva_marca.unique' => 'Esta marca ya existe en el sistema.',
            'color.required' => 'El color es obligatorio.',
            'valor.required' => 'El valor es obligatorio.',
            'valor.numeric' => 'El valor debe ser un número.',
            'valor.min' => 'El valor no puede ser negativo.',
            'serie.required' => 'El número de serie es obligatorio.',
            'serie.unique' => 'Este número de serie ya está registrado.',
            'tipo_alimentacion.required' => 'Debe seleccionar un tipo de alimentación.',
            'id_empleado.exists' => 'El empleado seleccionado no es válido.'
        ];
    }

    public function createEquipment()
    {
        $this->resetErrorBag();
        $this->errorMessage = '';
        $this->successMessage = '';

        $validatedData = $this->validate();

        // Convert empty id_empleado to null
        if (empty($validatedData['id_empleado'])) {
            $validatedData['id_empleado'] = null;
        }

        try {
            DB::beginTransaction();

            // Si se ingresó una nueva marca, crearla primero
            if ($this->mostrar_nueva_marca && !empty($this->nueva_marca)) {
                $nuevaMarca = Marca::create(['nombre' => ucfirst(trim($this->nueva_marca))]);
                $validatedData['id_marca'] = $nuevaMarca->id;

                // Actualizar la lista de marcas
                $this->marcas = Marca::orderBy('nombre')->get();
            }

            // Remover nueva_marca del array de datos validados
            unset($validatedData['nueva_marca']);

            if ($this->isEditing && $this->editingId) {
                // Verificar permisos de edición
                if (!$this->canEdit) {
                    $this->errorMessage = 'No tienes permisos para editar equipos.';
                    return;
                }

                $equipment = Equipment::findOrFail($this->editingId);
                $equipment->update($validatedData);
                $this->successMessage = 'Equipo actualizado exitosamente.';
            } else {
                $equipment = Equipment::create($validatedData);
                $this->successMessage = 'Equipo registrado exitosamente con identificador: ' . $equipment->identificador;
            }

            DB::commit();
            $this->resetForm();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = 'Error al guardar el equipo: ' . $e->getMessage();
        }
    }

    public function edit($id)
    {
        if (!$this->canEdit) {
            $this->errorMessage = 'No tienes permisos para editar equipos.';
            return;
        }

        $equipment = Equipment::findOrFail($id);

        $this->editingId = $id;
        $this->isEditing = true;
        $this->nombre = $equipment->nombre;
        $this->tipo_elemento = $equipment->tipo_elemento;
        $this->id_marca = $equipment->id_marca;
        $this->color = $equipment->color;
        $this->valor = $equipment->valor;
        $this->serie = $equipment->serie;
        $this->extras = $equipment->extras;
        $this->tipo_alimentacion = $equipment->tipo_alimentacion;
        $this->id_empleado = $equipment->id_empleado;
        $this->estado = $equipment->estado;
    }

    public function delete($id)
    {
        if (!$this->canDelete) {
            $this->errorMessage = 'Solo los superusuarios pueden eliminar equipos.';
            return;
        }

        try {
            DB::beginTransaction();

            $equipment = Equipment::findOrFail($id);
            $equipment->delete();
            $this->successMessage = 'Equipo eliminado exitosamente.';

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = 'Error al eliminar el equipo: ' . $e->getMessage();
        }
    }

    public function cambiarEstado($id, $nuevoEstado)
    {
        if (!$this->canEdit) {
            $this->errorMessage = 'No tienes permisos para cambiar el estado de equipos.';
            return;
        }

        if (!in_array($nuevoEstado, ['activo', 'inactivo', 'mantenimiento', 'suspendido'])) {
            $this->errorMessage = 'Estado no válido.';
            return;
        }

        try {
            DB::beginTransaction();

            $equipment = Equipment::findOrFail($id);
            $equipment->estado = $nuevoEstado;
            $equipment->save();

            $this->successMessage = 'Estado del equipo actualizado a "' . ucfirst($nuevoEstado) . '".';

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = 'Error al cambiar el estado: ' . $e->getMessage();
        }
    }

    public function asignarEmpleado($equipoId, $empleadoId)
    {
        if (!$this->canEdit) {
            $this->errorMessage = 'No tienes permisos para asignar equipos.';
            return;
        }

        try {
            DB::beginTransaction();

            $equipment = Equipment::findOrFail($equipoId);
            $equipment->id_empleado = $empleadoId === '' ? null : $empleadoId;
            $equipment->save();

            if ($empleadoId) {
                $empleado = Empleado::find($empleadoId);
                $this->successMessage = 'Equipo asignado a ' . $empleado->nombre_completo;
            } else {
                $this->successMessage = 'Equipo desasignado exitosamente.';
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = 'Error al asignar el equipo: ' . $e->getMessage();
        }
    }

    public function resetForm()
    {
        $this->reset([
            'nombre', 'tipo_elemento', 'id_marca', 'nueva_marca', 'mostrar_nueva_marca',
            'color', 'valor', 'serie', 'extras', 'tipo_alimentacion', 'id_empleado',
            'estado', 'successMessage', 'errorMessage', 'editingId', 'isEditing'
        ]);

        $this->tipo_elemento = 'informatica';
        $this->tipo_alimentacion = 'ninguna';
        $this->id_empleado = null;
        $this->estado = 'activo';
        $this->mostrar_nueva_marca = false;
        $this->resetErrorBag();

        // Recargar marcas y empleados
        $this->marcas = Marca::orderBy('nombre')->get();
        $this->empleados = Empleado::orderBy('primer_nombre')->get();
    }

    public function render()
    {
        $equipos = Equipment::with(['marca', 'empleado'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.equipment.equipment-registration', [
            'equipos' => $equipos
        ])->layout('components.layouts.app');
    }
}