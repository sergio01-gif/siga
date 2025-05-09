<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudante_id',
        'mes_referencia',
        'data_vencimento',
        'valor',
        'forma_pagamento',
        'entidade_referencia',
        'status', // Aqui o status é diretamente armazenado na mensalidade
    ];

    /**
     * Relação com a tabela Estudantes.
     */
    public function estudante()
    {
        return $this->belongsTo(Estudante::class, 'estudante_id');
    }

    /**
     * Verifica se a mensalidade foi paga.
     */
    public function isPaid()
    {
        return $this->status === 'pago';
    }

    /**
     * Verifica se a mensalidade está vencida.
     */
    public function isOverdue()
    {
        return $this->status === 'vencido';
    }
}
