<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class EmployeeRegistration extends Component
{
    use WithPagination;

    public $primer_nombre = '';
    public $segundo_nombre = '';
    public $primer_apellido = '';
    public $segundo_apellido = '';
    public $id_usuario = null;
    public $estado = 'activo';

    public $usuarios = [];

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
        $this->usuarios = User::orderBy('usuario')->get();
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

    public function rules()
    {
        $rules = [
            'primer_nombre' => 'required|string|max:50',
            'segundo_nombre' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'segundo_apellido' => 'required|string|max:50',
            'id_usuario' => 'nullable|exists:usuario,id|unique:empleado,id_usuario',
            'estado' => 'required|in:activo,inactivo,vacaciones'
        ];

        // Si está editando, permitir el mismo id_usuario
        if ($this->isEditing && $this->editingId) {
            $rules['id_usuario'] = 'nullable|exists:usuario,id|unique:empleado,id_usuario,' . $this->editingId;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'primer_nombre.required' => 'El primer nombre es obligatorio.',
            'segundo_nombre.required' => 'El segundo nombre es obligatorio.',
            'primer_apellido.required' => 'El primer apellido es obligatorio.',
            'segundo_apellido.required' => 'El segundo apellido es obligatorio.',
            'id_usuario.exists' => 'El usuario seleccionado no es válido.',
            'id_usuario.unique' => 'Este usuario ya está asignado a otro empleado.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }

    public function createEmployee()
    {
        // Verificar permisos
        if (!auth()->user()->is_admin && !auth()->user()->is_superuser) {
            $this->errorMessage = 'No tienes permisos para crear empleados.';
            return;
        }

        $this->resetErrorBag();
        $this->errorMessage = '';
        $this->successMessage = '';

        $validatedData = $this->validate();

        // Convert empty id_usuario to null
        if (empty($validatedData['id_usuario'])) {
            $validatedData['id_usuario'] = null;
        }

        try {
            DB::beginTransaction();

            if ($this->isEditing && $this->editingId) {
                // Verificar permisos de edición
                if (!$this->canEdit) {
                    $this->errorMessage = 'No tienes permisos para editar empleados.';
                    return;
                }

                $empleado = Empleado::findOrFail($this->editingId);
                $empleado->update($validatedData);
                $this->successMessage = 'Empleado actualizado exitosamente.';
            } else {
                Empleado::create($validatedData);
                $this->successMessage = 'Empleado registrado exitosamente.';
            }

            DB::commit();
            $this->resetForm();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = 'Error al guardar el empleado: ' . $e->getMessage();
        }
    }

    public function edit($id)
    {
        if (!$this->canEdit) {
            $this->errorMessage = 'No tienes permisos para editar empleados.';
            return;
        }

        $empleado = Empleado::findOrFail($id);

        $this->editingId = $id;
        $this->isEditing = true;
        $this->primer_nombre = $empleado->primer_nombre;
        $this->segundo_nombre = $empleado->segundo_nombre;
        $this->primer_apellido = $empleado->primer_apellido;
        $this->segundo_apellido = $empleado->segundo_apellido;
        $this->id_usuario = $empleado->id_usuario;
        $this->estado = $empleado->estado;
    }

    public function delete($id)
    {
        if (!$this->canDelete) {
            $this->errorMessage = 'Solo los superusuarios pueden eliminar empleados.';
            return;
        }

        try {
            DB::beginTransaction();

            $empleado = Empleado::findOrFail($id);

            // Verificar si tiene equipos asignados
            if ($empleado->equipos()->count() > 0) {
                $this->errorMessage = 'No se puede eliminar este empleado porque tiene equipos asignados.';
                return;
            }

            $empleado->delete();
            $this->successMessage = 'Empleado eliminado exitosamente.';

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = 'Error al eliminar el empleado: ' . $e->getMessage();
        }
    }

    public function cambiarEstado($id, $nuevoEstado)
    {
        if (!$this->canEdit) {
            $this->errorMessage = 'No tienes permisos para cambiar el estado de empleados.';
            return;
        }

        if (!in_array($nuevoEstado, ['activo', 'inactivo', 'vacaciones'])) {
            $this->errorMessage = 'Estado no válido.';
            return;
        }

        try {
            DB::beginTransaction();

            $empleado = Empleado::findOrFail($id);
            $empleado->estado = $nuevoEstado;
            $empleado->save();

            $this->successMessage = 'Estado del empleado actualizado a "' . ucfirst($nuevoEstado) . '".';

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->errorMessage = 'Error al cambiar el estado: ' . $e->getMessage();
        }
    }

    public function resetForm()
    {
        $this->reset([
            'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido',
            'id_usuario', 'estado', 'successMessage', 'errorMessage', 'editingId', 'isEditing'
        ]);

        $this->estado = 'activo';
        $this->resetErrorBag();
    }

    public function render()
    {
        $empleados = Empleado::with('usuario')
            ->orderBy('primer_nombre')
            ->paginate(10);

        return view('livewire.employee.employee-registration', [
            'empleados' => $empleados
        ])->layout('components.layouts.app');
    }
}
