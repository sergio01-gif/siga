<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'avaliacao_id',
        'estudante_id',
        'nota',
        'observacao',
    ];

    public function avaliacao()
    {
        return $this->belongsTo(Avaliacao::class);
    }

    public function estudante()
    {
        return $this->belongsTo(Estudante::class);
    }
}
