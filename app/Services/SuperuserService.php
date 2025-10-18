<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperuserService
{
    /**
     * Validate superuser credentials
     */
    public static function validateCredentials(string $username, string $password): bool
    {
        return User::validateSuperuserCredentials($username, $password);
    }

    /**
     * Assign roles to a user with superuser validation
     */
    public static function assignRoles(User $user, array $roles, string $superuserUsername, string $superuserPassword): array
    {
        if (!self::validateCredentials($superuserUsername, $superuserPassword)) {
            return [
                'success' => false,
                'message' => 'Credenciales de super usuario inválidas'
            ];
        }

        $user->roles = $roles;
        $user->save();

        return [
            'success' => true,
            'message' => 'Roles asignados exitosamente'
        ];
    }

    /**
     * Add a single role to a user with superuser validation
     */
    public static function addRole(User $user, string $role, string $superuserUsername, string $superuserPassword): array
    {
        if (!self::validateCredentials($superuserUsername, $superuserPassword)) {
            return [
                'success' => false,
                'message' => 'Credenciales de super usuario inválidas'
            ];
        }

        $user->addRole($role);
        $user->save();

        return [
            'success' => true,
            'message' => "Rol '{$role}' agregado exitosamente"
        ];
    }

    /**
     * Remove a role from a user with superuser validation
     */
    public static function removeRole(User $user, string $role, string $superuserUsername, string $superuserPassword): array
    {
        if (!self::validateCredentials($superuserUsername, $superuserPassword)) {
            return [
                'success' => false,
                'message' => 'Credenciales de super usuario inválidas'
            ];
        }

        $user->removeRole($role);
        $user->save();

        return [
            'success' => true,
            'message' => "Rol '{$role}' removido exitosamente"
        ];
    }

    /**
     * Create a superuser
     */
    public static function createSuperuser(string $username, string $superuserUsername, string $superuserPassword): array
    {
        // Check if superuser username is unique
        if (User::where('superuser_username', $superuserUsername)->exists()) {
            return [
                'success' => false,
                'message' => 'El nombre de usuario del super usuario ya existe'
            ];
        }

        $user = User::where('usuario', $username)->first();
        
        if (!$user) {
            return [
                'success' => false,
                'message' => 'Usuario no encontrado'
            ];
        }

        $user->is_superuser = true;
        $user->superuser_username = $superuserUsername;
        $user->superuser_password = Hash::make($superuserPassword);
        $user->save();

        return [
            'success' => true,
            'message' => 'Super usuario creado exitosamente'
        ];
    }

    /**
     * Create a superuser with first superuser validation
     */
    public static function createSuperuserWithValidation(User $user, string $superuserUsername, string $superuserPassword, string $firstSuperuserUsername, string $firstSuperuserPassword): array
    {
        // Validate first superuser credentials
        if (!self::validateCredentials($firstSuperuserUsername, $firstSuperuserPassword)) {
            return [
                'success' => false,
                'message' => 'Las credenciales del primer super usuario son inválidas. Acceso denegado.'
            ];
        }

        // Check if the user is already a superuser
        if ($user->is_superuser) {
            return [
                'success' => false,
                'message' => 'Este usuario ya es un super usuario'
            ];
        }

        // Check if superuser username is unique
        if (User::where('superuser_username', $superuserUsername)->exists()) {
            return [
                'success' => false,
                'message' => 'El nombre de usuario del super usuario ya existe'
            ];
        }

        try {
            // Promote user to superuser
            $user->is_superuser = true;
            $user->superuser_username = $superuserUsername;
            $user->superuser_password = Hash::make($superuserPassword);
            
            // Keep existing roles and add admin role if not present
            $currentRoles = $user->roles ?? [];
            if (!in_array('admin', $currentRoles)) {
                $currentRoles[] = 'admin';
            }
            $user->roles = $currentRoles;
            
            $user->save();

            return [
                'success' => true,
                'message' => "Usuario '{$user->usuario}' ha sido promovido a Super Usuario exitosamente"
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al guardar el usuario: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Get the first superuser from database
     */
    public static function getFirstSuperuser(): ?User
    {
        return User::where('is_superuser', true)
                   ->whereNotNull('superuser_username')
                   ->whereNotNull('superuser_password')
                   ->orderBy('created_at', 'asc')
                   ->first();
    }

    /**
     * Check if there are any superusers in the system
     */
    public static function hasSuperusers(): bool
    {
        return User::where('is_superuser', true)->exists();
    }

    /**
     * Get available roles
     */
    public static function getAvailableRoles(): array
    {
        return [
            'admin',
            'manager', 
            'user',
            'viewer',
            'editor',
            'moderator'
        ];
    }
}