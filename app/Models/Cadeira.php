<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cadeira extends Model
{
    use HasFactory;

    // Campos preenchíveis para o modelo Cadeira
    protected $fillable = [
        'nome',
        'carga_horaria',
        'semestre',
        'descricao',
        'estado',
    ];

    /**
     * Relacionamento muitos-para-muitos com o modelo Curso.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'cadeira_curso', 'cadeira_id', 'curso_id');
    }

    public function professores()
{
    return $this->belongsToMany(Professor::class, 'cadeira_professor')
                ->withPivot('turma_id')
                ->withTimestamps();
}

}
