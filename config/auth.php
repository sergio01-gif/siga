<?php

return [

    /*
    |----------------------------------------------------------------------
    | Authentication Defaults
    |----------------------------------------------------------------------
    |
    | Esta opção controla a autenticação padrão "guard" e as opções de 
    | reset de senha para sua aplicação. Você pode mudar esses valores 
    | conforme necessário, mas esses são os padrões ideais para a maioria
    | das aplicações.
    |
    */

    'defaults' => [
        'guard' => 'web', // Define o guard padrão
        'passwords' => 'usuarios', // Referência para senhas (configuração da tabela de reset de senha)
    ],

    /*
    |----------------------------------------------------------------------
    | Authentication Guards
    |----------------------------------------------------------------------
    |
    | Aqui você pode definir todos os "guards" de autenticação para sua aplicação.
    | O Laravel já tem uma configuração ideal para autenticação por sessão e 
    | Eloquent, que é o método padrão.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session', // O driver de autenticação será por sessão
            'provider' => 'usuarios', // Usamos o provedor 'usuarios', que está configurado abaixo
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | User Providers
    |----------------------------------------------------------------------
    |
    | Os "providers" de autenticação definem como os usuários serão recuperados
    | da base de dados ou de outros meios de armazenamento.
    |
    | O Laravel já tem suporte para Eloquent e Database.
    |
    */

    'providers' => [
        'usuarios' => [
            'driver' => 'eloquent',
            'model' => App\Models\Usuario::class, // Definindo o modelo como Usuario
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Resetting Passwords
    |----------------------------------------------------------------------
    |
    | Aqui você pode configurar a política de reset de senhas para os usuários.
    |
    */

    'passwords' => [
        'usuarios' => [
            'provider' => 'usuarios',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800, // Timeout para confirmação de senha (em segundos)
];
