<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'tipo',
    ];

    // Relacionamento: Uma categoria tem muitas despesas
    public function despesas()
    {
        return $this->hasMany(Despesa::class);
    }

    // Relacionamento: Uma categoria tem muitas receitas
    public function receitas()
    {
        return $this->hasMany(Receita::class);
    }
}
