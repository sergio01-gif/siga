<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracaoSistema extends Model
{
    use HasFactory;

    protected $table = 'configuracoes';

    protected $fillable = [
        'nome_instituicao',
        'sigla',
        'email',
        'telefone',
        'endereco',
        'moeda',
        'idioma',
        'logo',
        'tema',
        'ano_lectivo_ativo',
    ];

    public function ano()
    {
        return $this->belongsTo(\App\Models\AnoAcademico::class, 'ano_lectivo_ativo');
    }
}
