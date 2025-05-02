<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nome', 'email', 'telefone', 'senha', 'tipo_usuario'];

    protected $hidden = ['senha', 'remember_token'];

    // Indica qual campo será usado para a autenticação
    public function getAuthIdentifierName()
    {
        return 'email';  // Usando o 'email' como identificador
    }

    public function getAuthPassword()
    {
        return $this->senha;  // Garantindo que a senha seja comparada corretamente
    }

    // Relacionamentos
    public function estudante()
    {
        return $this->hasOne(Estudante::class);
    }

    public function professor()
    {
        return $this->hasOne(Professor::class);
    }
}
