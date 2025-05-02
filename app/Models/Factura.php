<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_factura',
        'mensalidade_id',
        'estudante_id',
        'valor_pago',
        'data_pagamento',
        'forma_pagamento',
        'observacoes',
    ];

    public function mensalidade()
    {
        return $this->belongsTo(Mensalidade::class);
    }

    public function estudante()
    {
        return $this->belongsTo(Estudante::class);
    }
}
