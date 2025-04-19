<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">
    <title>Dashboard Enseignant - Mes Cours</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body> 
<div class="dashboard-container">
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{ asset('assets/img/logosvg.svg') }}" width="50px" alt="Logo">
                <div class="brand-icons">
                    <span class="las la-bell"></span>
                    <span class="las la-user-circle"></span>
                </div>
            </div>
        </div>
        <div class="sidebar-user">
            <img src="{{ asset('assets/img/user.jpeg') }}" height="50" width="50" alt="Photo de profil">
            <div>
                <h3>Amal Assim</h3>
                <span>Amalassim@gmail.com</span>
            </div>
        </div>
        <div class="sidebar-menu">
            <div class="menu-head">
                <a href="{{ url('/enseignant/dashboard') }}">Mon Profil</a>
            </div>
            <ul>
                <li class="active">
                    <a href="{{ url('/enseignant/cours') }}">
                        <span class="la la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-wpforms"></span>
                        Evaluations
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-check-circle"></span>
                        Résultats étudiants
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="las la-envelope"></span>
                        Boîte e-mails
                    </a>
                </li>
            </ul>
        </div>
    </div>

<div class="main-content">
        <header>
            <h1>Enseignant dashboard</h1>
        </header>

        <div class="container">
            <h1>Tous Mes Cours</h1>
            <ul>
                @foreach($courses as $cours)
                    <li>
                        <strong>{{ $cours->titre }}</strong><br>
                        <small>{{ $cours->description }}</small><br>
                        <a href="{{ route('Admin.courses.show', $cours->id_cours) }}">Voir</a>

                        <!-- Formulaire de suppression -->
                        <form action="{{ route('Admin.courses.destroy', $cours->id_cours) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')" class="btn btn-danger">Supprimer</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</body>
</html>