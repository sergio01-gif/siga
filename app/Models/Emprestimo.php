<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $fillable = [
        'livro_id',
        'estudante_id',
        'data_emprestimo',
        'data_devolucao_prevista',
        'data_devolucao_real',
        'estado'
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function estudante()
    {
        return $this->belongsTo(Estudante::class);
    }
}
