
<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <title>Détails du Formulaire - Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<body> 
<div class="dashboard-container">
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{asset('assets/img/logosvg.svg')}}" width="50px" alt="">
               <div class="brand-icons">
                <span class="las la-beli"></span>
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

        <div class="formulaire-container">
            <div class="formulaire-detail card">
                <div class="formulaire-header">
                    <h1>{{ $formulaire->titre }}</h1>
                    <div class="formulaire-meta">
                        <span class="meta-item">
                            <i class="las la-user"></i> 
                            {{ $formulaire->etudiant->nom ?? 'Inconnu' }}
                        </span>
                        <span class="meta-item">
                            <i class="las la-calendar"></i> 
                            {{ $formulaire->created_at->format('d/m/Y H:i') }}
                        </span>
                        <span class="meta-item">
                            <i class="las la-eye"></i> 
                            {{ $formulaire->views_count ?? 0 }} vues
                        </span>
                        <span class="meta-item">
                            <i class="las la-comments"></i> 
                            {{ $formulaire->comments_count ?? 0 }} commentaires
                        </span>
                    </div>
                </div>

                <div class="formulaire-content">
                    <p>{{ $formulaire->contenu }}</p>
                    
                    @if($formulaire->image)
                        <div class="formulaire-image">
                            <img src="{{ asset('storage/' . $formulaire->image) }}" alt="Image du formulaire" class="img-responsive">
                        </div>
                    @endif
                </div>

                <div class="formulaire-footer">
                    <span class="badge {{ $formulaire->type === 'question' ? 'badge-primary' : 'badge-info' }}">
                        {{ $formulaire->type === 'question' ? 'Question' : 'Explication' }}
                    </span>
                    <span class="badge {{ $formulaire->statut === 'résolu' ? 'badge-success' : 'badge-warning' }}">
                        {{ ucfirst($formulaire->statut) }}
                    </span>
                </div>
            </div>

            <div class="commentaires-section card">
                <h2><i class="las la-comments"></i> Commentaires</h2>
                
                @if($formulaire->comments && $formulaire->comments->count() > 0)
                    <div class="commentaires-list">
                        @foreach($formulaire->comments as $comment)
                            <div class="commentaire-item">
                                <div class="commentaire-header">
                                    <img src="{{ asset('assets/img/user-default.png') }}" alt="{{ $comment->auteur->nom }}" class="commentaire-avatar">
                                    <div class="commentaire-auteur">
                                        <strong>{{ $comment->auteur->nom }}</strong>
                                        <span class="commentaire-date">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="commentaire-content">
                                    {{ $comment->contenu }}
                                </div>
                                @if($comment->image)
                                    <div class="commentaire-image">
                                        <img src="{{ asset('storage/' . $comment->image) }}" alt="Image du commentaire" class="img-responsive">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-commentaires">
                        <p>Aucun commentaire pour le moment.</p>
                    </div>
                @endif
            </div>

            <div class="autres-formulaires card">
                <h2><i class="las la-list"></i> Autres formulaires</h2>
                <ul class="formulaires-list">
                 @if(isset($formulaires) && $formulaires->count())
                @foreach($formulaires as $autre)
    @if(is_object($autre) && isset($autre->id_formulaire))
        <li>
            <a href="{{ route('admin.Unformulaire.show', ['formulaire' => $autre->id_formulaire]) }}">
                <div class="formulaire-item">
                    <h3>{{ $autre->titre }}</h3>
                    <div class="formulaire-item-meta">
                        <span>{{ $autre->etudiant->nom ?? 'Inconnu' }}</span>
                        <span>{{ $autre->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="formulaire-item-stats">
                        <span><i class="las la-comment"></i> {{ $autre->commentaires->count() }}</span>
                        <span><i class="las la-eye"></i> {{ $autre->vues ?? 0 }}</span>
                    </div>
                </div>
            </a>
        </li>
    @endif
@endforeach
@else
    <p>Aucun formulaire trouvé.</p>
@endif
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>--> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/css/admindash.css') }}">
    <title>Détails du Formulaire - Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        /* Styles supplémentaires pour améliorer l'affichage */
        .formulaire-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .formulaire-detail {
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .formulaire-header {
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #eaeaea;
        }
        
        .formulaire-header h1 {
            margin: 0 0 10px 0;
            color: #2c3e50;
            font-size: 24px;
        }
        
        .formulaire-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .formulaire-content {
            padding: 20px;
            line-height: 1.6;
            color: #34495e;
        }
        
        .formulaire-image {
            margin: 20px 0;
            text-align: center;
        }
        
        .formulaire-image img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .formulaire-footer {
            padding: 15px 20px;
            background: #f8f9fa;
            border-top: 1px solid #eaeaea;
            display: flex;
            gap: 10px;
        }
        
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .badge-primary {
            background: #3498db;
            color: white;
        }
        
        .badge-info {
            background: #1abc9c;
            color: white;
        }
        
        .badge-success {
            background: #2ecc71;
            color: white;
        }
        
        .badge-warning {
            background: #f39c12;
            color: white;
        }
        
        .commentaires-section, .autres-formulaires {
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .commentaires-section h2, .autres-formulaires h2 {
            padding: 15px 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #eaeaea;
            margin: 0;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .commentaires-list {
            padding: 0;
        }
        
        .commentaire-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .commentaire-item:last-child {
            border-bottom: none;
        }
        
        .commentaire-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .commentaire-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        
        .commentaire-auteur {
            display: flex;
            flex-direction: column;
        }
        
        .commentaire-date {
            font-size: 12px;
            color: #95a5a6;
        }
        
        .commentaire-content {
            margin-left: 50px;
            margin-bottom: 10px;
        }
        
        .commentaire-image {
            margin-left: 50px;
            margin-top: 10px;
        }
        
        .commentaire-image img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        
        .no-commentaires {
            padding: 20px;
            text-align: center;
            color: #95a5a6;
        }
        
        .formulaires-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .formulaires-list li {
            border-bottom: 1px solid #f1f1f1;
        }
        
        .formulaires-list li:last-child {
            border-bottom: none;
        }
        
        .formulaires-list a {
            display: block;
            padding: 15px 20px;
            color: inherit;
            text-decoration: none;
            transition: background 0.2s;
        }
        
        .formulaires-list a:hover {
            background: #f8f9fa;
        }
        
        .formulaire-item h3 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: #2c3e50;
        }
        
        .formulaire-item-meta {
            display: flex;
            gap: 10px;
            font-size: 13px;
            color: #7f8c8d;
            margin-bottom: 5px;
        }
        
        .formulaire-item-stats {
            display: flex;
            gap: 15px;
            font-size: 13px;
            color: #7f8c8d;
        }
        
        .formulaire-item-stats span {
            display: flex;
            align-items: center;
            gap: 3px;
        }
        
        @media (max-width: 768px) {
            .formulaire-meta {
                flex-direction: column;
                gap: 8px;
            }
            
            .formulaire-header, .formulaire-content, .commentaire-item, .formulaires-list a {
                padding: 15px;
            }
        }
    </style>
</head>
<body> 
<div class="dashboard-container">
    <!-- Sidebar (identique à votre version) -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="{{asset('assets/img/logosvg.svg')}}" width="50px" alt="">
               <div class="brand-icons">
                <span class="las la-beli"></span>
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

        <div class="formulaire-container">
            <!-- Détails du formulaire -->
            <div class="formulaire-detail card">
                <div class="formulaire-header">
                    <h1>{{ $formulaire->titre }}</h1>
                    <div class="formulaire-meta">
                        <span class="meta-item">
                            <i class="las la-user"></i> 
                            {{ $formulaire->etudiant->nom ?? 'Inconnu' }}
                        </span>
                        <span class="meta-item">
                            <i class="las la-calendar"></i> 
                            {{ $formulaire->created_at->format('d/m/Y H:i') }}
                        </span>
                        <span class="meta-item">
                            <i class="las la-eye"></i> 
                            {{ $formulaire->views_count ?? 0 }} vues
                        </span>
                        <span class="meta-item">
                            <i class="las la-comments"></i> 
                            {{ $formulaire->comments_count ?? 0 }} commentaires
                        </span>
                    </div>
                </div>

                <div class="formulaire-content">
                    <p>{!! nl2br(e($formulaire->contenu)) !!}</p>
                    
                    @if($formulaire->image)
                        <div class="formulaire-image">
                            <img src="{{ asset('storage/' . $formulaire->image) }}" alt="Image du formulaire" class="img-responsive">
                        </div>
                    @endif
                </div>

                <div class="formulaire-footer">
                    <span class="badge {{ $formulaire->type === 'question' ? 'badge-primary' : 'badge-info' }}">
                        {{ $formulaire->type === 'question' ? 'Question' : 'Explication' }}
                    </span>
                    <span class="badge {{ $formulaire->statut === 'résolu' ? 'badge-success' : 'badge-warning' }}">
                        {{ ucfirst($formulaire->statut) }}
                    </span>
                </div>
            </div>

            <!-- Section Commentaires -->
         <div class="commentaires-section card">
    <h2><i class="las la-comments"></i> Commentaires ({{ $formulaire->commentaires->count() }})</h2>
    
    @if($formulaire->commentaires->isNotEmpty())
        <div class="commentaires-list">
            @foreach($formulaire->commentaires as $comment)
                <div class="commentaire-item">
                    <div class="commentaire-header">
                        <img src="{{ asset('assets/img/user-default.png') }}" alt="{{ $comment->etudiant->nom ?? 'Anonyme' }}" class="commentaire-avatar">
                        <div class="commentaire-auteur">
                            <strong>{{ $comment->etudiant->nom ?? 'Anonyme' }}</strong>
                            <span class="commentaire-date">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="commentaire-content">
                        {!! nl2br(e($comment->contenu)) !!}
                    </div>
                    @if($comment->image)
                        <div class="commentaire-image">
                            <img src="{{ asset('storage/' . $comment->image) }}" alt="Image du commentaire" class="img-responsive">
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="no-commentaires">
            <p>Aucun commentaire pour le moment.</p>
        </div>
    @endif
</div>

            <!-- Autres formulaires -->
            <div class="autres-formulaires card">
                <h2><i class="las la-list"></i> Autres formulaires</h2>
                <ul class="formulaires-list">
                    @forelse($formulaires as $autre)
                        @if($autre->id_formulaire !== $formulaire->id_formulaire)
                            <li>
                                <a href="{{ route('admin.Unformulaire.show', ['formulaire' => $autre->id_formulaire]) }}">
                                    <div class="formulaire-item">
                                        <h3>{{ Str::limit($autre->titre, 50) }}</h3>
                                        <div class="formulaire-item-meta">
                                            <span>{{ $autre->etudiant->nom ?? 'Inconnu' }}</span>
                                            <span>{{ $autre->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="formulaire-item-stats">
                                            <span><i class="las la-comment"></i> {{ $autre->comments_count ?? 0 }}</span>
                                            <span><i class="las la-eye"></i> {{ $autre->views_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @empty
                        <li style="padding: 20px; text-align: center; color: #95a5a6;">
                            Aucun autre formulaire trouvé.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>