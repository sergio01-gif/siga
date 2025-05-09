<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudante_id',
        'mensalidade_id',
        'metodo',
        'entidade',
        'referencia',
        'valor',
        'estado',
        'comprovativo',
        'data_pagamento',
    ];

    public function estudante()
    {
        return $this->belongsTo(Estudante::class);
    }

    public function mensalidade()
    {
        return $this->belongsTo(Mensalidade::class);
    }
}
