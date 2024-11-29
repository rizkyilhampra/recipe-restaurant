<?php

arch()->preset()->php();
arch()->preset()->laravel();

arch('strict types')
    ->expect([
        'App\Models',
        'App\Controllers'
    ])
    ->toUseStrictTypes();

arch('avoid open for extension')
    ->expect([
        'App\Models',
        'App\Controllers'
    ])
    ->classes()
    ->toBeFinal()
    ->ignoring([]);

arch('ensure no extends')
    ->expect('App')
    ->classes()
    ->not->toBeAbstract()
    ->ignoring([]);


arch('avoid inheritance')
    ->expect('App')
    ->classes()
    ->toExtendNothing()
    ->ignoring([
        'App\Console\Commands',
        'App\Exceptions',
        'App\Http\Requests',
        'App\Jobs',
        'App\Livewire',
        'App\Mail',
        'App\Models',
        'App\Notifications',
        'App\Providers',
        'App\View',
    ]);

arch('annotations')
    ->expect('App')
    ->toHavePropertiesDocumented()
    ->toHaveMethodsDocumented();
