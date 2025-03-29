<?php

use App\Models\Etudiant; // L'importation doit être ici, avant les tableaux de configuration

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'etudiant',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'etudiant',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'etudiant',
            'hash' => false,
        ],
    ],

    'providers' => [
        'etudiant' => [
            'driver' => 'eloquent',
            'model' => Etudiant::class, // Utilisation correcte de l'importation
        ],
    ],

    'passwords' => [
        'etudiant' => [
            'provider' => 'etudiant',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
?>