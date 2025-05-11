@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    # Réponse à votre réclamation #{{ $reclamation->id }}

    Bonjour {{ $reclamation->expediteur->nom }},

    Nous avons traité votre réclamation et voici notre réponse :

    **Statut** : {{ ucfirst($reclamation->statut) }}  
    **Date de réponse** : {{ $reclamation->date_reponse->format('d/m/Y H:i') }}

    @component('mail::panel')
        {!! nl2br(e($reclamation->reponse)) !!}
    @endcomponent

    @component('mail::button', ['url' => url('/mes-reclamations/'.$reclamation->id), 'color' => 'primary'])
        Voir la réclamation
    @endcomponent

    Cordialement,  
    L'équipe {{ config('app.name') }}

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.
        @endcomponent
    @endslot
@endcomponent