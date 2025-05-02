<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'curso_id', 'ano_academico_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function anoAcademico()
    {
        return $this->belongsTo(AnoAcademico::class);
    }

    public function professores()
{
    return $this->belongsToMany(Professor::class, 'cadeira_professor')
                ->with('cadeiras');
}

}
