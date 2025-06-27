<!-- resources/views/etudiant/bienvenue.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Déconnexion</title>
    <meta http-equiv="refresh" content="2;url={{ route('front.index') }}">
    <style>
        body {
            background-color: #fff;
            color: #000;
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 20%;
        }
    </style>
</head>
<body>
    <h1>{{ session('message') ?? 'Déconnexion effectuée.' }}</h1>
    <p>Redirection vers la page d’accueil...</p>
</body>
</html>
