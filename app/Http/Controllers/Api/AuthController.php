<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function cadastrar(Request $request)
    {
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique((new User)->getTable(), 'email'),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $usuario = User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => Hash::make($dados['password']),
            'tipo' => 'cliente',
            'status' => 'ativo',
        ]);

        $token = $usuario->createToken('vandala-flutter')->plainTextToken;

        return response()->json([
            'mensagem' => 'Conta criada com sucesso!',
            'token' => $token,
            'usuario' => $usuario,
        ], 201);
    }


    public function login(Request $request)
    {
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $usuario = User::where('email', $dados['email'])->first();

        if (
            !$usuario ||
            !Hash::check($dados['password'], $usuario->password)
        ) {
            return response()->json([
                'mensagem' => 'E-mail ou senha inválidos.',
            ], 401);
        }

        if ($usuario->status !== 'ativo') {
            return response()->json([
                'mensagem' => 'Esta conta está inativa.',
            ], 403);
        }

        $token = $usuario->createToken('vandala-flutter')->plainTextToken;

        return response()->json([
            'mensagem' => 'Login realizado com sucesso!',
            'token' => $token,
            'usuario' => $usuario,
        ]);
    }


    public function usuarioAutenticado(Request $request)
    {
        return response()->json([
            'usuario' => $request->user(),
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken();

        if ($token && method_exists($token, 'delete')) {
            $token->delete();
        }

        return response()->json([
            'mensagem' => 'Logout realizado com sucesso!',
        ]);
    }
}
