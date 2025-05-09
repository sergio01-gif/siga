<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoordenadorCurso extends Model
{
    use HasFactory;

    protected $table = 'coordenador_cursos'; // se o nome da tabela não for o plural Laravel padrão

    protected $fillable = [
        'user_id',
        'curso_id',
    ];

    // Relação com usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    // Relação com curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
