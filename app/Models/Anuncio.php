<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    // Permitir preenchimento em massa desses campos
    protected $fillable = [
        'titulo',
        'conteudo',
        'destinatarios',     // pode ser: todos, estudantes, professores, admin
        'data_publicacao',
        'ativo',             // booleano: true (ativo), false (inativo)
    ];

    // Casts automáticos para facilitar leitura dos dados
    protected $casts = [
        'data_publicacao' => 'date',
        'ativo' => 'boolean',
    ];
}
