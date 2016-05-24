<?php

return [

    'users' => [
        'db' => env('DB_DATABASE', 'forge'), 
        'model' => App\User::class
    ],
    
    'db' => env('DB_DATABASE', 'forge'),
    
];
