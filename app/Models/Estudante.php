<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'genero',
        'morada',
        'tipo_documento',
        'numero_documento',
        'curso_id',
        'turma_id',
        'ano_lectivo_id',
        'foto',
        'estado',
    ];

    // Relacionamentos
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function ano_lectivo()
    {
        return $this->belongsTo(AnoAcademico::class, 'ano_lectivo_id');
    }

    public function mensalidades()
    {
        return $this->hasMany(Mensalidade::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
