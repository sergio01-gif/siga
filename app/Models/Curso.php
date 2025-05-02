<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 
        'codigo', 
        'descricao', 
        'duracao',
    ];

    // Relação: Um Curso tem muitas Turmas
    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    // ✅ Relação: Um Curso tem muitos Estudantes
    public function estudantes()
    {
        return $this->hasMany(Estudante::class);
    }

    public function cadeiras()
{
    return $this->belongsToMany(Cadeira::class, 'cadeira_curso', 'curso_id', 'cadeira_id');
}

}
