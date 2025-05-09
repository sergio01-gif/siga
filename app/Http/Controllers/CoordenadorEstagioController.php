<?php

namespace App\Http\Controllers;

use App\Models\Estagio;
use App\Models\Estudante;
use App\Models\Usuario;
use App\Models\Cadeira;
use App\Models\Nota;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoordenadorEstagioController extends Controller
{
    public function index()
    {
        $estagios = Estagio::with(['estudante', 'supervisor'])->latest()->paginate(10);
        return view('coordenador_estagio.index', compact('estagios'));
    }

    public function create()
    {
        $estudantes = Estudante::all();
        $supervisores = Usuario::where('tipo', 'supervisor')->get(); // ajuste conforme sua lógica
        return view('coordenador_estagio.create', compact('estudantes', 'supervisores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'estudante_id' => 'required|exists:estudantes,id',
            'supervisor_id' => 'nullable|exists:usuarios,id',
            'status' => 'required|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);

        Estagio::create($request->all());

        return redirect()->route('coordenador_estagio.index')->with('success', 'Estágio criado com sucesso!');
    }

    public function show($id)
    {
        $estagio = Estagio::with(['estudante', 'supervisor'])->findOrFail($id);
        return view('coordenador_estagio.show', compact('estagio'));
    }

    public function dashboard()
    {
        $usuario = Auth::user();

        // Verifica se é realmente um professor
        if ($usuario->tipo_usuario !== 'professor') {
            abort(403, 'Acesso não autorizado');
        }

        // Busca o professor vinculado ao usuário
        $professor = $usuario->professor()->first();

        // Busca as cadeiras (disciplinas) que ele leciona
        $cadeiras = Cadeira::with('turma')
            ->where('professor_id', $professor->id)
            ->get();

        // Busca as turmas associadas às cadeiras
        $turmas = Turma::whereIn('id', $cadeiras->pluck('turma_id'))->get();

        // Total de estudantes nas turmas do professor
        $totalEstudantes = Estudante::whereIn('turma_id', $turmas->pluck('id'))->count();

        // Total de notas lançadas nas cadeiras do professor
        $totalNotas = Nota::whereIn('cadeira_id', $cadeiras->pluck('id'))->count();

        return view('professores.dashboard', compact(
            'professor',
            'cadeiras',
            'turmas',
            'totalEstudantes',
            'totalNotas'
        ));
    }
}
