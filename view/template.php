<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title> <?php echo $title; ?> </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="public/stylesheet.css" rel="stylesheet">

    </head>

    <body>
                                            <!--   HEADER     -->
                             <!--                                            -->
    <header>
        <nav id="main-nav">
            <div id="nav-logo">
                <img src="public/img/logop5.png"/>
            </div>
            <ul id="main-nav-ul">
                <li>
                   <a href=""> Accueil</a>
                </li>
                <li>
                    <a href=""> Populaires</a>
                </li>
                <li>
                    <a href=""> Top </a>
                </li>
                    <form id="form-recherche">
                        <input type="search" placeholder="Rechercher..." id="field-recherche" name="field-recherche" aria-label="formulaire de recherche">
                        <button><span class="material-icons">search</span></button>
                    </form>
            </ul>
            <div id="nav-user">
                <?php
                if(isset($_SESSION['pseudo'])){
                    echo "<div id=\"user-home-panel\">
                            <p id=\"user-dropdown\"> <span class=\"material-icons account-icon\">account_circle</span>".$_SESSION['pseudo']."</p>
                            <div id='user-dropdown-content'>
                                <a> Profil</a>
                                <a> Mes jeux</a>
                                <a href=\"index.php?action=deconnexion\"> Deconnexion </a>
                            </div>
                          </div>";
                } else {
                echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#loginPopUp\">Connexion</button>";
                echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#inscriptionPopUp\">Inscription</button>";
                }
                ;?>


            </div>

        </nav>
    </header>
                                <!-- MODAL INSCRIPTION / CONNEXION   -->
                                    <!--                          -->
    <section id="modal">
    <div class="modal fade" id="loginPopUp" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Connexion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-connexion" action="index.php?action=login" method="post">
                        <div class="form-group">
                            <label for="pseudo">Votre pseudo:</label>
                            <input type="text" class="form-control" name="pseudo"  placeholder="Pseudo">
                        </div>
                        <div class="form-group">
                            <label for="password">Votre mot de passe:</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <small class="form-text text-muted">Vos identifiants doivent etre entre 8 et 20 caractères.</small>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="inscriptionPopUp" tabindex="-1" role="dialog" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inscription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-inscription" action="index.php?action=saveInscription" method="post">
                        <div class="form-group">
                            <label for="pseudo">Votre pseudo:</label>
                            <input type="text" class="form-control" name="pseudo"  placeholder="Pseudo">
                        </div>
                        <div class="form-group">
                            <label for="password">Votre mot de passe:</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <small class="form-text text-muted">Vos identifiants doivent etre entre 8 et 20 caractères.</small>
                        <button type="submit" class="btn btn-primary">S'inscrire</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>

    <section id="main">
        <?= $content ?>
    </section>




    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <script src="public/JS/slider.js"></script>
</html>