<?php

// app/Models/Professor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    // Define explicitamente o nome da tabela
    protected $table = 'professores';

    // Define os campos que podem ser preenchidos
    protected $fillable = [
        'nome', 
        'email', 
        'telefone', 
        'especialidade', 
        'documento_identificacao', 
        'tipo_contratacao', 
        'foto', 
        'usuario_id'
    ];

    /**
     * Relacionamento com o modelo Usuario.
     * Um professor pertence a um usuário (geralmente o admin que o cria).
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    /**
     * Relacionamento com o modelo Cadeira.
     * Um professor pode lecionar várias cadeiras, e uma cadeira pode ter vários professores.
     */
    public function cadeiras()
    {
        return $this->belongsToMany(Cadeira::class, 'cadeira_professor') // Tabela de junção
                    ->withPivot('turma_id') // Campos adicionais na tabela de junção
                    ->withTimestamps(); // Inclui campos de timestamp (created_at e updated_at)
    }

    /**
     * Método para salvar a foto do professor.
     * O nome da foto será armazenado no banco de dados.
     */
    public function setFotoAttribute($value)
    {
        if (is_null($value)) {
            return;
        }

        // Salva a foto no diretório 'professores' e armazena o caminho
        $this->attributes['foto'] = $value->store('professores', 'public');
    }

    /**
     * Método para acessar a URL da foto do professor.
     * Retorna a URL completa para a foto.
     */
    public function getFotoUrlAttribute()
    {
        // Verifica se existe uma foto associada ao professor
        return $this->foto ? asset('storage/' . $this->foto) : asset('storage/professores/default.jpg');
    }
}
