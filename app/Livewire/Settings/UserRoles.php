<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use App\Models\User;
use App\Services\SuperuserService;
use Illuminate\Support\Facades\Log;

class UserRoles extends Component
{
    public $users;
    public $selectedUserId;
    public $selectedRoles = [];
    public $superuserUsername = '';
    public $superuserPassword = '';
    public $showRoleModal = false;
    public $showCreateSuperuserModal = false;
    public $newSuperuserUsername = '';
    public $newSuperuserPassword = '';
    public $newSuperuserConfirmPassword = '';
    public $firstSuperuserUsername = '';
    public $firstSuperuserPassword = '';
    public $selectedUser = null;

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::all();
    }

    public function openRoleModal($userId)
    {
        $this->selectedUserId = $userId;
        $user = User::find($userId);
        $this->selectedRoles = $user->roles ?? [];
        $this->showRoleModal = true;
        $this->superuserUsername = '';
        $this->superuserPassword = '';
    }

    public function updateRoles()
    {
        // Clear previous errors
        $this->resetErrorBag();
        
        try {
            $this->validate([
                'superuserUsername' => 'required|min:3|max:50',
                'superuserPassword' => 'required|min:8|max:255',
            ], [
                'superuserUsername.required' => 'El nombre de usuario del super usuario es requerido.',
                'superuserUsername.min' => 'El nombre de usuario debe tener al menos 3 caracteres.',
                'superuserUsername.max' => 'El nombre de usuario no puede exceder 50 caracteres.',
                'superuserPassword.required' => 'La contraseña del super usuario es requerida.',
                'superuserPassword.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'superuserPassword.max' => 'La contraseña no puede exceder 255 caracteres.',
            ]);

            $user = User::find($this->selectedUserId);
            
            if (!$user) {
                $this->addError('superuser', 'El usuario seleccionado no existe.');
                return;
            }
            
            $result = SuperuserService::assignRoles(
                $user,
                $this->selectedRoles,
                $this->superuserUsername,
                $this->superuserPassword
            );

            if ($result['success']) {
                session()->flash('message', $result['message'] . " Usuario: {$user->usuario}");
                $this->loadUsers();
                $this->closeRoleModal();
                
            } else {
                $this->addError('superuser', $result['message']);
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation errors are automatically handled by Livewire
            throw $e;
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error updating user roles: ' . $e->getMessage(), [
                'user_id' => $this->selectedUserId,
                'roles' => $this->selectedRoles,
                'error' => $e->getTraceAsString()
            ]);
            
            $errorMessage = 'Ha ocurrido un error inesperado. Por favor, inténtalo de nuevo o contacta al administrador del sistema.';
            $this->addError('superuser', $errorMessage);
        }
    }

    public function closeRoleModal()
    {
        $this->showRoleModal = false;
        $this->selectedUserId = null;
        $this->selectedRoles = [];
        $this->superuserUsername = '';
        $this->superuserPassword = '';
        $this->resetErrorBag();
    }

    public function openCreateSuperuserModal()
    {
        $this->showCreateSuperuserModal = true;
        $this->newSuperuserUsername = '';
        $this->newSuperuserPassword = '';
        $this->newSuperuserConfirmPassword = '';
        $this->firstSuperuserUsername = '';
        $this->firstSuperuserPassword = '';
        $this->selectedUser = null;
    }

    public function createSuperuser()
    {
        // Clear previous errors
        $this->resetErrorBag();
        
        try {
            // Debug: Log the current values
            Log::info('Creating superuser attempt', [
                'selectedUserId' => $this->selectedUserId,
                'newSuperuserUsername' => $this->newSuperuserUsername,
                'newSuperuserPassword' => $this->newSuperuserPassword ? '[REDACTED]' : 'empty',
                'newSuperuserConfirmPassword' => $this->newSuperuserConfirmPassword ? '[REDACTED]' : 'empty',
                'firstSuperuserUsername' => $this->firstSuperuserUsername,
                'firstSuperuserPassword' => $this->firstSuperuserPassword ? '[REDACTED]' : 'empty'
            ]);

            // Validate all required fields
            $this->validate([
                'selectedUserId' => 'required|exists:usuario,id',
                'newSuperuserUsername' => 'required|min:3|max:50|regex:/^[a-zA-Z0-9_]+$/|unique:usuario,superuser_username',
                'newSuperuserPassword' => 'required|min:8|max:255',
                'newSuperuserConfirmPassword' => 'required|same:newSuperuserPassword',
                'firstSuperuserUsername' => 'required|min:3|max:50',
                'firstSuperuserPassword' => 'required|min:8|max:255',
            ], [
                'selectedUserId.required' => 'Debes seleccionar un usuario para promover.',
                'selectedUserId.exists' => 'El usuario seleccionado no existe.',
                'newSuperuserUsername.required' => 'El nombre de usuario del super usuario es requerido.',
                'newSuperuserUsername.min' => 'El nombre de usuario debe tener al menos 3 caracteres.',
                'newSuperuserUsername.max' => 'El nombre de usuario no puede exceder 50 caracteres.',
                'newSuperuserUsername.regex' => 'El nombre de usuario solo puede contener letras, números y guiones bajos.',
                'newSuperuserUsername.unique' => 'Este nombre de usuario del super usuario ya está en uso.',
                'newSuperuserPassword.required' => 'La contraseña del super usuario es requerida.',
                'newSuperuserPassword.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'newSuperuserPassword.max' => 'La contraseña no puede exceder 255 caracteres.',
                'newSuperuserConfirmPassword.required' => 'Debes confirmar la contraseña.',
                'newSuperuserConfirmPassword.same' => 'La confirmación de contraseña no coincide.',
                'firstSuperuserUsername.required' => 'El nombre de usuario del primer super usuario es requerido para autorizar esta acción.',
                'firstSuperuserUsername.min' => 'El nombre de usuario debe tener al menos 3 caracteres.',
                'firstSuperuserUsername.max' => 'El nombre de usuario no puede exceder 50 caracteres.',
                'firstSuperuserPassword.required' => 'La contraseña del primer super usuario es requerida para autorizar esta acción.',
                'firstSuperuserPassword.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'firstSuperuserPassword.max' => 'La contraseña no puede exceder 255 caracteres.',
            ]);

            Log::info('Validation passed, finding user');

            $user = User::find($this->selectedUserId);
            
            if (!$user) {
                Log::error('User not found', ['selectedUserId' => $this->selectedUserId]);
                $this->addError('create_superuser', 'El usuario seleccionado no existe.');
                return;
            }

            Log::info('User found, calling SuperuserService', ['user' => $user->usuario]);

            $result = SuperuserService::createSuperuserWithValidation(
                $user,
                $this->newSuperuserUsername,
                $this->newSuperuserPassword,
                $this->firstSuperuserUsername,
                $this->firstSuperuserPassword
            );

            Log::info('SuperuserService result', ['result' => $result]);

            if ($result['success']) {
                Log::info('Superuser creation successful');
                
                // Flash success message
                session()->flash('message', $result['message']);
                
                // Reload users to reflect changes
                $this->loadUsers();
                
                // Close the modal
                $this->closeCreateSuperuserModal();
                
            } else {
                Log::warning('Superuser creation failed', ['message' => $result['message']]);
                $this->addError('create_superuser', $result['message']);
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed', [
                'errors' => $e->errors(),
                'data' => [
                    'selectedUserId' => $this->selectedUserId,
                    'newSuperuserUsername' => $this->newSuperuserUsername,
                    'firstSuperuserUsername' => $this->firstSuperuserUsername
                ]
            ]);
            
            // Re-throw validation errors so they're shown in the UI
            throw $e;
            
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error creating superuser: ' . $e->getMessage(), [
                'user_id' => $this->selectedUserId,
                'superuser_username' => $this->newSuperuserUsername,
                'error' => $e->getTraceAsString()
            ]);
            
            $errorMessage = 'Ha ocurrido un error inesperado. Por favor, inténtalo de nuevo o contacta al administrador del sistema.';
            $this->addError('create_superuser', $errorMessage);
        }
    }

    public function closeCreateSuperuserModal()
    {
        $this->showCreateSuperuserModal = false;
        $this->selectedUserId = null;
        $this->newSuperuserUsername = '';
        $this->newSuperuserPassword = '';
        $this->newSuperuserConfirmPassword = '';
        $this->firstSuperuserUsername = '';
        $this->firstSuperuserPassword = '';
        $this->selectedUser = null;
        $this->resetErrorBag();
    }

    public function getAvailableRolesProperty()
    {
        return SuperuserService::getAvailableRoles();
    }

    public function getNormalUsersProperty()
    {
        return $this->users->filter(function ($user) {
            return !$user->is_superuser;
        });
    }

    public function updatedSelectedUserId($value)
    {
        if ($value) {
            $this->selectedUser = User::find($value);
        } else {
            $this->selectedUser = null;
        }
    }

    public function render()
    {
        return view('livewire.settings.user-roles');
    }
}
