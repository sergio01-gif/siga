<div class="col-md-3 col-lg-2 bg-dark text-white vh-100 p-4" x-data="{ menu: {} }">
    <h4>{{ config('app.name', 'Laravel') }}</h4>

    <ul class="nav flex-column">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> {{ __('Dashboard') }}
            </a>
        </li>

        <!-- Módulo Acadêmico -->
        <li class="nav-item" x-data="{ open: false }">
            <a href="#" class="nav-link text-white" @click.prevent="open = !open">
                <i class="fas fa-graduation-cap"></i> {{ __('Acadêmico') }}
                <i class="fas fa-caret-down float-right"></i>
            </a>
            <div x-show="open" class="ml-4" x-cloak>
                <a class="nav-link text-white" href="{{ route('anoAcademicos.index') }}">
                    <i class="fas fa-calendar-alt"></i> {{ __('Ano Acadêmico') }}
                </a>
                <a class="nav-link text-white" href="{{ route('cursos.index') }}">
                    <i class="fas fa-book-open"></i> {{ __('Cursos') }}
                </a>
                <a class="nav-link text-white" href="{{ route('cadeiras.index') }}">
                    <i class="fas fa-chalkboard-teacher"></i> {{ __('Cadeiras') }}
                </a>
                <a class="nav-link text-white" href="{{ route('turmas.index') }}">
                    <i class="fas fa-users"></i> {{ __('Turmas') }}
                </a>
                <a class="nav-link text-white" href="{{ route('matriculas.index') }}">
                    <i class="fas fa-clipboard-list"></i> {{ __('Matrículas') }}
                </a>
                <a class="nav-link text-white" href="{{ route('professores.index') }}">
                    <i class="fas fa-user-tie"></i> {{ __('Professores') }}
                </a>
                <a class="nav-link text-white" href="{{ route('estudantes.index') }}">
                    <i class="fas fa-user-graduate"></i> {{ __('Alunos') }}
                </a>
            </div>
        </li>

        <!-- Módulo Financeiro -->
        <li class="nav-item" x-data="{ open: false }">
            <a href="#" class="nav-link text-white" @click.prevent="open = !open">
                <i class="fas fa-wallet"></i> {{ __('Financeiro') }}
                <i class="fas fa-caret-down float-right"></i>
            </a>
            <div x-show="open" class="ml-4" x-cloak>
                <a class="nav-link text-white" href="{{ route('receitas.index') }}">
                    <i class="fas fa-plus"></i> {{ __('Receitas') }}
                </a>
                <a class="nav-link text-white" href="{{ route('despesas.index') }}">
                    <i class="fas fa-minus"></i> {{ __('Despesas') }}
                </a>
                <a class="nav-link text-white" href="{{ route('categorias.index') }}">
                    <i class="fas fa-tags"></i> {{ __('Categorias Financeiras') }}
                </a>
                <a class="nav-link text-white" href="{{ route('mensalidades.index') }}">
                    <i class="fas fa-calendar-check"></i> {{ __('Mensalidades') }}
                </a>
            </div>
        </li>

        <!-- Módulo Relatórios -->
        <li class="nav-item" x-data="{ open: false }">
            <a href="#" class="nav-link text-white" @click.prevent="open = !open">
                <i class="fas fa-chart-line"></i> {{ __('Relatórios') }}
                <i class="fas fa-caret-down float-right"></i>
            </a>
            <div x-show="open" class="ml-4" x-cloak>
                <a class="nav-link text-white" href="{{ route('relatorios.receitas') }}">
                    <i class="fas fa-chart-line"></i> {{ __('Relatório de Receitas') }}
                </a>
                <a class="nav-link text-white" href="{{ route('relatorios.despesas') }}">
                    <i class="fas fa-chart-bar"></i> {{ __('Relatório de Despesas') }}
                </a>
                <a class="nav-link text-white" href="{{ route('relatorios.geral') }}">
                    <i class="fas fa-chart-pie"></i> {{ __('Relatório Geral') }}
                </a>
            </div>
        </li>

        <!-- Módulo Biblioteca -->
        <li class="nav-item" x-data="{ open: false }">
            <a href="#" class="nav-link text-white" @click.prevent="open = !open">
                <i class="fas fa-book"></i> {{ __('Biblioteca') }}
                <i class="fas fa-caret-down float-right"></i>
            </a>
            <div x-show="open" class="ml-4" x-cloak>
                <a class="nav-link text-white" href="{{ route('categoriaslivro.index') }}">
                    <i class="fas fa-tags"></i> {{ __('Categorias de Livro') }}
                </a>
                <a class="nav-link text-white" href="{{ route('livros.index') }}">
                    <i class="fas fa-book"></i> {{ __('Livros') }}
                </a>
            </div>
        </li>

        <!-- Módulo Avaliações -->
        <li class="nav-item" x-data="{ open: false }">
            <a href="#" class="nav-link text-white" @click.prevent="open = !open">
                <i class="fas fa-star"></i> {{ __('Avaliações') }}
                <i class="fas fa-caret-down float-right"></i>
            </a>
            <div x-show="open" class="ml-4" x-cloak>
                <a class="nav-link text-white" href="{{ route('avaliacoes.index') }}">
                    <i class="fas fa-star"></i> {{ __('Avaliar') }}
                </a>
                <a class="nav-link text-white" href="{{ route('notas.index') }}">
                    <i class="fas fa-pencil-alt"></i> {{ __('Notas') }}
                </a>
            </div>
        </li>

    </ul>
</div>
