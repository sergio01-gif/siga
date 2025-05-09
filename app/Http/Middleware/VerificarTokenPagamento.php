<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarTokenPagamento
{
    public function handle(Request $request, Closure $next)
    {
        $tokenRecebido = $request->header('Authorization');

        // Token definido no .env
        $tokenEsperado = env('PAGAMENTO_WEBHOOK_TOKEN', 'token-seguro');

        // Verifica se o token está correto
        if ($tokenRecebido !== 'Bearer ' . $tokenEsperado) {
            return response()->json(['error' => 'Acesso não autorizado.'], 401);
        }

        return $next($request);
    }
}
