<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnoAcademico extends Model
{
    protected $fillable = ['ano_inicio', 'ano_fim', 'estado'];

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}
