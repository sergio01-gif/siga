<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Função de login
    public function login(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|min:6',
        ]);

        // Tentativa de autenticação
        if (Auth::attempt(['email' => $request->email, 'password' => $request->senha])) {
            return redirect()->route('dashboard'); // Redireciona para o dashboard após login
        }

        // Caso falhe a autenticação
        return redirect()->route('login')->withErrors('Credenciais inválidas');
    }

    // Função de logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Função de registro
    public function register(Request $request)
    {
        // Validação do formulário de registro
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Criação de um novo usuário
        Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha), // Criptografa a senha
        ]);

        return redirect()->route('login')->with('success', 'Registro realizado com sucesso!');
    }

    // Função para exibir o formulário de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Função para exibir o formulário de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}
