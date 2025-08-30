<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string|max:50|unique:usuario,usuario',
            'password' => 'required|string|min:6|confirmed',
            'is_admin' => 'boolean',
        ]);

        $user = User::create([
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin ?? false,
            'fecha_commit' => now(),
        ]);

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => [
                'id' => $user->id,
                'usuario' => $user->usuario,
                'is_admin' => $user->is_admin,
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])) {
            $user = Auth::user();
            return response()->json([
                'message' => 'Login exitoso',
                'user' => [
                    'id' => $user->id,
                    'usuario' => $user->usuario,
                    'is_admin' => $user->is_admin,
                ]
            ]);
        }

        throw ValidationException::withMessages([
            'usuario' => ['Las credenciales proporcionadas son incorrectas.'],
        ]);
    }

    public function logout()
    {
        Auth::logout();
        
        return response()->json([
            'message' => 'Logout exitoso'
        ]);
    }
}