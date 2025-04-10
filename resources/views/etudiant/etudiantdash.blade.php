<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <!--<link rel="stylesheet" href="Admindash.css">-->
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">

    <title>Etudiant Dashboard Panel</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body> 
<div class="dashboard-container">

    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{asset('assets/img/logosvg.svg')}}" width="50px"alt="">
               <div class="brand-icons">
                <span class="las la-beli"> </span>
                <span class="las la-user-circle"></span>

               </div>
            </div>
        </div>
        <div class="sidebar-user">
            <img src="{{asset('assets/img/carousel-2.jpg')}}" height=50 width=50 alt="">
            <div>
           
                <h3>AHLAME LAouad</h3>
                <span>Laouad.ahlame@gmail.com</span>
            </div>
        </div>
        <div class="sidebar-menu">
             <div class="menu-head">
                <a href="{{url('/loginprofile')}}">
                <span>Mon Profile</span>
                </a>
             </div>

             <ul>
                <li>
                    <a href="{{url('/Cours')}}">
                        <span class="la la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li>
                    <a href="{{url('/Favoris')}}">
                    <span class="las la-chart-pie"></span>
                      Mes Favoris
                    </a>
                </li>
                <li>
                    <a href="{{url('/Mesformulaires')}}">
                        <span class="las la-calendar"></span>
                        Mes Formulaires
                    </a>
                </li>
                <li>
                    <a href="{{url('/Mesévaluations')}}">
                    <span class="la la-wpforms"></span>
                      Mes évaluations
                    </a>
                </li>
                <li>
                    <a href="{{url('/Mescommentaire')}}">
                        <span class="la la-check-circle"></span>
                        Mes Commentaires
                    </a>
                </li>
                <li>
                    <a href="{{url('/MesFormations')}}">
                    <span class="la la-chalkboard"></span>
                      Mes Formations 
                    </a>
                </li>
                <li>
                    <a href="{{url('')}}">
                        <span class="fa-solid fa-gear"></span>
                        Paramètres
                       </a>
                </li>

                <li>
                    <a href="{{url('/Déconnexion')}}">
                    <span class="fa-regular fa-sign-out-alt"></span>
                      Déconnexion
                    </a>
                </li>
                
             </ul>
            </div>
        </div>
    </div>
</body>
</html>