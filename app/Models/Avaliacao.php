<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'cadeira_id',
        'turma_id',
        'nome',
        'descricao',
        'data_avaliacao',
        'peso',
    ];

    public function cadeira()
    {
        return $this->belongsTo(Cadeira::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
