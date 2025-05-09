<div class="p-4">
    <h2 class="text-lg font-semibold mb-4 text-blue-700">Menu</h2>
    <nav class="space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block text-sm text-gray-700 hover:text-blue-600">Dashboard</a>
        <a href="{{ route('admin.usuarios.index') }}" class="block text-sm text-gray-700 hover:text-blue-600">Usuários</a>
        <a href="{{ route('ano-academicos.index') }}" class="block text-sm text-gray-700 hover:text-blue-600">Ano Académico</a>
        <a href="{{ route('cursos.index') }}" class="block text-sm text-gray-700 hover:text-blue-600">Cursos</a>
        <a href="{{ route('admin.estudantes.index') }}" class="block text-sm text-gray-700 hover:text-blue-600">Estudantes</a>
        <a href="{{ route('admin.professores.index') }}" class="block text-sm text-gray-700 hover:text-blue-600">Professores</a>
        <a href="{{ route('turmas.index') }}" class="block text-sm text-gray-700 hover:text-blue-600">Turmas</a>
        <a href="{{ route('mensalidades.index') }}" class="block text-sm text-gray-700 hover:text-blue-600">Mensalidades</a>
        <a href="{{ route('configuracoes.index') }}" class="block text-sm text-gray-700 hover:text-blue-600">Configurações</a>

    </nav>
</div>
