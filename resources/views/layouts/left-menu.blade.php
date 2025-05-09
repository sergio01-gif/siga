@auth
@php
    $usuario = auth()->user();
@endphp

<style>
    .sidebar {
        background-color:rgb(3, 13, 57); /* azul escuro */
        color: white;
        height: 100vh;
        padding: 20px;
        width: 240px;
    }

    .sidebar-header h4 {
        color: white;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .nav-link {
        color: white;
        padding: 10px 15px;
        border-radius: 6px;
        margin-bottom: 8px;
        display: block;
        transition: background 0.2s ease-in-out;
    }

    .nav-link:hover, .nav-link.active {
        background-color: #3949ab; /* azul médio para hover */
        text-decoration: none;
    }

    .menu-estudante li a,
    .menu-estudante button {
        color: white;
        display: block;
        padding: 10px 15px;
        border-radius: 6px;
        margin-bottom: 1px;
        text-align: left;
        background: none;
        border: none;
        width: 100%;
        transition: background 0.2s ease-in-out;
    }

    .menu-estudante li a:hover,
    .menu-estudante button:hover {
        background-color: #3949ab;
        text-decoration: none;
    }

    .menu-estudante button {
        cursor: pointer;
    }

    .nav-item {
        list-style: none;
    }

    ul.nav {
        padding: 0;
    }
</style>

<div class="sidebar">
    <div class="sidebar-header">
        <h4>📘 Menu</h4>
    </div>
    <ul class="nav flex-column">
        {{-- Menus por tipo de usuário --}}
        @if ($usuario->tipo_usuario == 'admin')
            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">📊 Dashboard Admin</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('usuarios.index') }}">👥 Gestão de Usuários</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('ano_academicos.index') }}">📆 Ano Académico</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('cursos.index') }}">🎓 Gestão de Cursos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('turmas.index') }}">🏫 Gestão de Turmas</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('cadeiras.index') }}">📚 Gestão de Cadeiras</a></li>
        @endif

        @if ($usuario->tipo_usuario == 'coordenador_de_curso')
    <li class="nav-item"><a class="nav-link" href="{{ route('coordenador_curso.dashboard') }}">📊 Dashboard Coordenador</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('cursos.index') }}">🎓 Cursos</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('cadeiras.index') }}">📚 Cadeiras</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('professores.index') }}">👨‍🏫 Professores</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('estudantes.index') }}">👩‍🎓 Estudantes</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('estagios.index') }}">🏢 Estágios</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('relatorios.mensalidades.curso') }}">💰 Relatório de Mensalidades</a></li>
@endif


        @if ($usuario->tipo_usuario == 'professor')
    <li class="nav-item"><a class="nav-link" href="{{ route('professores.dashboard') }}">📊 Dashboard Professor</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('aulas.index') }}">📖 Aulas</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('professores.disciplinas') }}">📚 Disciplinas</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('professores.notas') }}">📝 Notas</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('professores.avaliacoes') }}">🏅 Avaliações</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('professores.turmas') }}">👨‍🏫 Turmas</a></li>
@endif


        @if ($usuario->tipo_usuario == 'estudante')
            <ul class="menu-estudante">
                <li><a href="{{ route('estudantes.dashboard') }}">🏠 Painel Principal</a></li>
                <li><a href="{{ route('estudantes.cursos') }}">🎓 Meus Cursos</a></li>
                <li><a href="{{ route('estudantes.notas') }}">📊 Minhas Notas</a></li>
                <li><a href="{{ route('estudantes.estagios') }}">📁 Estágios</a></li>
                <li><a href="{{ route('estudantes.supervisores') }}">🧑‍🏫 Supervisores</a></li>
                <li><a href="{{ route('estudantes.relatorios') }}">📝 Relatórios</a></li>
                <li><a href="{{ route('estudantes.mensalidades') }}">💸 Mensalidades</a></li>
                <li><a href="{{ route('estudantes.notificacoes') }}">📢 Notificações</a></li>
                <li><a href="{{ route('estudantes.perfil') }}">👤 Meu Perfil</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">🚪 Terminar Sessão</button>
                    </form>
                </li>
            </ul>
        @endif

        @if ($usuario->tipo_usuario == 'contabilista')
            <li class="nav-item"><a class="nav-link" href="{{ route('contabilidade.dashboard') }}">📊 Dashboard Contabilista</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('relatorios.financeiro') }}">💼 Relatórios Financeiros</a></li>
        @endif

       
        @if ($usuario->tipo_usuario == 'coordenador_estagio')
    <li class="nav-item"><a class="nav-link" href="{{ route('coordenador_estagio.dashboard') }}">📊 Dashboard</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('estagios.index') }}">📁 Gestão de Estágios</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('supervisores.index') }}">🧑‍🏫 Supervisores</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('relatorios.index') }}">📝 Relatórios de Estágio</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('notificacoes.index') }}">📢 Notificações</a></li>
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link">🚪 Terminar Sessão</button>
        </form>
    </li>
@endif

        @if ($usuario->tipo_usuario == 'bibliotecario')
            <li class="nav-item"><a class="nav-link" href="{{ route('biblioteca.index') }}">📚 Biblioteca</a></li>
        @endif

        @if ($usuario->tipo_usuario == 'registro_academico')
            <li class="nav-item"><a class="nav-link" href="{{ route('registro_academico.index') }}">📑 Registro Acadêmico</a></li>
        @endif
    </ul>
</div>
@endauth
