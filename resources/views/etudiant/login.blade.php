@extends('front.layout.app')
@php
    $noFooter = true;
@endphp
@section('content')
    <div class="form-container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <h2>Connexion - Étudiant</h2>

            <label for="email"><i class="fas fa-envelope"></i>Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="password"><i class="fas fa-lock"></i>Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>

        <!-- Lien vers la page d'inscription -->
        <p>Vous n'avez pas encore de compte ? <a href="{{ route('inscription') }}">S'inscrire</a></p>
    </div>
@endsection
