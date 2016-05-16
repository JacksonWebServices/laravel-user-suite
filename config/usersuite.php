<?php

return [

    'database' => env('DB_DATABASE', 'forge'),
    
    'users' => [
        'driver' => 'eloquent',
        'model' => App\User::class
    ]
];