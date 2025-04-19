<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <!--<link rel="stylesheet" href="Admindash.css">-->
    <link rel="stylesheet" href="{{ asset('assets/css/enseignantdash.css') }}">

    <title>dashboard enseignant</title>
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
            <img src="{{asset('assets/img/user.jpeg')}}" height=50 width=50 alt="">
            <div>
                <h3>amal assim</h3>
                <span>aalassim@gmail.com.com</span>
            </div>
        </div>
        <div class="sidebar-menu">
             <div class="menu-head">
                <a href="{{url('/enseignant/dashboard')}}">Mon Profil</a>
                <!--<span>Mon Profil</span>-->
             </div>
             <ul>
                <li>
                    <a href="{{url('/enseignant/cours')}}">
                        <span class="la la-book"></span>
                        Mes Cours
                    </a>
                </li>
                <li>
                    <a href="{{url('/enseignant/evaluations')}}">
                    <span class="la la-wpforms"></span>
                      Evaluations
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-check-circle"></span>
                     Résultats étudiants
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-chalkboard-teacher"></span>
                        Réclamations
                       </a>
                </li>
                <li>
                    <a href="">
                    <span class="las la-envelope"></span>
                      boîte e-mails
                    </a>
                </li>
                
             </ul>
            </div>
        </div>
    </div>
    <div class="main-content">
        <header>
             <div class="menu-toggle">
                <label for="">
                    <span class="las la-bars"></span>
                        </label>
             </div>
        </header>
    </div>
</body>
</html>
       