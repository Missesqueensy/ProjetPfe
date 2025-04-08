<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    
    <!--<link rel="stylesheet" href="Admindash.css">-->
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">

    <title>Admin Dashboard Panel</title>
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
            <img src="{{asset('assets/img/carousel-1.jpg')}}" height=50 width=50 alt="">
            <div>
                <h3>AHLAME LAD</h3>
                <span>Ladahlame@admin.com</span>
            </div>
        </div>
        <div class="sidebar-menu">
             <div class="menu-head">
                <span>Dashboard</span>
             </div>
             <ul>
                <li>
                    <a href="">
                        <span class="la la-book"></span>
                        Les Cours
                    </a>
                </li>
                <li>
                    <a href="">
                    <span class="las la-chart-pie"></span>
                      Analyses
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="las la-calendar"></span>
                        calendrier
                    </a>
                </li>
                <li>
                    <a href="">
                    <span class="la la-wpforms"></span>
                      Forums
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-check-circle"></span>
                        Les inscriptions
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="la la-chalkboard-teacher"></span>
                        Les professeurs
                       </a>
                </li>
                <li>
                    <a href="">
                    <span class="la la-chalkboard"></span>
                      les Formations 
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
        <div class="header-icons">
                <span class="las la-search"></span>
                <span class="las la-bookmark"></span>
                <span class="las la-sms"></span>
            </div>
        </header>
        <main>
            <div class="page-header">
               <div>
                <h1>Dashboard Analyses</h1>
                <small style="color:#8da2fb">voir les Avis étudiants</small>
               </div>
               <div class="header-actions">
                <button>
                    <span class="las la-file-export"></span>
                    Export
                </button>
                <button>
                    <span class="las la-tools"></span>
                    Paramètres
                </button>
               </div>
            </div>
            <div class="cards">
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                                <span>Visiteurs</span>
                                <small>Nombre de Visiteurs</small>
                            </div>
                            <h2>17,663</h2>
                            <!--<small>-2% des visiteurs</small>--> 
                            <small><i class="la la-arrow-down" style="color: red;"></i> -2% des visiteurs</small>

                        </div>
                    </div>
                </div>
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                                <span>Cours</span>
                                <small>Nombre de Cours</small>
                            </div>
                            <h2>120</h2>
                            <small><i class="la la-arrow-up" style="color: green;"></i> +1% des Cours</small>
                        </div>
                    </div>
                </div>
                    <!--test-->
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                                <span>nouveaux étudiants</span>
                                <small>Nombre des étudiants</small>
                            </div>
                            <h2>4000</h2>
                            <small><i class="la la-arrow-up" style="color: green;"></i> +5% des étudiants</small>

                        </div>
                    </div>
                </div>
                <!--<div class="cards">-->
                <div class="card-single">
                    <div class="card-flex">
                        <div class="card-info">
                            <div class="card-head">
                                <span>Professeurs</span>
                                <small>Nombre des Professeurs</small>
                            </div>
                            <h2>200</h2>
                            <small><i class="la la-arrow-up" style="color: green;"></i> +6% des Professeurs</small>

                        </div>
                    </div>
                </div>
            </div>
                    
            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text" style="color:#8da2fb">Nouvelles Actifités</span>
                </div>

            <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Noms</span></br>
                        <span class="data-list">Prem Shahi</span>
                        <span class="data-list">Deepa Chand</span>
                        <span class="data-list">Manisha Chand</span>
                        <span class="data-list">Pratima Shahi</span>
                        <span class="data-list">Man Shahi</span>
                        <span class="data-list">Ganesh Chand</span>
                        <span class="data-list">Bikash Chand</span>
                    </div>
                    <div class="data email">
                        <span class="data-title">Email</span></br>
                        <span class="data-list">laminelaila@gmail.com</span>
                        <span class="data-list">deenalami@gmail.com</span>
                        <span class="data-list">ahmedsahil@gmail.com</span>
                        <span class="data-list">mustaphadass@gmail.com</span>
                        <span class="data-list">imranesalhi@gmail.com</span>
                        <span class="data-list">mouniadaoud@gmail.com</span>
                        <span class="data-list">allaelad@gmail.com</span>
                    </div>
                    <div class="data joined">
                        <span class="data-title">Joined</span></br>
                        <span class="data-list">2025-02-12</span>
                        <span class="data-list">2025-02-12</span>
                        <span class="data-list">2025-02-13</span>
                        <span class="data-list">2025-02-13</span>
                        <span class="data-list">2025-02-14</span>
                        <span class="data-list">2025-02-14</span>
                        <span class="data-list">2025-02-15</span>
                    </div>
                    <div class="data type">
                        <span class="data-title">Type</span></br>
                        <span class="data-list">Nouveau </span>
                        <span class="data-list">Membre</span>
                        <span class="data-list">Membre</span>
                        <span class="data-list">Nouveau</span>
                        <span class="data-list">Membre</span>
                        <span class="data-list">Nouveau</span>
                        <span class="data-list">Membre</span>
                    </div>
                    <div class="data status">
                        <span class="data-title">Statut</span></br>
                        <span class="data-list">Professeur</span>
                        <span class="data-list">Etudiant</span>
                        <span class="data-list">Etudiant</span>
                        <span class="data-list">Professeur</span>
                        <span class="data-list">Professeur</span>
                        <span class="data-list">Etudiant</span>
                        <span class="data-list">Etudiant</span>
                    </div>
                </div>
            </div>
        </div>

                
        </main>
    </div>
</body>
</html> 