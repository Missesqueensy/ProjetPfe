<!--<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/css/Inscription.css') }}">
        <title>Register</title>
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
                <header>S'inscrire Aprenant</header>
               <form action="{{ url('/inscription') }}" method="POST">
              <div class="img-field">
                <a href="{{asset('assets/img/guy.jpg')}}"></a>
              </div>
                    @csrf
                    <div class="field input">
                        <label for="Nom">Nom:</label>
                        <input type="text" name="nom" id="Nom" required>
                    </div>
                    <div class="field input">
                        <label for="Prenom">Prénom:</label>
                        <input type="text" name="prénom" id="prenom" required>
                    </div>
                    <div class="field input">
                        <label for="Email">Email:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="field input">
                        <label for="passwd">Mot de Passe:</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="field input">
    <label for="password_confirmation">Confirmer le mot de passe:</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>
</div>
                    <div class="field input">
                        <label for="tel">Tel:</label>
                        <input type="text" name="tel" id="tel" required>
                    </div>
                    <div class="field input">
                        <label for="CNI">CNI:</label>
                        <input type="text" name="CNI" id="CNI" required> 
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="S'inscrire">
                    </div>
                    <div class="links">
                        Vous avez déjà un compte? <a href="{{ route('login') }}">Se Connecter</a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </body>
</html>-->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/css/Inscription.css') }}">
        <title>Inscription</title>
        <style>
            .tab-container {
                display: flex;
                margin-bottom: 20px;
            }
            .tab {
                padding: 10px 20px;
                cursor: pointer;
                background-color: #f1f1f1;
                border: none;
                outline: none;
                flex: 1;
                text-align: center;
                transition: 0.3s;
            }
            .tab.active {
                background-color: #4CAF50;
                color: white;
            }
            .form-container {
                display: none;
            }
            .form-container.active {
                display: block;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
                <div class="tab-container">
                    <button class="tab active" onclick="openForm('studentForm')">Étudiant</button>
                    <button class="tab" onclick="openForm('teacherForm')">Enseignant</button>
                </div>

                <div id="studentForm" class="form-container active">
                    <header>S'inscrire comme Étudiant</header>
<form action="{{ route('register.etudiant') }}" method="POST">

                        @csrf
                        <div class="field input">
                            <label for="student_nom">Nom:</label>
                            <input type="text" name="nom" id="student_nom" required>
                        </div>
                        <div class="field input">
                            <label for="student_prenom">Prénom:</label>
                            <input type="text" name="prenom" id="student_prenom" required>
                        </div>
                        <div class="field input">
                            <label for="student_email">Email:</label>
                            <input type="email" name="email" id="student_email" required>
                        </div>
                        <div class="field input">
                            <label for="student_password">Mot de Passe:</label>
                            <input type="password" name="password" id="student_password" required>
                        </div>
                        <div class="field input">
                            <label for="student_password_confirmation">Confirmer le mot de passe:</label>
                            <input type="password" name="password_confirmation" id="student_password_confirmation" required>
                        </div>
                        <div class="field input">
                            <label for="student_tel">Téléphone:</label>
                            <input type="text" name="tel" id="student_tel" required>
                        </div>
                        <div class="field input">
                            <label for="student_cni">CNI:</label>
                            <input type="text" name="cni" id="student_cni" required> 
                        </div>
                        <div class="field">
                            <input type="submit" class="btn" name="submit" value="S'inscrire">
                        </div>
                    </form>
                </div>

                <div id="teacherForm" class="form-container">
                    <header>S'inscrire comme Enseignant</header>
<form action="{{ route('enseignant.register') }}" method="POST">

                        @csrf
                        <div class="field input">
                            <label for="teacher_nom">Nom:</label>
                            <input type="text" name="nom" id="teacher_nom" required>
                        </div>
                        <div class="field input">
                            <label for="teacher_prenom">Prénom:</label>
                            <input type="text" name="prenom" id="teacher_prenom" required>
                        </div>
                        <div class="field input">
                            <label for="teacher_email">Email:</label>
                            <input type="email" name="email" id="teacher_email" required>
                        </div>
                        <div class="field input">
                            <label for="teacher_password">Mot de Passe:</label>
                            <input type="password" name="password" id="teacher_password" required>
                        </div>
                        <div class="field input">
                            <label for="teacher_password_confirmation">Confirmer le mot de passe:</label>
                            <input type="password" name="password_confirmation" id="teacher_password_confirmation" required>
                        </div>
                        <div class="field input">
                            <label for="teacher_specialite">Spécialité:</label>
                            <input type="text" name="specialite" id="teacher_specialite" required>
                        </div>
                        <div class="field input">
                            <label for="teacher_departement">Département:</label>
                            <select name="departement" id="teacher_departement" required>
                                <option value="">Sélectionnez un département</option>
                                <option value="Informatique">Informatique</option>
                                <option value="Mathématiques">Mathématiques</option>
                                <option value="Physique">Physique</option>
                                <option value="Chimie">Chimie</option>
                                <option value="Biologie">Biologie</option>
                            </select>
                        </div>
                        <div class="field">
                            <input type="submit" class="btn" name="submit" value="S'inscrire">
                        </div>
                    </form>
                </div>

                <div class="links">
    Vous avez déjà un compte? 
    <span id="student-login-link" class="login-option">
        <a href="{{ route('login') }}">Étudiant</a>
    </span>
    <span class="separator">|</span>
    <span id="teacher-login-link" class="login-option">
        <a href="{{ route('enseignant.login') }}">Enseignant</a>
    </span>
</div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <script>
            function openForm(formName) {
                // Masquer tous les formulaires
                const formContainers = document.getElementsByClassName('form-container');
                for (let i = 0; i < formContainers.length; i++) {
                    formContainers[i].classList.remove('active');
                }
                
                // Désactiver tous les onglets
                const tabs = document.getElementsByClassName('tab');
                for (let i = 0; i < tabs.length; i++) {
                    tabs[i].classList.remove('active');
                }
                
                // Afficher le formulaire sélectionné et activer l'onglet correspondant
                document.getElementById(formName).classList.add('active');
                event.currentTarget.classList.add('active');
            }
        </script>
    </body>
</html>