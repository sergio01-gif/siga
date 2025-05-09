<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnoAcademico extends Model
{
    use HasFactory;

    protected $table = 'anos_academicos';

    protected $fillable = [
        'nome',
        'inicio',
        'fim',
    ];

    /**
     * Relacionamento com turmas.
     * Um ano acadêmico pode ter várias turmas.
     */
    public function turmas()
    {
        return $this->hasMany(Turma::class, 'ano_academico_id');
    }
}
