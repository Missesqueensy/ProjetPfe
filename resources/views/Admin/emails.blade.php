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
    <style>
        .gmail-container {
            background: #f5f5f5;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .gmail-header {
            background:#0d6efd ;
            color: white;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            margin-bottom: 20px;
        }
        .gmail-btn {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .gmail-btn:hover {
            background: #0d6efd;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .info-box {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #0d6efd;
        }
    </style>
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
                    <a href="{{url('AdminCours')}}">
                        <span class="la la-book"></span>
                        Les Cours
                    </a>
                </li>
                <li>
                <a href="{{url('adminAnalyses')}}">

                    <span class="las la-chart-pie"></span>
                      Réclamations
                    </a>
                </li>
                
                <li>
                    <a href="{{url('/AdminForums')}}">
                    <span class="la la-wpforms"></span>
                      Forums
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminInscription')}}">
                        <span class="la la-check-circle"></span>
                        Les inscriptions
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminProfesseurs')}}">
                        <span class="la la-chalkboard-teacher"></span>
                        Les professeurs
                       </a>
                </li>
                <li>
                    <a href="{{url('/AdminFormations')}}">
                    <span class="la la-chalkboard"></span>
                      les Formations 
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminMails')}}">
                    <span class="las la-envelope"></span>
                      boîte e-mails
                    </a>
                </li>
                <li>
                <li>
    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">
            <span class="las la-sign-out-alt"></span>
            Déconnexion
        </button>
    </form>
</li>
             </ul>
            </div>
    </div>
</div>
<div class="main-content">
        <header>
            <h1>Boîte emails</h1>
        </header>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="gmail-container">
                    <div class="gmail-header d-flex justify-content-between align-items-center">
                        <!--<h3><i class="fas fa-envelope me-2"></i> Boîte Mail Administrateur</h3>-->
                        <a href="https://mail.google.com" target="_blank" class="gmail-btn">
                            <i class="fab fa-google me-2"></i> Ouvrir Gmail
                        </a>
                    </div>

                    <div class="info-box">
                        <h5><i class="fas fa-info-circle text-primary me-2"></i> Comment accéder à vos emails</h5>
                        <p class="mb-0">Cliquez sur le bouton "Ouvrir Gmail" ci-dessus pour accéder directement à votre boîte Gmail dans un nouvel onglet.</p>
                    </div>

                    <div class="text-center py-4">
                        <div class="alert alert-info d-inline-block">
                            <!--<i class="fas fa-sync-alt me-2"></i> Cette page ne montre pas directement les emails pour des raisons de sécurité.</i>-->
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=contact@votresite.com" 
                           target="_blank"
                           class="btn btn-outline-danger">
                           <i class="fas fa-paper-plane me-2"></i> Envoyer un email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Option: Ouvrir Gmail automatiquement dans un nouvel onglet au chargement
        // window.open('https://mail.google.com', '_blank');
    </script>
</body>
</html>