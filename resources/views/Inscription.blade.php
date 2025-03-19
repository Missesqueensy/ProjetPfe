
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contact="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<link rel="stylesheet" href="{{asset('css/Inscription.css')}}">-->
        <link rel="stylesheet" href="{{ asset('assets/css/Inscription.css') }}">

        <title>Register</title>
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
                <header>S'inscrire</header>
                <form action="{{ route('register') }}" method="post">
                 @csrf
                    <div class="field input">
                        <label for="Nom">Nom:</label>
                        <input type="text" name="nom" id="Nom" required>
                    </div>
                    <div class="field input">
                        <label for="Prenom">Prénom:</label>
                        <input type="text" name="prenom" id="prenom" required>
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
                        <label for="tel">Tel:</label>
                        <input type="text" name="tel" id="tel" required>
                    </div>
                    <div class="field ">
                        <input type="submit" class="btn" name="submit" value="s'inscrire" required>
                    </div>
                    <div class="links">
                        Vous avez déjà un compte? <a href="authentification.blade.php">Se Connecter
                    </div>
                   <!-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>-->
@endif

                </form>
            </div>
        </div>
    </body>
</html>