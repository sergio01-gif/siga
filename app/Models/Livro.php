<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'categoria',
        'codigo_exemplar',
        'quantidade_total',
        'quantidade_disponivel',
        'ano_publicacao',
        'editora',
        'estado'
    ];
}
