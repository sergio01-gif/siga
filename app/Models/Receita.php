<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    // Define os campos que podem ser preenchidos em massa
    protected $fillable = [
        'descricao',
        'valor',
        'data_recebimento',
        'categoria_id',
        'estudante_id',
        'observacao',
    ];

    // Definindo o relacionamento entre Receita e Categoria (cada receita pertence a uma categoria)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Definindo o relacionamento entre Receita e Estudante (cada receita pode ser associada a um estudante)
    public function estudante()
    {
        return $this->belongsTo(Estudante::class);
    }
}
