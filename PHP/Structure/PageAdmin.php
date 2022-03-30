<div class="container bg-light p-3">
    <h2 class="text-center text-success">Page administrateur</h2>

    <!---------------------------------------------------------------------------------------------------------------------------------------------->
    <!---Onglets------------>
    <div class="m-5">
        <ul class="nav nav-tabs justify-content-center" id="myTab">
            <li class="nav-item border-top border-2 border-primary">
                <a href="#crea_rando" class="nav-link fw-bolder p-2 text-primary fs-5" data-bs-toggle="tab">
                    <h3>Création de randonnée</h3>
                </a>
            </li>
            <li class="nav-item border-top border-2 border-primary">
                <a href="#crea_programme" class="nav-link fw-bolder p-2 text-primary fs-5" data-bs-toggle="tab">
                    <h3>Création de programme</h3>
                </a>
            </li>
            <li class="nav-item border-top border-2 border-primary">
                <a href="#crea_profile" class="nav-link fw-bolder p-2 text-primary fs-5" data-bs-toggle="tab">
                    <h3>Création de profile</h3>
                </a>
            </li>
            <li class="nav-item border-top border-2 border-primary">
                <a href="#membres" class="nav-link fw-bolder p-2 text-primary fs-5" data-bs-toggle="tab">
                    <h3>Liste des membres</h3>
                </a>
            </li>
        </ul>
        <!---------------------------------------------------------------------------------------------------------------------------------------------->
        <!---Contenus des onglets------------>
        <div class="tab-content text-dark m-5">
            <div class="tab-pane fade show active bg-white rounded p-2  col-6" id="crea_rando">
                <form id='creation_rando' name='creation_rando' class="form" method="POST" action="#" enctype="multipart/form-data">
                  <legend for="selection_rando">Nom de la randonnée</legend>
                  <textarea name="labelExcursion" class="form-control" aria-label="nom_randonnee" required></textarea>
                    <div class="form-group">

                        <legend for="selection_rando">Type de terrain</legend><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c6" id="ck6">
                            <label class="form-check-label h6" for="ck6">Fitness</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c7" id="ck7">
                            <label class="form-check-label h6" for="ck7">Restaurant</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c1" id="c_ck1">
                            <label class="form-check-label h6" for="c_ck1">Forêt</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c2" id="c_ck2">
                            <label class="form-check-label h6" for="c_ck2">Montagne</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c3" id="c_ck3">
                            <label class="form-check-label h6" for="c_ck3">Plaine</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c4" id="c_ck4">
                            <label class="form-check-label h6" for="c_ck4">Désert</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c5" id="c_ck5">
                            <label class="form-check-label h6" for="c_ck5">Glacier</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c6" id="c_ck6">
                            <label class="form-check-label h6" for="c_ck6">Vignes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c7" id="c_ck7">
                            <label class="form-check-label h6" for="c_ck7">Ruines</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c8" id="c_ck8">
                            <label class="form-check-label h6" for="c_ck8">Milieu urbain</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c9" id="c_ck9">
                            <label class="form-check-label h6" for="c_ck9">Jungle</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c10" id="c_ck10">
                            <label class="form-check-label h6" for="c_ck10">Tundra</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="c11" id="c_ck11">
                            <label class="form-check-label h6" for="c_ck11">Profondeur océanique</label>
                        </div>

                        <button type="button" class="btn btn-outline-warning fs-5 fw-bold border-2" data-bs-toggle="modal"
                          data-bs-target="#terrainModal">Ajouter un terrain</button>

                        <legend for="prix_pers">Prix par personne</legend>
                        <div class="def-number-input number-input safari_only">
                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus text-light bg-danger border rounded-pill fs-5 p-2">-</button>
                            <input class="quantity fs-4 text-center border-0 border-bottom border-bottom-5 border-secondary g-0 fw-bold" min="0" name="prixExcursion" value="0" type="number" step="0.1" date-prefix="€">
                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus text-light bg-success border rounded-pill fs-5 p-2">+</button>
                        </div>

                        <legend for="selection">Départ</legend>
                        <textarea name="departExcursion" class="form-control" aria-label="Départ et arriver" required></textarea>

                        <legend for="selection">Arrivée</legend>
                        <textarea name="arriveeExcursion" class="form-control" aria-label="Départ et arriver" required></textarea>

                        <div id="map-container-google-1" class="z-depth-1-half map-container m-3" style="height: 450px">
                            <iframe src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyC46IZ31q8x_YylxY0FGZiM9QqkspgZL5w&origin=Pl.+des+Halles,+67000+Strasbourg&destination=KFC+Homme+de+fer&mode=walking" width="450" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>

                        <legend for="selection">Description</legend>
                        <textarea name="descExcursion" class="form-control" aria-label="Description"></textarea>
                        <br>
                        
                        <!--Inclusion d'une image-->
                        <legend for="fileInput">Image de l'excursion</legend>
                        <input type="file" id="fileInput" accept="image/png, image/jpeg, image/jpg" name="image" required class="btn-outline-primary"/>
                        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                        <br/>
                        <br/>

                        <button class="btn  btn-outline-success mb-1" type="submit">Valider</button>


                    </div>
                </form>
            </div>
            <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="tab-pane fade bg-white rounded p-2 col-6" id="crea_programme">
                <form id='creation_programme' name='creation_programme' class="form" method="POST" action="#">
                    <legend for="selection_rando">Nom du programme</legend>
                    <input type="text" name="sLabel_Prog" class="form-control" aria-label="NomExcursion" required>

                    <legend for="selection_rando">Sélection de randonnée</legend>
                    <select multiple name="sExcur_Prog[]" id="selection_rando" class="form-control" required>
                        <optgroup>
                            <?php
                            require_once(__DIR__ . '/../Include/programManager.php');
                            $excursions = getAllExc();
                            foreach ($excursions as $excursion) {
                                echo "<option value='" . $excursion[0] . "'>" . $excursion[1] . "</option>";
                            }

                            ?>
                        </optgroup>
                    </select>

                    <legend for="selectionTerrain">Difficulté de la randonnée</legend>
                    <select name="nDifficulte_Prog" id="selectionTerrain" class="form-control" required>
                        <option value="">Choisissez la difficultée du terrain</option>
                        <optgroup>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                        </optgroup>
                    </select>

                    <legend for="nb_rando">Nombre de randonneurs</legend>
                    <div class="def-number-input number-input safari_only">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus text-light bg-danger border rounded-pill fs-5 p-2">-</button>
                        <input name="nCapacite_Prog" class="quantity fs-4 text-center border-0 g-0 fw-bold border-bottom border-bottom-5 border-secondary" min="1" name="quantity" value="1" type="number">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus text-light bg-success border rounded-pill fs-5 p-2">+</button>
                    </div>

                    <legend for="selection_rando">Type de programme</legend><br>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c1" id="ck1">
                        <label class="form-check-label h6" for="ck1">Senior</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c2" id="ck2">
                        <label class="form-check-label h6" for="ck2">Junior</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c3" id="ck3">
                        <label class="form-check-label h6" for="ck3">Majeur</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c4" id="ck4">
                        <label class="form-check-label h6" for="ck4">Nature</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c5" id="ck5">
                        <label class="form-check-label h6" for="ck5">Histoire</label>
                    </div>

                    <legend for="startDate">Date de départ</legend>
                    <input name="sDepart_Prog" id="startDate" class="form-control" type="date" required/>

                    <legend for="startDate">Heure de départ</legend>
                    <div class="cs-form">
                        <input name="sDepartHeure_Prog" type="time" class="form-control" value="" required/>
                    </div>

                    <legend for="arriveDate">Date d'arriver</legend>
                    <input name="sArrivee_Prog" id="arriveDate" class="form-control" type="date" required/>

                    <legend for="arriveDate">Heure d'arrivée</legend>
                    <div class="cs-form">
                        <input name="sArriveHeure_Prog" type="time" class="form-control" value="" required/>
                    </div>
                  <div>
                    <legend for="selection">Matériel</legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c1" id="cc_ck1">
                        <label class="form-check-label h6" for="cc_ck1">Chaussure de randonnée</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c2" id="cc_ck2">
                        <label class="form-check-label h6" for="cc_ck2">Corde</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c3" id="cc_ck3">
                        <label class="form-check-label h6" for="cc_ck3">Raquettes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c4" id="cc_ck4">
                        <label class="form-check-label h6" for="cc_ck4">Mousqueton et suspension d'escalade</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c5" id="cc_ck5">
                        <label class="form-check-label h6" for="cc_ck5">Lunettes d'eclipse</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c6" id="cc_ck6">
                        <label class="form-check-label h6" for="cc_ck6">Tente</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c7" id="cc_ck7">
                        <label class="form-check-label h6" for="cc_ck7">Sac de couchage</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c1" id="ck_ck1">
                        <label class="form-check-label h6" for="ck_ck1">Réchaud et cantine</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c2" id="ck_ck2">
                        <label class="form-check-label h6" for="ck_ck2">Hamac</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c3" id="ck_ck3">
                        <label class="form-check-label h6" for="ck_ck3">Matelas</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c4" id="ck_ck4">
                        <label class="form-check-label h6" for="ck_ck4">Désinfectant d'eau</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c5" id="ck_ck5">
                        <label class="form-check-label h6" for="ck_ck5">Rations / casse croute</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c5" id="ck_ck6">
                        <label class="form-check-label h6" for="ck_ck6">Combinaison de plongée</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c5" id="ck_ck7">
                        <label class="form-check-label h6" for="ck_ck7">Palme</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c5" id="ck_ck8">
                        <label class="form-check-label h6" for="ck_ck8">Masque et tuba</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c5" id="ck_ck9">
                        <label class="form-check-label h6" for="ck_ck9">Bouteille d'oxygene</label>
                    </div>
                    <br>
                  </div>
                    <button type="button" class="btn btn-outline-warning fs-5 fw-bold border-2" data-bs-toggle="modal"
                      data-bs-target="#materielModal">Ajouter un materiel</button>

                    <legend for="selection_rando">Description</legend>
                    <textarea name="sDesc_Prog" class="form-control" aria-label="Background et notes" required></textarea>
                    <br>
                    <button class="btn  btn-outline-success mb-1" type="submit">Valider</button>
                </form>
            </div>
            <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="tab-pane fade bg-white rounded p-2 col-6" id="crea_profile">
                <div class="container mt-3">
                    <form id='creation_compte' name='creation_compte' class="form" method="POST" action="#">
                        <h3>Création d'un compte</h3>
                        <!--Mail-->
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 mt-3 form-floating">
                                    <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" id="email" placeholder="Entrer email" name="email" required>
                                    <label for="email" class="form-label h6">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <!--Pseudo-->
                                <div class="mb-3 form-floating">
                                    <input type="name" class="form-control" id="name" placeholder="Entrer pseudonyme" name="name" required>
                                    <label for="name" class="form-label h6">Pseudonyme</label>
                                </div>
                            </div>
                            <div class="col">
                                <!--Phone-->
                                <div class="mb-3 form-floating">
                                    <input required placeholder="01234567890" id="phone" class="form-control" title="Format : 01234567890" pattern="[0][0-9]{9}" type="tel" onchange="inputValidation(this)" />
                                    <label for="phone" class="form-label h6">Numéro de téléphone portable</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <!--Password-->
                                <div class="mb-3 form-floating">
                                    <input type="password" class="form-control" id="password" placeholder="Entrer mot de passe" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Doit contenir au moins un chiffre et une lettre majuscule et minuscule, et au moins 8 caractères ou plus." required>
                                    <label for="password" class="form-label h6">Mot de passe</label>
                                </div>
                            </div>
                            <div class="col">
                                <!--Is guide-->
                                <div class="mb-3 form-floating">
                                    <select class="form-select">
                                        <option>Visiteur</option>
                                        <option>Guide</option>
                                        <option>Administrateur</option>
                                    </select>
                                    <label for="guide" class="form-label h6">Création en tant que :</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success mb-1 h6">Créer</button>
                        </div>
                    </form>
                </div>

                <div class="container mt-3">
                    <h3>Changer le status d'un compte</h3>
                    <div class="row">
                        <div class="col">
                            <!--Password-->
                            <select class="form-control" id="selection_user" required>
                                <optgroup>
                                    <?php
                                    require_once(__DIR__ . '/../Include/userManager.php');
                                    $users = getAllUsers();
                                    foreach ($users as $user) {
                                        echo "<option value='" . $user[4] . "'>" . $user[0] . "</option>";
                                    }

                                    ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col">
                            <!--Is guide-->
                            <div class="mb-3 form-floating">
                                <select class="form-select" id="roles_choice">
                                    <option>Visiteur</option>
                                    <option>Guide</option>
                                    <option>Admin</option>
                                    <script>
                                        let user_selector = document.getElementById('selection_user');
                                        update();
                                        user_selector.addEventListener("change", () => {
                                            update()
                                        });

                                        function update() {
                                            let roles = document.getElementById('roles_choice').children
                                            for (let i of roles) {
                                                i.disabled = i.innerHTML == user_selector.value;
                                            }
                                        }

                                        function updateUserRole() {
                                            let mails = document.getElementById('selection_user')
                                            let roles = document.getElementById('roles_choice')
                                            let userRole = roles.options[roles.selectedIndex].value;
                                            let userMail = mails.options[mails.selectedIndex].innerHTML;

                                            console.log(userRole + userMail);

                                            var xmlhttp = new XMLHttpRequest();
                                            let response;
                                            xmlhttp.onreadystatechange = function() {
                                                if (this.readyState == 4 && this.status == 200) {
                                                    response = JSON.parse(this.responseText);
                                                    if (response) {
                                                        $('#toastSuccess').toast('show');
                                                    } else {
                                                        $('#toastError').toast('show');
                                                    }
                                                    update();
                                                }
                                            };
                                            xmlhttp.open("GET", "Include/userManager.php?mail_user=" + userMail + "&role_user=" + userRole, true);
                                            xmlhttp.send();

                                        }
                                    </script>
                                </select>

                                <label for="guide" class="form-label h6">Changer en tant que :</label>
                            </div>
                        </div>

                        <button onclick="updateUserRole()" class="btn btn-outline-success mb-1 h6">Modifier
                            role</button>
                    </div>
                </div>
                <div class="container">
                    <div class="toast bg-success text-light border rounded fs-3 fw-3" id="toastSuccess" data-delay="3000" style=" top: 1rem; right: 1rem; min-width:250px;" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body">
                            Succès !
                        </div>
                    </div>

                    <div class="toast bg-danger text-light border rounded fs-3 fw-3" id="toastError" data-delay="3000" style=" top: 1rem; left: 1rem; min-width:250px;" aria-live="assertive" aria-atomic="true">
                        <div class="toast-body">
                            Erreur !
                        </div>
                    </div>
                </div>
            </div>

            <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="tab-pane fade bg-white rounded p-2 col-4" id="membres">
                <div class="card">
                    <label for="guide" class="form-label h6">Nom</label>
                    <div class="card-header h5">Nom placeholder</div>
                    <label for="guide" class="form-label h6">Statut</label>
                    <div class="card-body h5">Randonneur / guide</div>
                    <label for="guide" class="form-label h6">Mail</label>
                    <div class="card-body h5">Mail placeholder</div>
                    <label for="guide" class="form-label h6">Téléphone</label>
                    <div class="card-body h5">Tel placeholder</div>

                    <button class="btn  btn-outline-success mb-1" type="submit">Randonnées</button>
                </div>
            </div>

            <!----------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="modal fade" id="materielModal" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout de materiel</h5>
                  </div>
                  <div class="modal-body">
                    <label for="email" class="form-label h6">Nom du nouveau materiel</label>
                    <textarea name="Nom_materiel_autre" class="form-control" aria-label="Nom_materiel_autre"></textarea>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-warning fs-5 fw-bold border-2">Ajouter</button>
                    <button type="button" class="btn-close fs-5" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                </div>
              </div>
            </div>
            <!----------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="modal fade" id="terrainModal" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="terrainModalLabel">Ajout de terrain</h5>
                  </div>
                  <div class="modal-body">
                    <label for="titre" class="form-label h6">Nom du nouveau terrain</label>
                    <textarea name="Nom_terrain_autre" class="form-control" aria-label="Nom_terrain_autre"></textarea>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-warning fs-5 fw-bold border-2">Ajouter</button>
                    <button type="button" class="btn-close fs-5" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
