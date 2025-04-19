<?php

use App\Models\Etudiant; // L'importation doit être ici, avant les tableaux de configuration
use App\Models\enseignant;
return [

    'defaults' => [
        'guard' => 'etudiant',
        'passwords' => 'etudiant',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',//hna etudiant
        ],
        'etudiant' => [ // Configuration du guard 'etudiant'
            'driver' => 'session',
            'provider' => 'etudiants', // Le provider que tu as défini plus bas
        ],
        'enseignant' => [
        'driver' => 'session',
        'provider' => 'enseignants',
    ],

        'api' => [
            'driver' => 'token',
            'provider' => 'etudiants',//ha
            'hash' => false,
        ],
        'admin' => [
    'driver' => 'session',
    'provider' => 'admins',
],

    ],

    'providers' => [
        'etudiants' => [
            'driver' => 'eloquent',
            'model' => Etudiant::class, // Utilisation correcte de l'importation
        ],
        'admins' => [
    'driver' => 'eloquent',
    'model' => App\Models\Admin::class,
],
'enseignants' => [
    'driver' => 'eloquent',
    'model' => App\Models\enseignant::class,
],

    ],

    'passwords' => [
        'etudiant' => [
             'provider' => 'etudiants',//hna etudiant
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,


'admin' => [
    'driver' => 'session',
    'provider' => 'admin',
],

];

?>