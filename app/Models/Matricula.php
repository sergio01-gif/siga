<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $fillable = [
        'estudante_id',
        'turma_id',
        'ano_academico_id',
        'curso_id',
        'data_matricula',
        'estado',
        
    ];
    // Adicionando o cast para a coluna data_matricula
    protected $casts = [
        'data_matricula' => 'datetime',
    ];

    

    public function estudante()
    {
        return $this->belongsTo(Estudante::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function anoAcademico()
    {
        return $this->belongsTo(AnoAcademico::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
