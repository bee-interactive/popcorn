<?php

arch()->preset()->php();

arch()->preset()->security()->ignoring('assert');

arch()->preset()->laravel()
    ->ignoring([
        'App\Livewire',
    ]);

arch('ensure no extends')
    ->expect('App')
    ->classes()
    ->not->toBeAbstract();

arch('avoid inheritance')
    ->expect('App')
    ->classes()
    ->toExtendNothing()
    ->ignoring([
        'App\Console\Commands',
        'App\Exceptions',
        'App\Http\Integrations',
        'App\Http\Requests',
        'App\Services\MediaLibrary',
        'App\Jobs',
        'App\Livewire',
        'App\Mail',
        'App\Models',
        'App\Notifications',
        'App\Providers',
        'App\View',
    ]);
