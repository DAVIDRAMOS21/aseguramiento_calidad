<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    
    protected $primaryKey = 'id';
    
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'dpi',
        'usuario',
        'is_admin',
        'password',
        'fecha_commit',
        'is_superuser',
        'superuser_username',
        'superuser_password',
        'roles',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'superuser_password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_admin' => 'boolean',
            'is_superuser' => 'boolean',
            'fecha_commit' => 'datetime',
            'roles' => 'array',
        ];
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the user's full name
     */
    public function getNameAttribute(): string
    {
        return trim(($this->nombres ?? '') . ' ' . ($this->apellidos ?? '')) ?: $this->usuario;
    }

    /**
     * Alias for is_superuser (Spanish compatibility)
     */
    public function getEsSuperusuarioAttribute(): bool
    {
        return $this->is_superuser;
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        if ($this->nombres && $this->apellidos) {
            $nombres = explode(' ', $this->nombres);
            $apellidos = explode(' ', $this->apellidos);
            $firstNameInitial = substr($nombres[0], 0, 1);
            $firstSurnameInitial = substr($apellidos[0], 0, 1);
            return strtoupper($firstNameInitial . $firstSurnameInitial);
        }

        return Str::of($this->usuario)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Generate username from names
     */
    public static function generateUsername(string $nombres, string $apellidos): string
    {
        // Clean and normalize names
        $nombres = Str::ascii($nombres);
        $apellidos = Str::ascii($apellidos);
        
        // Get first name and first surname
        $firstName = Str::of($nombres)->explode(' ')->first();
        $firstSurname = Str::of($apellidos)->explode(' ')->first();
        
        // Create base username: first name + first surname
        $baseUsername = Str::lower($firstName . '.' . $firstSurname);
        
        // Remove special characters and spaces
        $baseUsername = preg_replace('/[^a-z0-9.]/', '', $baseUsername);
        
        // Check if username exists
        $username = $baseUsername;
        $counter = 1;
        
        while (static::where('usuario', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }
        
        return $username;
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles ?? []);
    }

    /**
     * Add a role to the user
     */
    public function addRole(string $role): void
    {
        $roles = $this->roles ?? [];
        if (!in_array($role, $roles)) {
            $roles[] = $role;
            $this->roles = $roles;
        }
    }

    /**
     * Remove a role from the user
     */
    public function removeRole(string $role): void
    {
        $roles = $this->roles ?? [];
        $this->roles = array_values(array_filter($roles, fn($r) => $r !== $role));
    }

    /**
     * Validate superuser credentials
     */
    public static function validateSuperuserCredentials(string $username, string $password): bool
    {
        $superuser = static::where('superuser_username', $username)
                          ->where('is_superuser', true)
                          ->first();
                          
        if (!$superuser) {
            return false;
        }
        
        return Hash::check($password, $superuser->superuser_password);
    }
}
