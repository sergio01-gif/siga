<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaLivro extends Model
{
    use HasFactory;

    // Define a tabela associada ao modelo
    protected $table = 'categorias_livros';

    // Define os campos que são atribuíveis em massa
    protected $fillable = [
        'nome',
    ];

    // Caso a tabela não utilize os timestamps (created_at e updated_at), descomente a linha abaixo
    // public $timestamps = false;
}
