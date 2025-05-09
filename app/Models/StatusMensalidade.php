<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusMensalidade extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    /**
     * Relação com o modelo Mensalidade.
     * Um status pode ter várias mensalidades associadas.
     */
    public function mensalidades()
    {
        return $this->hasMany(Mensalidade::class, 'status_mensalidade_id');
    }
}
