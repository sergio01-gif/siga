<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ConfiguracaoSistema;
use Illuminate\Support\Facades\View;

class ConfiguracaoSistemaProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Compartilha a configuração com todas as views
        View::composer('*', function ($view) {
            $config = ConfiguracaoSistema::first();
            $view->with('configGlobal', $config);
        });
    }
}
