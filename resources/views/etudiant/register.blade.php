@extends('front.layout.app')
@php
    $noFooter = true;
@endphp
@section('content')
<div class="register-container">
     Partie gauche : Image ou texte de bienvenue 
    <div class="left-side">
        <h2>Bienvenue sur SKINOVA</h2>
        <p>Développez vos compétences avec nous !</p>
        <img src="{{ asset('assets/img/purple.jpg') }}" alt="Inscription" class="illustration">
    </div>

     Partie droite : Formulaire d'inscription 
    <div class="right-side">
        <div class="form-container">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h2>Inscription</h2>

                <label for="name"><i class="fas fa-user"></i> Nom :</label>
                <input type="text" id="name" name="name" required>

                <label for="email"><i class="fas fa-envelope"></i> Email :</label>
                <input type="email" id="email" name="email" required>

                <label for="password"><i class="fas fa-lock"></i> Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">S'inscrire</button>
            </form>

            <p>Vous avez déjà un compte ? <a href="{{ route('login') }}">Se Connecter</a></p>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Conteneur principal */
    .register-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 90%;
        max-width: 1000px;
        margin: 50px auto;
        padding: 20px;
        background: #ffffff;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    /* Partie gauche */
    .left-side {
        width: 50%;
        padding: 20px;
        text-align: center;
    }

    .left-side h2 {
        font-size: 24px;
        font-weight: bold;
        color: #3e1e68;
    }

    .left-side p {
        font-size: 16px;
        color: #666;
    }

    .illustration {
        width: 100%;
        max-width: 300px;
        margin-top: 20px;
    }

    /* Partie droite : Formulaire */
    .right-side {
        width: 50%;
        padding: 20px;
    }

    .form-container {
        background: linear-gradient(to right, #3e1e68, #261340, #b9c5fd);
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        color: white;
    }

    .form-container input {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border-radius: 5px;
        border: none;
        outline: none;
    }

    .form-container button {
        width: 100%;
        padding: 12px;
        margin-top: 15px;
        background-color: #2575fc;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .form-container button:hover {
        background-color: #6a11cb;
    }

    /* Responsive */
    @media screen and (max-width: 768px) {
        .register-container {
            flex-direction: column;
        }

        .left-side, .right-side {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection 
