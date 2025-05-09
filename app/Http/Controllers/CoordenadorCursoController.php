<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;
use App\Models\Cadeira;
use App\Models\Estagio;
use App\Models\Mensalidade;

class CoordenadorCursoController extends Controller
{
    /**
     * Exibe o dashboard do Coordenador de Curso.
     */
    public function index()
    {
        $usuario = Auth::user();

        // Confirma se o usuário está autenticado e é coordenador de curso
        if (!$usuario || $usuario->tipo_usuario !== 'coordenador_de_curso') {
            return redirect()->route('login')->with('error', 'Acesso não autorizado.');
        }

        // Verifica se há um curso vinculado a este coordenador
        $curso = Curso::where('coordenador_id', $usuario->id)->first();

        if (!$curso) {
            return redirect()->route('coordenador_curso.dashboard')->with('error', 'Nenhum curso associado a este coordenador.');

        }

        // Dados relacionados ao curso
        $cadeiras = Cadeira::where('curso_id', $curso->id)->get();
        $estagios = Estagio::where('curso_id', $curso->id)->get();
        $mensalidades = Mensalidade::where('curso_id', $curso->id)->get();

        return view('coordenador_curso.dashboard', compact(
            'usuario', 'curso', 'cadeiras', 'estagios', 'mensalidades'
        ));
    }
}
