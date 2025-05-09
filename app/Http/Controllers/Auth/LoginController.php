<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // Validação dos dados do formulário
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirecionamento baseado no tipo de usuário
            switch ($user->tipo_usuario) {
                case 'estudante':
                    return redirect()->route('estudantes.dashboard');
            
                case 'admin':
                    return redirect()->route('admin.dashboard');
            
                case 'professor':
                    return redirect()->route('professores.dashboard');
            
                case 'secretaria':
                    return redirect()->route('secretaria.dashboard');
            
                case 'coordenador_estagio':
                    return redirect()->route('coordenador_estagio.dashboard');

                case 'coordenador_de_curso':
                    return redirect()->route('coordenador_curso.dashboard');
            
                case 'bibliotecario':
                    return redirect()->route('biblioteca.dashboard');
            
            

                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'email' => 'Tipo de usuário não autorizado.',
                    ]);
            }
        }

        // Autenticação falhou
        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas não são válidas.'],
        ]);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
