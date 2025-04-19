<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Fiche Étudiant - Gestion des inscriptions</title>
    
    <link rel="icon" href="{{ asset('assets/img/logosvg.svg') }}" type="image/svg+xml">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .student-profile-card {
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 25px;
            position: relative;
        }
        
        .profile-actions {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        
        .profile-body {
            padding: 30px;
            background-color: white;
        }
        
        .info-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }
        
        .info-table th {
            width: 30%;
            color: #6c757d;
            font-weight: 500;
            padding: 10px 15px;
        }
        
        .info-table td {
            padding: 10px 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .section-title {
            color: #495057;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .btn-custom {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-back {
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
        }
        
        .btn-back:hover {
            background-color: #e9ecef;
        }
        
        .btn-view {
            background-color: #2575fc;
            color: white;
        }
        
        .btn-view:hover {
            background-color: #1a5dc8;
            color: white;
        }
    </style>
</head>
<body> 
<div class="dashboard-container">
    <div class="sidebar">
    </div>
    
    <div class="main-content">
        <header>
            <div class="menu-toggle">
                <label>
                    <span class="las la-bars"></span>
                </label>
            </div>
            
            <div class="container py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <i class="las la-user-graduate me-2"></i>
                        Fiche Étudiant
                    </h2>
                    <a href="{{ route('Admin.Lesinscriptions') }}" class="btn btn-custom btn-back">
                        <i class="las la-arrow-left me-1"></i>
                        Retour à la liste
                    </a>
                </div>
                
                <div class="student-profile-card">
                    <div class="profile-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-1">{{ $formattedData['nom_complet'] }}</h3>
                                <p class="mb-0">{{ $formattedData['email'] }}</p>
                            </div>
                            <div class="profile-actions">
                                <a href="{{ route('admin.etudiant.show', ['id_etudiant' => $etudiant->id_etudiant]) }}" 
                                   class="btn btn-custom btn-view">
                                    <i class="las la-eye me-1"></i>
                                    Voir fiche complète
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="profile-body">
                        <h4 class="section-title">
                            <i class="las la-info-circle me-2"></i>
                            Informations de base
                        </h4>
                        
                        <table class="info-table">
                            <tr>
                                <th>ID Étudiant</th>
                                <td>{{ $formattedData['id'] }}</td>
                            </tr>
                            <tr>
                                <th>Nom complet</th>
                                <td>{{ $formattedData['nom_complet'] }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <a href="mailto:{{ $formattedData['email'] }}">
                                        {{ $formattedData['email'] }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                        
                        <!-- <h4 class="section-title mt-5">
                            <i class="las la-book me-2"></i>
                            Inscriptions aux cours
                        </h4>
                        ... --
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
</body>
</html>-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Fiche Étudiant - Gestion des inscriptions</title>
    
    <link rel="icon" href="{{ asset('assets/img/logosvg.svg') }}" type="image/svg+xml">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .btn-retour {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 10px 10px 10px;
            margin-left: 50px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }
        
        .btn-retour:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #212529;
        }
        
        .btn-retour:active {
            transform: translateY(0);
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        
        .btn-retour i {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }
        
        .btn-retour:hover i {
            transform: translateX(-3px);
        }
        
        /* Effet de vague au survol */
        .btn-retour::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(0, 0, 0, 0.1);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }
        
        .btn-retour:hover::after {
            animation: ripple 0.6s ease-out;
        }
        
        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }
        
        /* Centrage de la page */
        .main-content {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .main-content header {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem 0;
        }
        
        .student-container {
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .student-profile-card {
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px 0;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 30px;
            position: relative;
        }
        
        .profile-actions {
            position: absolute;
            top: 25px;
            right: 25px;
        }
        
        .profile-body {
            padding: 35px;
            background-color: white;
        }
        
        .info-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }
        
        .info-table th {
            width: 30%;
            color: #6c757d;
            font-weight: 500;
            padding: 12px 20px;
        }
        
        .info-table td {
            padding: 12px 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .section-title {
            color: #495057;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 12px;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .btn-custom {
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-back {
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
        }
        
        .btn-back:hover {
            background-color: #e9ecef;
        }
        
        .btn-view {
            background-color: #2575fc;
            color: white;
        }
        
        .btn-view:hover {
            background-color: #1a5dc8;
            color: white;
        }
        
        .page-header {
            margin-bottom: 30px;
        }
        
        @media (max-width: 768px) {
            .profile-header {
                padding: 25px 15px;
            }
            
            .profile-actions {
                position: static;
                margin-top: 15px;
                text-align: right;
            }
            
            .profile-body {
                padding: 25px 15px;
            }
            
            .info-table th, 
            .info-table td {
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body> 
<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{asset('assets/img/logosvg.svg')}}" width="50px" alt="Logo">
               <div class="brand-icons">
                <span class="las la-bell"></span>
                <span class="las la-user-circle"></span>
               </div>
            </div>
        </div>
        
        <div class="sidebar-user">
            <img src="{{asset('assets/img/carousel-1.jpg')}}" height=50 width=50 alt="Photo de profil">
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
                    <a href="{{url('AdminCours')}}" class="{{ request()->is('AdminCours') ? 'active' : '' }}">
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
                    <a href="{{url('/AdminForums')}}" class="{{ request()->is('AdminForums') ? 'active' : '' }}">
                    <span class="la la-wpforms"></span>
                      Forums
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminInscription')}}" class="{{ request()->is('AdminInscription') ? 'active' : '' }}">
                        <span class="la la-check-circle"></span>
                        Les inscriptions
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminProfesseurs')}}" class="{{ request()->is('AdminProfesseurs') ? 'active' : '' }}">
                        <span class="la la-chalkboard-teacher"></span>
                        Les professeurs
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminFormations')}}" class="{{ request()->is('AdminFormations') ? 'active' : '' }}">
                    <span class="la la-chalkboard"></span>
                      Les Formations 
                    </a>
                </li>
                <li>
                    <a href="{{url('/AdminMails')}}" class="{{ request()->is('AdminMails') ? 'active' : '' }}">
                    <span class="las la-envelope"></span>
                      Boîte e-mails
                    </a>
                </li>
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
    
    
            
            <div class="student-container">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">
                            <i class="las la-user-graduate me-2"></i>
                            Fiche Étudiant
                        </h2><br/>
                       
                        <a href="{{ route('Admin.Lesinscriptions') }}" class="btn-retour">
                    <i class="las la-arrow-left"></i>
                    Retour à la liste
                </a>
                    </div>
                </div>
                
                <div class="student-profile-card">
                    <div class="profile-header">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div>
                                <h3 class="mb-1">{{ $formattedData['nom_complet'] }}</h3>
                                <p class="mb-0">{{ $formattedData['email'] }}</p>
                            </div>
                            <div class="profile-actions">
                                <!--<a href="{{ route('admin.etudiant.show', ['id_etudiant' => $etudiant->id_etudiant]) }}" 
                                   class="btn btn-custom btn-view">
                                    <i class="las la-eye me-1"></i>
                                    Voir fiche complète
                                </a>-->
                            </div>
                        </div>
                    </div>
                    
                    <div class="profile-body">
                        <h4 class="section-title">
                            <i class="las la-info-circle me-2"></i>
                            Informations de base
                        </h4>
                        
                        <table class="info-table">
                            <tr>
                                <th>ID Étudiant</th>
                                <td>{{ $formattedData['id'] }}</td>
                            </tr>
                            <tr>
                                <th>Nom complet</th>
                                <td>{{ $formattedData['nom_complet'] }}</td>
                            </tr>
                            <tr>
                                <th>CNI</th>
                                <td>{{ $formattedData['cni'] }}</td>
                            </tr>
                            <tr>
                                <th>Téléphone</th>
                                <td>{{ $formattedData['téléphone'] }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <a href="mailto:{{ $formattedData['email'] }}">
                                        {{ $formattedData['email'] }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
</body>
</html>