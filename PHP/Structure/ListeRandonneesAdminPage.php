<div class="container bg-light p-3  text-dark">
    <h2 class="text-center text-success">Liste de randonnées effectuées ou à venir</h2>

    <!---------------------------------------------------------------------------------------------------------------------------------------------->
    <!---Onglets------------>
    <div class="m-4">
        <ul class="nav nav-tabs justify-content-center" id="myTab">
            <li class="nav-item border-top border-2 border-primary">
                <a href="#rando_effectuee" class="nav-link active fw-bolder p-2 text-primary fs-5" data-bs-toggle="tab">
                    <h3>Randonnées effectuées</h3>
                </a>
            </li>
            <li class="nav-item border-top border-2 border-primary">
                <a href="#rando_a_venir" class="nav-link fw-bolder p-2 text-primary fs-5" data-bs-toggle="tab">
                    <h3>Randonnées à venir</h3>
                </a>
            </li>
        </ul>
        <!---------------------------------------------------------------------------------------------------------------------------------------------->
        <!---Contenus des onglets------------>
        <div class="tab-content">
            <div class="tab-pane fade show active bg-white rounded p-2  col-6" id="rando_effectuee">
                <div class="card">
                    <div class="inline">
                        <label for="guide" class="form-label h4">Randonnée</label>
                        <div class="card-body h5">Randonnée placeholder</div>
                        <label for="guide" class="form-label h4">Difficulté</label>
                        <div class="card-body ">
                            <label class="bg-success text-centered">0</label>
                        </div>
                    </div>
                    <img src="" class="img-fluid" alt="...">
                    <label for="guide" class="form-label h4">Date départ</label>
                    <input id="startDate" class="form-control" type="date" readonly="readonly" value="2022-02-02" />
                    <label for="guide" class="form-label h4">Date arrivée</label>
                    <input id="endDate" class="form-control" type="date" readonly="readonly" value="2022-02-02" />
                    <label for="guide" class="form-label h4">Description</label>
                    <div class="card-body h5">Description placeholder</div>

                    <div class="inline center">
                        <button class="btn  btn-outline-success mb-1" type="edit">Consulter</button>
                    </div>
                </div>
            </div>
            <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="tab-pane fade bg-white rounded p-2 col-6" id="rando_a_venir">
                <div class="card">
                    <div class="inline">
                        <label for="guide" class="form-label h4">Randonnée</label>
                        <div class="card-body h5">Randonnée placeholder</div>
                        <label for="guide" class="form-label h4">Difficulté</label>
                        <div class="card-body ">
                            <label class="bg-success text-centered">0</label>
                        </div>
                    </div>
                    <img src="" class="img-fluid" alt="...">
                    <label for="guide" class="form-label h4">Date départ</label>
                    <input id="startDate" class="form-control" type="date" readonly="readonly" value="2022-02-02" />
                    <label for="guide" class="form-label h4">Date arrivée</label>
                    <input id="endDate" class="form-control" type="date" readonly="readonly" value="2022-02-02" />
                    <label for="guide" class="form-label h4">Description</label>
                    <div class="card-body h5">Description placeholder</div>

                    <div class="inline center">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Modifier</button>
                        <button class="btn  btn-outline-danger mb-1" type="edit">Supprimer</button>
                  <!-------------------------------------------------------------------------------------------------------------------------------->
                        <!--Modal formulaire de mofification randonnee-->
                        <form id='U_creation_programme' name='U_creation_programme' class="form" method="POST" action="#">
                            <legend for="U_selection_rando">Nom du programme</legend>
                            <input type="text" name="U_sLabel_Prog" class="form-control" aria-label="NomExcursion" required>

                            <legend for="U_selection_rando">Sélection de randonnée</legend>
                            <select multiple name="sExcur_Prog[]" id="U_selection_rando" class="form-control" required>
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
                            <select name="U_nDifficulte_Prog" id="selectionTerrain" class="form-control" required>
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
                                <input name="U_nCapacite_Prog" class="quantity fs-4 text-center border-0 g-0 fw-bold border-bottom border-bottom-5 border-secondary" min="1" name="quantity" value="1" type="number">
                                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus text-light bg-success border rounded-pill fs-5 p-2">+</button>
                            </div>

                            <legend for="selection_rando">Type de programme</legend><br>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="U_c1" id="U_ck1">
                                <label class="form-check-label h6" for="U_ck1">Senior</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="U_c2" id="U_ck2">
                                <label class="form-check-label h6" for="U_ck2">Junior</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="U_c3" id="U_ck3">
                                <label class="form-check-label h6" for="U_ck3">Majeur</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="U_c4" id="U_ck4">
                                <label class="form-check-label h6" for="U_ck4">Nature</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="U_c5" id="U_ck5">
                                <label class="form-check-label h6" for="U_ck5">Histoire</label>
                            </div>

                            <legend for="startDate">Date de départ</legend>
                            <input name="U_sDepart_Prog" id="startDate" class="form-control" type="date" required/>

                            <legend for="startDate">Heure de départ</legend>
                            <div class="cs-form">
                                <input name="U_sDepartHeure_Prog" type="time" class="form-control" value="" required/>
                            </div>

                            <legend for="arriveDate">Date d'arriver</legend>
                            <input name="U_sArrivee_Prog" id="arriveDate" class="form-control" type="date" required/>

                            <legend for="arriveDate">Heure d'arrivée</legend>
                            <div class="cs-form">
                                <input name="U_sArriveHeure_Prog" type="time" class="form-control" value="" required/>
                            </div>
                          <div>
                            <legend for="selection">Matériel</legend>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c1" id="U_cc_ck1">
                                <label class="form-check-label h6" for="U_cc_ck1">Chaussure de randonnée</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c2" id="U_cc_ck2">
                                <label class="form-check-label h6" for="U_cc_ck2">Corde</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c3" id="U_cc_ck3">
                                <label class="form-check-label h6" for="U_cc_ck3">Raquettes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c4" id="U_cc_ck4">
                                <label class="form-check-label h6" for="U_cc_ck4">Mousqueton et suspension d'escalade</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c5" id="U_cc_ck5">
                                <label class="form-check-label h6" for="U_cc_ck5">Lunettes d'eclipse</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c6" id="U_cc_ck6">
                                <label class="form-check-label h6" for="U_cc_ck6">Tente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c7" id="U_cc_ck7">
                                <label class="form-check-label h6" for="U_cc_ck7">Sac de couchage</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c1" id="U_ck_ck1">
                                <label class="form-check-label h6" for="U_ck_ck1">Réchaud et cantine</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c2" id="U_ck_ck2">
                                <label class="form-check-label h6" for="U_ck_ck2">Hamac</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c3" id="U_ck_ck3">
                                <label class="form-check-label h6" for="U_ck_ck3">Matelas</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c4" id="U_ck_ck4">
                                <label class="form-check-label h6" for="U_ck_ck4">Désinfectant d'eau</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c5" id="U_ck_ck5">
                                <label class="form-check-label h6" for="U_ck_ck5">Rations / casse croute</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c5" id="U_ck_ck6">
                                <label class="form-check-label h6" for="U_ck_ck6">Combinaison de plongée</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="c5" id="U_ck_ck7">
                                <label class="form-check-label h6" for="U_ck_ck7">Palme</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="U_c5" id="U_ck_ck8">
                                <label class="form-check-label h6" for="U_ck_ck8">Masque et tuba</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="U_c5" id="U_ck_ck9">
                                <label class="form-check-label h6" for="U_ck_ck9">Bouteille d'oxygene</label>
                            </div>
                            <br>
                          </div>
                            <button type="button" class="btn btn-outline-warning fs-5 fw-bold border-2" data-bs-toggle="modal"
                              data-bs-target="#materielModal">Ajouter un materiel</button>

                            <legend for="selection_rando">Description</legend>
                            <textarea name="U_sDesc_Prog" class="form-control" aria-label="Background et notes" required></textarea>
                            <br>
                            <button class="btn  btn-outline-success mb-1" type="submit">Valider</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
