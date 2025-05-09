<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estagio extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudante_id',
        'empresa',
        'area',
        'data_inicio',
        'data_fim',
        'orientador',
        'status'
    ];

    public function estudante()
    {
        return $this->belongsTo(Estudante::class);
    }
}
