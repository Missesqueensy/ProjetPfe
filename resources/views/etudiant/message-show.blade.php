<!--<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie - {{ Auth::guard('etudiant')->user()->prénom }} {{ Auth::guard('etudiant')->user()->nom }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #c433ff;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        .messagerie-container {
            margin-left: 280px;
            padding: 2rem;
            background: #f5f7fa;
            min-height: 100vh;
        }
        
        .conversation-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }
        
        .conversation-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .avatar-group {
            background: var(--accent-color);
        }
        
        .message-preview {
            color: #6c757d;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 300px;
        }
        
        .time-badge {
            font-size: 0.8rem;
            color: #adb5bd;
        }
        
        .new-message-badge {
            background: var(--accent-color);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }
        
        .btn-new-conversation {
            background: var(--primary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .btn-new-conversation:hover {
            background: var(--secondary-color);
        }
        
        @media (max-width: 992px) {
            .messagerie-container {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <h4>Menu Étudiant</h4>
        <a href="{{route('etudiant.dashboardetd')}}" class="active">
            <i class="fas fa-home"></i> Accueil
        </a>
        <a href="{{route('cours.index')}}">
            <i class="fas fa-book"></i>Cours publiés
        </a>
        <a href="{{route('etudiant.cours')}}">
            <i class="fas fa-book"></i> Mes cours
        </a>
        <a href="{{ route('etudiant.notes') }}">
            <i class="fas fa-clipboard-list"></i> Notes
        </a>
        <a href="{{ route('etudiant.reclamations') }}">
            <i class="fas fa-envelope"></i> Réclamations
        </a>
        <a href="{{ route('etudiant.messagerie.index') }}">
            <i class="fas fa-comments"></i> Messagerie
        </a>
        <a href="{{ route('etudiant.parametres') }}">
            <i class="fas fa-cog"></i> Paramètres
        </a>

        <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <div>
                        <h4 class="mb-0">
                            Conversation avec 
                            @php
                                $otherParticipants = $conversation->participants
                                    ->where('id_etudiant', '!=', Auth::guard('etudiant')->user()->id_etudiant)
                                    ->pluck('etudiant');
                            @endphp
                            
                            @if($otherParticipants->count() === 1)
                                {{ $otherParticipants->first()->nom }} {{ $otherParticipants->first()->prénom }}
                            @else
                                Groupe ({{ $otherParticipants->count() }} participants)
                            @endif
                        </h4>
                    </div>
                    <a href="{{ route('etudiant.messagerie.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>

                <div class="card-body chat-container" id="chat-messages">
                    @foreach($messages as $message)
                        <div class="message @if($message->id_etudiant == Auth::guard('etudiant')->user()->id_etudiant) sent @else received @endif">
                            <div class="message-content">
                                <div class="message-header">
                                    <strong>{{ $message->etudiant->nom }}</strong>
                                    <small class="text-muted ms-2">
                                        {{ $message->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                                <div class="message-body">
                                    {{ $message->content }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer">
                    <form method="POST" action="{{ route('etudiant.messagerie.send', $conversation) }}" class="message-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="message" 
                                   placeholder="Écrivez votre message..." required autofocus>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i> Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .chat-container {
        height: 60vh;
        overflow-y: auto;
        padding: 20px;
        background-color: #f8f9fa;
    }
    
    .message {
        margin-bottom: 15px;
        display: flex;
    }
    
    .message.sent {
        justify-content: flex-end;
    }
    
    .message.received {
        justify-content: flex-start;
    }
    
    .message-content {
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 18px;
        position: relative;
    }
    
    .message.sent .message-content {
        background-color: #007bff;
        color: white;
        border-bottom-right-radius: 0;
    }
    
    .message.received .message-content {
        background-color: #e9ecef;
        color: #495057;
        border-bottom-left-radius: 0;
    }
    
    .message-header {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
        font-size: 0.9rem;
    }
    
    .message.sent .message-header {
        justify-content: flex-end;
        color: rgba(255,255,255,0.8);
    }
    
    .message-body {
        word-wrap: break-word;
    }
    
    .message-form {
        margin-top: 20px;
    }
</style>

<script>
    // Faire défiler vers le bas automatiquement
    document.addEventListener('DOMContentLoaded', function() {
        const chatContainer = document.getElementById('chat-messages');
        chatContainer.scrollTop = chatContainer.scrollHeight;
        
        // Optionnel: Recharger les nouveaux messages périodiquement
        setInterval(function() {
            fetch(window.location.href)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newMessages = doc.getElementById('chat-messages').innerHTML;
                    if (newMessages !== document.getElementById('chat-messages').innerHTML) {
                        document.getElementById('chat-messages').innerHTML = newMessages;
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }
                });
        }, 5000); // Toutes les 5 secondes
    });
</script>
</body>
</html>--> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie - {{ Auth::guard('etudiant')->user()->prénom }} {{ Auth::guard('etudiant')->user()->nom }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/etudiantdash.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #c433ff;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Sidebar styles */
        .sidebar {
            width: 280px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .sidebar h4 {
            color: white;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
        }
        
        .sidebar a {
            display: block;
            color: white;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(255,255,255,0.2);
        }
        
        .sidebar a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .btn-logout {
            background: transparent;
            border: none;
            color: white;
            width: 100%;
            text-align: left;
            padding: 12px 15px;
            border-radius: 8px;
            cursor: pointer;
        }
        
        .btn-logout:hover {
            background-color: rgba(255,255,255,0.2);
        }
        
        .menu-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1100;
            background: var(--primary-color);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        /* Main content area */
        .messagerie-container {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        /* Chat container styles */
        .chat-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .chat-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .chat-header h4 {
            margin: 0;
            font-weight: 600;
        }
        
        .back-btn {
            color: white;
            background: rgba(255,255,255,0.2);
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .chat-container {
            height: 60vh;
            overflow-y: auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        
        .message {
            margin-bottom: 15px;
            display: flex;
            max-width: 80%;
        }
        
        .message.sent {
            margin-left: auto;
            justify-content: flex-end;
        }
        
        .message.received {
            margin-right: auto;
            justify-content: flex-start;
        }
        
        .message-content {
            padding: 12px 16px;
            border-radius: 18px;
            position: relative;
            word-wrap: break-word;
        }
        
        .message.sent .message-content {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-bottom-right-radius: 0;
        }
        
        .message.received .message-content {
            background-color: white;
            color: #495057;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-bottom-left-radius: 0;
        }
        
        .message-header {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            font-size: 0.85rem;
        }
        
        .message.sent .message-header {
            justify-content: flex-end;
            color: rgba(255,255,255,0.8);
        }
        
        .message.received .message-header strong {
            color: var(--primary-color);
        }
        
        .message-time {
            font-size: 0.75rem;
            opacity: 0.8;
            margin-left: 8px;
        }
        
        .message-form {
            padding: 15px;
            background-color: white;
            border-top: 1px solid #eee;
        }
        
        .message-input {
            border-radius: 20px;
            padding: 12px 20px;
            border: 1px solid #ddd;
            resize: none;
        }
        
        .send-btn {
            border: none;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-left: 10px;
        }
        
        /* Responsive styles */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .messagerie-container {
                margin-left: 0;
                padding: 1rem;
            }
            
            .menu-toggle {
                display: block;
            }
        }
        
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>
<body>
    
        <div class="sidebar">
        <h4>Menu Étudiant</h4>
        <a href="{{ route('etudiant.dashboardetd') }}">
            <i class="fas fa-home me-2"></i>Accueil
        </a>
        <a href="{{ route('cours.index') }}">
            <i class="fas fa-book me-2"></i>Cours publiés
        </a>
        <a href="{{ route('etudiant.cours') }}">
            <i class="fas fa-book-open me-2"></i>Mes cours
        </a>
        <a href="{{ route('etudiant.evaluations.index') }}">

                    <i class="fas fa-clipboard-check"></i> Évaluations
                    </a>
        <a href="{{ route('etudiant.notes') }}">
            <i class="fas fa-clipboard-list me-2"></i>Notes
        </a>
        <a href="{{ route('etudiant.formulaires.index') }}" >
            <i class="fas fa-file-alt me-2"></i>Formulaires
        </a>
        <a href="{{ route('etudiant.reclamations') }}">
            <i class="fas fa-exclamation-circle me-2"></i>Réclamations
        </a>
        <a href="{{ route('etudiant.messagerie.index') }}">
            <i class="fas fa-comments me-2"></i>Messagerie
        </a>
        <a href="{{ route('etudiant.parametres') }}">
            <i class="fas fa-cog me-2"></i>Paramètres
        </a>
         <form action="{{ route('etudiant.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>

    <div class="messagerie-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="chat-card">
                        <div class="chat-header">
                            <h4>
                                @php
                                    $otherParticipants = $conversation->participants
                                        ->where('id_etudiant', '!=', Auth::guard('etudiant')->user()->id_etudiant)
                                        ->pluck('etudiant');
                                @endphp
                                
                                @if($otherParticipants->count() === 1)
                                    {{ $otherParticipants->first()->nom }} {{ $otherParticipants->first()->prénom }}
                                @else
                                    Groupe ({{ $otherParticipants->count() }} participants)
                                @endif
                            </h4>
                            <a href="{{ route('etudiant.messagerie.index') }}" class="back-btn">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>

                        <div class="chat-container" id="chat-messages">
                            @foreach($messages as $message)
                                <div class="message @if($message->id_etudiant == Auth::guard('etudiant')->user()->id_etudiant) sent @else received @endif">
                                    <div class="message-content">
                                        <div class="message-header">
                                            <strong>{{ $message->etudiant->nom }}</strong>
                                            <span class="message-time">
                                                {{ $message->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                        <div class="message-body">
                                            {{ $message->content }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="message-form">
                            <form method="POST" action="{{ route('etudiant.messagerie.send', $conversation) }}" class="d-flex align-items-center">
                                @csrf
                                <input type="text" class="form-control message-input" name="message" 
                                       placeholder="Écrivez votre message..." required autofocus>
                                <button class="send-btn" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menu toggle functionality
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Auto-scroll to bottom of chat
        document.addEventListener('DOMContentLoaded', function() {
            const chatContainer = document.getElementById('chat-messages');
            chatContainer.scrollTop = chatContainer.scrollHeight;
            
            // Optional: Auto-refresh messages every 5 seconds
            setInterval(function() {
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newMessages = doc.getElementById('chat-messages').innerHTML;
                        if (newMessages !== document.getElementById('chat-messages').innerHTML) {
                            document.getElementById('chat-messages').innerHTML = newMessages;
                            chatContainer.scrollTop = chatContainer.scrollHeight;
                        }
                    });
            }, 5000);
        });

        // Keep scroll at bottom when new messages arrive
        const observer = new MutationObserver(function(mutations) {
            const chatContainer = document.getElementById('chat-messages');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
        
        observer.observe(document.getElementById('chat-messages'), {
            childList: true,
            subtree: true
        });
    </script>
</body>
</html>