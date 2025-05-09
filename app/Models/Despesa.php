<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'valor',
        'data_pagamento',
        'forma_pagamento',
        'categoria_id',
        'status',
    ];

    // Uma despesa pertence a uma categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Adiciona data atual automaticamente se não for fornecida
    protected static function booted()
    {
        static::creating(function ($despesa) {
            if (empty($despesa->data_pagamento)) {
                $despesa->data_pagamento = now()->toDateString(); // Insere a data atual
            }
        });
    }
}
