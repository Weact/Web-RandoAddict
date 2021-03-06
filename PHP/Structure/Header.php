<!--/*******************************************************************************\
* Fichier       : /HTML/Structure/Header.html
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
\*******************************************************************************/-->

<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
    <div class="container-fluid align-items-end">
      <a href="#" class="goToDispRando" style="text-decoration: none!important;">
        <h1 class="user-select-none text-primary display-1 text-uppercase">
          RANDO<span class="text-success">ADDICT</span>
        </h1>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <form id='rechercheForm' name='rechercheForm' method='POST' action='#'
          class="w-100 text-primary fw-bolder mr-3 mt-3">
          <div class="input-group justify-content-end">
            <div class="form-floating g-0 w-50">
              <input type="text" name="randonneeRecherche" id="randonneeRecherche" class="form-control"
                placeholder="Adresse E-Mail">
              <label for="randonneeRecherche">Rechercher</label>
            </div>
            <button type="button" class="btn btn-success">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search"
                viewBox="0 0 16 16">
                <path
                  d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
              </svg>
            </button>
          </div>
        </form>
      </div>
    </div>
  </nav>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <!-- Boutons/Liens à gauche de la navbar ici-->
        </ul>

        <button type="button" class="btn btn-primary fw-bolder text-uppercase me-2" value="Connexion"
          data-bs-toggle="modal" data-bs-target="#connexionModale">Connexion</button>
        <button type="button" class="btn btn-primary fw-bolder text-uppercase" value="Inscription"
          data-bs-toggle="modal" data-bs-target="#inscriptionModale">Inscription</button>
      </div>
    </div>
    <div class="modal fade text-dark" id="inscriptionModale">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Inscription en tant que marcheur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id='inscriptionForm' name='inscriptionForm' class="form" method="POST" action="#">
              <!--Mail-->
              <div class="row">
                <div class="col">
                  <div class="mb-3 mt-3 form-floating">
                    <input name="sMail_Marcheur_Inscription" type="email"
                      pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" placeholder="Entrer email"
                      name="email">
                    <label for="email" class="form-label">Email</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <!--Pseudo-->
                  <div class="mb-3 form-floating">
                    <input name="sPseudo_Marcheur" type="name" class="form-control" id="name"
                      placeholder="Entrer pseudonyme" name="name">
                    <label for="name" class="form-label">Pseudonyme</label>
                  </div>
                </div>
                <div class="col">
                  <!--Phone-->
                  <div class="mb-3 form-floating">
                    <input name="sTel_Marcheur" required placeholder="0123456789" id="phone" class="form-control"
                      title="Format : 0123456789" pattern="[0][0-9]{9}" type="tel" onchange="inputValidation(this)" />
                    <label for="phone" class="form-label">Numéro de téléphone</label>
                  </div>
                </div>
              </div>
              <div class="col">
                <!--Password-->
                <div class="mb-3 form-floating">
                  <input name="sMdp_Marcheur" type="password" class="form-control" placeholder="Entrer mot de passe"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Doit contenir au moins un chiffre et une lettre majuscule et minuscule, et au moins 8 caractères ou plus."
                    required>
                  <label for="password" class="form-label">Mot de passe</label>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    </div>
    <div class="modal fade text-dark" id="connexionModale">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Connexion au compte</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="connexionForm" class="form" method="POST" action="#">
            <div class="modal-body">
              <!--Mail-->
              <div class="row">
                <div class="col">
                  <div class="mb-3 mt-3 form-floating">
                    <input name="sMail_Marcheur_Connexion" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                      class="form-control" placeholder="Entrer email" name="email">
                    <label for="email" class="form-label">Email</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <!--Password-->
                  <div class="mb-3 form-floating">
                    <input name="sMdp_Marcheur" type="password" class="form-control" id="password"
                      placeholder="Entrer mot de passe" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                      title="Doit contenir au moins un chiffre et une lettre majuscule et minuscule, et au moins 8 caractères ou plus."
                      required>
                    <label for="password" class="form-label">Mot de passe</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </nav>
</header>