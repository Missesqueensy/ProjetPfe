<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/css/Inscription.css') }}">
        <title>Register</title>
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
                <header>S'inscrire</header>
               <form action="{{ url('/inscription') }}" method="POST">

                    @csrf
                    <div class="field input">
                        <label for="Nom">Nom:</label>
                        <input type="text" name="nom" id="Nom" required>
                    </div>
                    <div class="field input">
                        <label for="Prenom">Prénom:</label>
                        <input type="text" name="prénom" id="prenom" required>
                    </div>
                    <div class="field input">
                        <label for="Email">Email:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="field input">
                        <label for="passwd">Mot de Passe:</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="field input">
    <label for="password_confirmation">Confirmer le mot de passe:</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>
</div>
                    <div class="field input">
                        <label for="tel">Tel:</label>
                        <input type="text" name="tel" id="tel" required>
                    </div>
                    <div class="field input">
                        <label for="CNI">CNI:</label>
                        <input type="text" name="CNI" id="CNI" required> 
                    </div>
                    <!-- Sélection du rôle (Si nécessaire, décommente cette partie) -->
                    <!--
                    <div class="field input">
                        <label>Rôle :</label>
                        <select name="role" required>
                            <option value="etudiant">Étudiant</option>
                            <option value="professeur">Professeur</option>
                        </select>
                    </div>
                    -->

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="S'inscrire">
                    </div>
                    <div class="links">
                        Vous avez déjà un compte? <a href="{{ route('login') }}">Se Connecter</a>
                    </div>

                    <!-- Affichage des messages de succès et d'erreur -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </body>
</html>
