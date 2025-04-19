<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/Inscription.css') }}">
    <title>Connexion Enseignant</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Connexion Enseignant</header>
            <form action="{{ route('enseignant.login.submit') }}" method="post">
                @csrf
                
                <div class="field input">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                
                <div class="field input">
                    <label for="password">Mot de Passe:</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Se connecter">
                </div>
                
                <div class="links">
                    Vous n'avez pas de compte? <a href="{{ route('enseignant.register') }}">S'inscrire</a>
                </div>
                
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