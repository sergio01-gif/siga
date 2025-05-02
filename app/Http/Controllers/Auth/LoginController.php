<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Processa o login
    public function login(Request $request)
    {
        // Valida os dados do formulário de login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Tenta autenticar com os dados fornecidos
        $credentials = $request->only('email', 'password');

        // Verifica se a autenticação foi bem-sucedida
        if (Auth::attempt($credentials)) {
            // O login foi bem-sucedido, redireciona o usuário para o destino desejado
            return redirect()->intended(route('dashboard'));
        }

        // Se a autenticação falhar, retorna erro
        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas não são válidas.'],
        ]);
    }

    // Desfaz o login
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
