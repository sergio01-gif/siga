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
    return $this->belongsTo(\App\Models\AnoAcademico::class, 'ano_academico_id', 'id');
}


    public function professores()
{
    return $this->belongsToMany(Professor::class, 'cadeira_professor')
                ->with('cadeiras');
}

public function estudantes()
{
    return $this->hasMany(Estudante::class);
}


}
