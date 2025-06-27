@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3>Conversation: {{ $conversation->subject }}</h3>
            
            <div class="list-group">
                @foreach ($messages as $message)
                    <div class="list-group-item">
                        <strong>{{ $message->user->name }}:</strong>
                        <p>{{ $message->content }}</p>
                        <small>{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>
            
            <form action="{{ route('etudiant.messagerie.send', $conversation->id) }}" method="POST">
                @csrf
                <div class="form-group mt-3">
                    <textarea class="form-control" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
            </form>
        </div>
    </div>
</div>
@endsection
