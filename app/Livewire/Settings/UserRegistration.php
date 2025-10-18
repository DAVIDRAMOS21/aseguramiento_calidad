<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserRegistration extends Component
{
    public $nombres = '';
    public $apellidos = '';
    public $email = '';
    public $telefono = '';
    public $dpi = '';
    public $usuario = '';
    public $password = '';
    public $password_confirmation = '';
    public $is_admin = false;
    public $is_superuser = false;
    public $superuser_username = '';
    public $superuser_password = '';
    public $superuser_password_confirmation = '';
    public $use_same_password = false;
    public $roles = [];
    
    public $successMessage = '';
    public $errorMessage = '';
    
    public $availableRoles = [
        'supervisor',
        'operador',
        'consultor',
        'auditor'
    ];

    protected function rules()
    {
        $rules = [
            'nombres' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'apellidos' => ['required', 'string', 'min:2', 'max:100', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'email' => ['required', 'email', 'max:150', Rule::unique('usuario', 'email')],
            'telefono' => ['nullable', 'string', 'regex:/^[0-9]{4}\s[0-9]{4}$/'],
            'dpi' => ['required', 'string', 'regex:/^[0-9]{4}\s[0-9]{5}\s[0-9]{4}$/', Rule::unique('usuario', 'dpi')],
            'password' => 'required|string|min:6|confirmed',
            'is_admin' => 'boolean',
            'is_superuser' => 'boolean',
            'roles' => 'array',
            'roles.*' => 'string|in:' . implode(',', $this->availableRoles),
        ];

        if ($this->is_superuser) {
            $rules['superuser_username'] = ['required', 'string', 'min:3', 'max:100', Rule::unique('usuario', 'superuser_username')];
            $rules['use_same_password'] = 'boolean';
            
            if (!$this->use_same_password) {
                $rules['superuser_password'] = 'required|string|min:8|confirmed';
            }
        }

        return $rules;
    }

    protected $messages = [
        'nombres.required' => 'Los nombres son obligatorios.',
        'nombres.min' => 'Los nombres deben tener al menos 2 caracteres.',
        'nombres.max' => 'Los nombres no pueden tener más de 100 caracteres.',
        'nombres.regex' => 'Los nombres solo pueden contener letras y espacios.',
        'apellidos.required' => 'Los apellidos son obligatorios.',
        'apellidos.min' => 'Los apellidos deben tener al menos 2 caracteres.',
        'apellidos.max' => 'Los apellidos no pueden tener más de 100 caracteres.',
        'apellidos.regex' => 'Los apellidos solo pueden contener letras y espacios.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'Ingrese un correo electrónico válido.',
        'email.unique' => 'Este correo electrónico ya está registrado.',
        'telefono.regex' => 'El teléfono debe tener el formato: 1234 5678 (8 dígitos con espacio).',
        'dpi.required' => 'El DPI es obligatorio.',
        'dpi.regex' => 'El DPI debe tener el formato: 1234 56789 1019 (13 dígitos con espacios).',
        'dpi.unique' => 'Este DPI ya está registrado.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        'password.confirmed' => 'La confirmación de contraseña no coincide.',
        'superuser_username.required' => 'El nombre de superusuario es obligatorio.',
        'superuser_username.unique' => 'Este nombre de superusuario ya está en uso.',
        'superuser_username.min' => 'El nombre de superusuario debe tener al menos 3 caracteres.',
        'superuser_password.required' => 'La contraseña de superusuario es obligatoria.',
        'superuser_password.min' => 'La contraseña de superusuario debe tener al menos 8 caracteres.',
        'superuser_password.confirmed' => 'La confirmación de contraseña de superusuario no coincide.',
        'roles.*.in' => 'Uno o más roles seleccionados no son válidos.',
    ];

    public function generateUsername()
    {
        if (!empty($this->nombres) && !empty($this->apellidos)) {
            $this->usuario = User::generateUsername($this->nombres, $this->apellidos);
        }
    }

    public function updatedNombres()
    {
        $this->generateUsername();
    }

    public function updatedApellidos()
    {
        $this->generateUsername();
    }

    public function updatedDpi()
    {
        // Format DPI automatically: 1234567891019 -> 1234 56789 1019
        $dpi = preg_replace('/[^0-9]/', '', $this->dpi);
        if (strlen($dpi) >= 13) {
            $dpi = substr($dpi, 0, 13);
            $this->dpi = substr($dpi, 0, 4) . ' ' . substr($dpi, 4, 5) . ' ' . substr($dpi, 9, 4);
        } else if (strlen($dpi) >= 9) {
            $this->dpi = substr($dpi, 0, 4) . ' ' . substr($dpi, 4, 5) . ' ' . substr($dpi, 9);
        } else if (strlen($dpi) >= 4) {
            $this->dpi = substr($dpi, 0, 4) . ' ' . substr($dpi, 4);
        } else {
            $this->dpi = $dpi;
        }
    }

    public function updatedTelefono()
    {
        // Format phone: 12345678 -> 1234 5678 (only 8 digits with space)
        $phone = preg_replace('/[^0-9]/', '', $this->telefono);
        if (strlen($phone) >= 8) {
            $phone = substr($phone, 0, 8);
            $this->telefono = substr($phone, 0, 4) . ' ' . substr($phone, 4, 4);
        } else if (strlen($phone) >= 4) {
            $this->telefono = substr($phone, 0, 4) . ' ' . substr($phone, 4);
        } else {
            $this->telefono = $phone;
        }
    }

    public function createUser()
    {
        try {
            // Generate username automatically if not set
            if (empty($this->usuario) && !empty($this->nombres) && !empty($this->apellidos)) {
                $this->usuario = User::generateUsername($this->nombres, $this->apellidos);
            }

            // Log para debug
            Log::info('Iniciando creación de usuario', [
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'email' => $this->email,
                'usuario' => $this->usuario,
                'is_admin' => $this->is_admin,
                'is_superuser' => $this->is_superuser,
                'roles' => $this->roles
            ]);

            $this->validate();

            $userData = [
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'dpi' => $this->dpi,
                'usuario' => $this->usuario,
                'password' => Hash::make($this->password),
                'is_admin' => $this->is_admin,
                'is_superuser' => $this->is_superuser,
                'roles' => $this->roles,
                'fecha_commit' => now(),
            ];

            if ($this->is_superuser) {
                $userData['superuser_username'] = $this->superuser_username;
                
                if ($this->use_same_password) {
                    $userData['superuser_password'] = Hash::make($this->password);
                } else {
                    $userData['superuser_password'] = Hash::make($this->superuser_password);
                }
            }

            Log::info('Datos del usuario a crear', $userData);

            $user = User::create($userData);

            Log::info('Usuario creado', ['user_id' => $user->id]);

            $this->successMessage = 'Usuario "' . $this->nombres . ' ' . $this->apellidos . '" (usuario: ' . $this->usuario . ') creado exitosamente.';
            $this->errorMessage = '';
            
            // No resetear el form inmediatamente para que se vea el mensaje
            // $this->resetForm();
            $this->dispatch('user-created');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación al crear usuario', [
                'errors' => $e->errors(),
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos
            ]);
            throw $e;
        } catch (\Exception $e) {
            $this->errorMessage = 'Error al crear el usuario: ' . $e->getMessage();
            $this->successMessage = '';
            Log::error('Error creating user: ' . $e->getMessage(), [
                'nombres' => $this->nombres,
                'apellidos' => $this->apellidos,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function resetForm()
    {
        $this->reset([
            'nombres',
            'apellidos',
            'email',
            'telefono',
            'dpi',
            'usuario',
            'password',
            'password_confirmation',
            'is_admin',
            'is_superuser',
            'superuser_username',
            'superuser_password',
            'superuser_password_confirmation',
            'use_same_password',
            'roles',
            'successMessage',
            'errorMessage'
        ]);
    }

    public function updatedIsSuperuser()
    {
        if (!$this->is_superuser) {
            $this->superuser_username = '';
            $this->superuser_password = '';
            $this->superuser_password_confirmation = '';
            $this->use_same_password = false;
        }
    }

    public function updatedUseSamePassword()
    {
        if ($this->use_same_password) {
            $this->superuser_password = '';
            $this->superuser_password_confirmation = '';
        }
    }

    public function render()
    {
        return view('livewire.settings.user-registration');
    }
}