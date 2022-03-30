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

                        <!--Modal formulaire de mofification-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Formulaire de modification</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <legend for="selection">Difficulté de la randonnée</legend>
                                            <select id="selection" class="form-control" required>
                                                <optgroup>
                                                    <option value="">Choisissez la difficultée du terrain</option>
                                                    <option value="">1</option>
                                                    <option value="">2</option>
                                                    <option value="">3</option>
                                                    <option value="">4</option>
                                                    <option value="">5</option>
                                                    <option value="">6</option>
                                                    <option value="">7</option>
                                                    <option value="">8</option>
                                                    <option value="">9</option>
                                                </optgroup>
                                            </select>

                                            <legend for="prix_pers">Prix par personne <span class="text-muted">€</span>
                                            </legend>
                                            <div class="def-number-input number-input">
                                                <button
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                    class="minus text-light bg-danger border rounded-pill fs-5 p-2">-</button>
                                                <input
                                                    class="quantity fs-4 text-center border-0 g-0 fw-bold border-bottom border-bottom-5 border-secondary"
                                                    style="outline: none!important;" min="0" name="quantity" value="0"
                                                    type="number" step="1.0" date-prefix="€">
                                                <button
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                    class="plus text-light bg-success border rounded-pill fs-5 p-2">+</button>
                                            </div>

                                            <legend for="selection">Départ</legend>
                                            <textarea class="form-control" aria-label="Départ et arriver"></textarea>

                                            <legend for="selection">Arrivée</legend>
                                            <textarea class="form-control" aria-label="Départ et arriver"></textarea>

                                            <div id="map-container-google-1" class="z-depth-1-half map-container m-3"
                                                style="height: 450px">
                                                <iframe
                                                    src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyC46IZ31q8x_YylxY0FGZiM9QqkspgZL5w&origin=Pl.+des+Halles,+67000+Strasbourg&destination=KFC+Homme+de+fer&mode=walking"
                                                    width="450" height="450" style="border:0;" allowfullscreen=""
                                                    loading="lazy"></iframe>
                                            </div>

                                            <legend for="selection">Matériel</legend>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c1" id="ck1">
                                                <label class="form-check-label h6" for="ck1">Chaussure de
                                                    randonnée</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c2" id="ck2">
                                                <label class="form-check-label h6" for="ck2">Corde</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c3" id="ck3">
                                                <label class="form-check-label h6" for="ck3">Raquettes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c4" id="ck4">
                                                <label class="form-check-label h6" for="ck4">Mousqueton et suspension
                                                    d'escalade</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c5" id="ck5">
                                                <label class="form-check-label h6" for="ck5">Lunettes d'eclipse</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c6" id="ck6">
                                                <label class="form-check-label h6" for="ck6">Tente</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c7" id="ck7">
                                                <label class="form-check-label h6" for="ck7">Sac de couchage</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c1" id="ck1">
                                                <label class="form-check-label h6" for="ck1">Réchaud et cantine</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c2" id="ck2">
                                                <label class="form-check-label h6" for="ck2">Hamac</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c3" id="ck3">
                                                <label class="form-check-label h6" for="ck3">Matelas</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c4" id="ck4">
                                                <label class="form-check-label h6" for="ck4">Désinfectant d'eau</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c5" id="ck5">
                                                <label class="form-check-label h6" for="ck5">Rations / casse
                                                    croute</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c5" id="ck5">
                                                <label class="form-check-label h6" for="ck5">Combinaison de
                                                    plongée</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c5" id="ck5">
                                                <label class="form-check-label h6" for="ck5">Palme</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c5" id="ck5">
                                                <label class="form-check-label h6" for="ck5">Masque et tuba</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" value="c5" id="ck5">
                                                <label class="form-check-label h6" for="ck5">Bouteille d'oxygene</label>
                                            </div>
                                            <legend for="selection">Autres</legend>
                                            <textarea class="form-control" aria-label="Autres"></textarea>

                                            <legend for="selection">Description</legend>
                                            <textarea class="form-control" aria-label="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-success">Modifier</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>