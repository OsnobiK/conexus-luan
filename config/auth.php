<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => 'web', // <<< MUDANÇA AQUI: O guarda padrão é 'web' para usuários normais. Removi as linhas duplicadas.
        'passwords' => 'usuarios', // <<< MUDANÇA AQUI: O broker de senha padrão será 'usuarios'.
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuarios', // <<< MUDANÇA AQUI: O guarda 'web' deve usar a lista ('provider') de 'usuarios'.
        ],

        // Novo guarda para médico (mantive o nome no plural para consistência)
        'medicos' => [ // <<< MUDANÇA AQUI: Renomeado de 'medico' para 'medicos' para consistência.
            'driver' => 'session',
            'provider' => 'medicos',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [ // <<< CORREÇÃO PRINCIPAL: As definições de 'usuarios' e 'medicos' DEVEM estar DENTRO deste array 'providers'.
        
        // O provider padrão 'users' que pode ou não ser usado.
       // 'users' => [
         //   'driver' => 'eloquent',
           // 'model' => App\Models\User::class,
        //],
        
        'usuarios' => [
            'driver' => 'eloquent',
            'model' => App\Models\Usuario::class, // Seu model de usuário
        ],

        'medicos' => [
            'driver' => 'eloquent',
            'model' => App\Models\Medico::class, // Seu model de médico
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        // Esta configuração é para o provider padrão 'users'.
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // <<< ADICIONADO: Configuração de reset de senha para usuários.
        'usuarios' => [
            'provider' => 'usuarios',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // <<< ADICIONADO: Configuração de reset de senha para médicos.
        'medicos' => [
            'provider' => 'medicos',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];