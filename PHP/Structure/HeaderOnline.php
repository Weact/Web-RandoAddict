<!--
/*******************************************************************************\
* Fichier       : /HTML/Structure/HeaderOnline.html
*
* Description   : Fichier HTML comprenant le Header de la page ; cf HeaderAdmin
*                ou HeaderOnline pour les différents header
* Fonction      : -.
*
* Créateur      : Gaetan Galati
* Superviseur   : Lucas DRUCKES
* Refonte       : Gaetian Galati et Lucas DRUCKES
\*******************************************************************************/
/*******************************************************************************\
* 21-03-2022    : Création page
* 28-03-2022    : Pull Request et mise en commun avec le travail général
* 28-03-2022    : Modification du header par Lucas DRUCKES pour un meilleur visuel
\*******************************************************************************/
-->

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
        <div class="container-fluid align-items-end">
            <a href="#" class="goToDispRando" style="text-decoration: none!important;">
                <h1 class="user-select-none text-primary display-1 text-uppercase">
                    RANDO<span class="text-success">ADDICT</span>
                </h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

                <form class="w-100 text-primary fw-bolder mr-3 mt-3" method="POST" action="#">

                    <div class="d-flex text-dark align-items-center justify-content-end">

                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <span id="session_username" class="fw-bolder fs-5 ">UserPlaceholder</span>

                        <script type="text/javascript">
                            document.getElementById("session_username").innerHTML = "<?php echo $_SESSION['nomUtilisateur'] ?>";
                        </script>

                    </div>

                    <div class="input-group justify-content-end">
                        <div class="form-floating g-0 w-50">
                            <input type="text" name="randonneeRecherche" id="randonneeRecherche" class="form-control" placeholder="Rechercher">
                            <label for="randonneeRecherche">Rechercher</label>
                        </div>
                        <button type="button" class="btn btn-success" id="researchRandonnee">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item text-left m-2 border-bottom border-2 border-primary rounded-pill nav-custom-link">
                        <a class="nav-link fw-bolder p-2 text-primary fs-5 goToMyRando" aria-current="page" href="#">Mes
                            randonnées</a>
                    </li>
                </ul>
                <form id='disconnectForm' name='disconnectForm' class="form" method="POST" action="#">
                    <button name="disconnect" type="submit" class="btn btn-danger fw-bolder text-uppercase" value="Inscription">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>
</header>