<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudante_id',
        'valor',
        'forma_pagamento',
        'entidade_referencia',
    ];

    public function estudante()
    {
        return $this->belongsTo(Estudante::class);
    }
}
