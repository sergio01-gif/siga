<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EstudantesExport implements FromView
{
    protected $estudantes;
    protected $config;
    protected $curso;
    protected $turma;
    protected $usuario;

    public function __construct($estudantes, $config, $curso, $turma, $usuario)
    {
        $this->estudantes = $estudantes;
        $this->config = $config;
        $this->curso = $curso;
        $this->turma = $turma;
        $this->usuario = $usuario;
    }

    public function view(): View
    {
        return view('estudantes.exports.pdf', [
            'estudantes' => $this->estudantes,
            'config' => $this->config,
            'curso' => $this->curso,
            'turma' => $this->turma,
            'usuario' => $this->usuario,
            'dataExportacao' => now()->format('d/m/Y H:i')
        ]);
    }
}
