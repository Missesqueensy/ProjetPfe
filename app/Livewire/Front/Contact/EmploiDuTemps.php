<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EmploiDuTemps extends Component
{
    public $events = [];

    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = EmploiDuTemps::with([
                'cours:id_cours,titre', 
                'enseignant:id_enseignant,nom,prenom'
            ])
            ->where('id_enseignant', auth()->user()->enseignant->id_enseignant)
            ->get()
            ->map(function ($item) {
                return [
                    'title' => $item->cours->titre,
                    'start' => $item->debut->toIso8601String(),
                    'end' => $item->fin->toIso8601String(),
                    'salle' => $item->salle,
                    'extendedProps' => [
                        'enseignant' => $item->enseignant->nom.' '.$item->enseignant->prenom,
                        'cours_id' => $item->id_cours
                    ]
                ];
            })->toArray();
    }

    public function render()
    {
        return view('enseignant.emploi-temps');
    }
}