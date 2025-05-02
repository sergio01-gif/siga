<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criar um usuário administrador
        Usuario::create([
            'nome' => 'Administrador',
            'email' => 'admin@impom.co.mz',
            'telefone' => '123456789', // Adicionar um número de telefone (opcional)
            'senha' => Hash::make('IMPOM201304#'), // Senha criptografada
            'tipo_usuario' => 'admin', // Tipo de usuário 'admin'
        ]);

        // Criar um coordenador de curso
        Usuario::create([
            'nome' => 'Coordenador de Curso',
            'email' => 'coordenador@impom.co.mz',
            'telefone' => '987654321',
            'senha' => Hash::make('senha123'),
            'tipo_usuario' => 'coordenador_de_curso', // Tipo de usuário 'coordenador_de_curso'
        ]);

        // Criar um professor
        Usuario::create([
            'nome' => 'Professor de Matemática',
            'email' => 'professor.matematica@impom.co.mz',
            'telefone' => '1122334455',
            'senha' => Hash::make('senha123'),
            'tipo_usuario' => 'professor', // Tipo de usuário 'professor'
        ]);

        // Criar um aluno
        Usuario::create([
            'nome' => 'Sérgio Dagarasse João',
            'email' => 'sergio.dagarasse@impom.co.mz',
            'telefone' => '2233445566',
            'senha' => Hash::make('senha123'),
            'tipo_usuario' => 'estudante', // Tipo de usuário 'aluno'
        ]);

        // Criar um contabilista
        Usuario::create([
            'nome' => 'Contabilista',
            'email' => 'contabilista@impom.co.mz',
            'telefone' => '3344556677',
            'senha' => Hash::make('senha123'),
            'tipo_usuario' => 'contabilista', // Tipo de usuário 'contabilista'
        ]);

        // Criar um coordenador de estágio
        Usuario::create([
            'nome' => 'Coordenador de Estágio',
            'email' => 'coordenador.estagio@impom.co.mz',
            'telefone' => '4455667788',
            'senha' => Hash::make('senha123'),
            'tipo_usuario' => 'coordenador_estagio', // Tipo de usuário 'coordenador_estagio'
        ]);

        // Criar um bibliotecário
        Usuario::create([
            'nome' => 'Bibliotecário',
            'email' => 'bibliotecario@impom.co.mz',
            'telefone' => '5566778899',
            'senha' => Hash::make('senha123'),
            'tipo_usuario' => 'bibliotecario', // Tipo de usuário 'bibliotecario'
        ]);

        // Criar um registro acadêmico
        Usuario::create([
            'nome' => 'Registro Acadêmico',
            'email' => 'registro.academico@impom.co.mz',
            'telefone' => '6677889900',
            'senha' => Hash::make('senha123'),
            'tipo_usuario' => 'registro_academico', // Tipo de usuário 'registro_academico'
        ]);
    }
}
