<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/auth/login",
     *     summary="Logear al estudiante",
     *     tags={"Estudiante"},
     *     @OA\Response(
     *         response=200,
     *         description="Registro de estudiantes"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'registro' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscar estudiante por número de registro
        $estudiante = Estudiante::where('registro', $request->registro)->first();

        if (!$estudiante || !$estudiante->user) {
            throw ValidationException::withMessages([
                'registro' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // Verificar contraseña
        if (!Hash::check($request->password, $estudiante->user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // Crear token
        $token = $estudiante->user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'token' => $token,
            'user' => [
                'id' => $estudiante->user->id,
                'name' => $estudiante->user->name,
                'email' => $estudiante->user->email,
            ],
            'estudiante' => [
                'id' => $estudiante->id,
                'registro' => $estudiante->registro,
                'nombre' => $estudiante->nombre,
                'email' => $estudiante->email,
                'telefono' => $estudiante->telefono,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout exitoso'
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user();
        $estudiante = $user->estudiante;

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'estudiante' => $estudiante ? [
                'id' => $estudiante->id,
                'registro' => $estudiante->registro,
                'nombre' => $estudiante->nombre,
                'email' => $estudiante->email,
                'telefono' => $estudiante->telefono,
            ] : null
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['La contraseña actual es incorrecta.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'message' => 'Contraseña actualizada exitosamente'
        ]);
    }
}
