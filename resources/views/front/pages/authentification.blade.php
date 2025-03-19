<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" contact="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('css/Inscription.css')}}">
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
                <header>Se connecter</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Nom Utilisateur:</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="field input">
                        <label for="passwd">Mot de Passe:</label>
                        <input type="password" name="passwd" id="passwd" required>
                    </div>
                    <div class="field ">
                        <input type="submit" class="btn" name="submit" value="se connecter" required>
                    </div>
                    <div class="links">
                        Vous n'avez pas de compte? <a href="Inscription.blade.php">S'inscrire maintenant
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>