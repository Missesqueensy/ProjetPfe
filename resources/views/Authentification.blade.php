<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contact="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/css/Inscription.css') }}">

        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
                <header>Se Connecter</header>
                <form action="{{ route('login.submit') }}" method="post">
                 @csrf
                    
                    <div class="field input">
                        <label for="Email">Email:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="field input">
                        <label for="passwd">Mot de Passe:</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <div class="field ">
                        <input type="submit" class="btn" name="submit" value="se connecter" required>
                    </div>
                    <div class="links">
                        Vous n'avez pas de compte? <a href="{{route('inscription')}}">S'inscrire
                    </div>
                    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                </form>
            </div>
        </div>
    </body>
    </html>
             