<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Estudante extends Model
{
    use HasFactory;

    protected $table = 'estudantes';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'genero',
        'morada',
        'documento_identificacao',
        'curso_id',
        'turma_id',
        'foto'
    ];

    /**
     * Relacionamento: Estudante pertence a um Curso
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    /**
     * Relacionamento: Estudante pertence a uma Turma
     */
    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    /**
     * Mutator para salvar a foto no disco 'public'
     */
    public function setFotoAttribute($foto)
    {
        if ($foto) {
            $this->attributes['foto'] = $foto->store('fotos_estudantes', 'public');
        }
    }

    /**
     * Accessor para retornar a URL pública da foto
     */
    public function getFotoUrlAttribute()
    {
        return $this->foto ? Storage::url($this->foto) : null;
    }

    /**
     * Validação dos dados de entrada para criação ou atualização
     */
    public static function validar(array $dados)
    {
        return Validator::make($dados, [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:estudantes,email',
            'telefone' => 'required|string|max:15',
            'data_nascimento' => 'required|date',
            'genero' => 'required|in:masculino,feminino',
            'morada' => 'required|string|max:255',
            'documento_identificacao' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'turma_id' => 'required|exists:turmas,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    // App\Models\Estudante.php
public function mensalidades()
{
    return $this->hasMany(Mensalidade::class);
}

}
