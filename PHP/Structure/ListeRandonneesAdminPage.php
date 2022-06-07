<?php session_start();
require_once(__DIR__ . '/../Include/programManager.php');
//$progs = getProgOfUser($_SESSION['mailUtilisateur']);

if (isset($_POST["idProg"])) {
    if ($_POST["idProg"] == "checkMailMarcheur") {
        if (isset($_POST["value"])) {
            $_SESSION['checkMailUtilisateur'] = $_POST["value"];
        }
    }
}

$progs = getProgOfUser($_SESSION['checkMailUtilisateur']);

?>
<style>
    .randolink.active {
        color: green !important;
    }
</style>
<div class="container bg-light p-3  text-dark">
    <h2 class="text-center text-success">Liste de randonnées effectuées ou à venir de</h2>
    <p class="text-muted"><?php echo $_SESSION['checkMailUtilisateur']; ?></p>

    <!---------------------------------------------------------------------------------------------------------------------------------------------->
    <!---Onglets------------>
    <div class="m-4">
        <ul class="nav nav-tabs justify-content-center" id="myTab">
            <li class="nav-item border-top border-2 border-primary">
                <a href="#rando_effectuee" class="nav-link active fw-bolder p-2 text-primary fs-5 randolink" data-bs-toggle="tab">
                    <h3>Randonnées effectuées</h3>
                </a>
            </li>
            <li class="nav-item border-top border-2 border-primary">
                <a href="#rando_a_venir" class="nav-link fw-bolder p-2 text-primary fs-5 randolink" data-bs-toggle="tab">
                    <h3>Randonnées à venir</h3>
                </a>
            </li>
        </ul>
        <!---------------------------------------------------------------------------------------------------------------------------------------------->
        <!---Contenus des onglets------------>
        <div class="tab-content">
            <div class="tab-pane fade show active bg-white rounded p-2  col-6" id="rando_effectuee">

                <?php foreach ($progs as $prog) {
                    $time = $prog['dateArriveeProgramme'];
                    $hour = substr($time, 11, 2);
                    $min = substr($time, 14, 2);
                    $sec = substr($time, 17, 2);
                    $year = substr($time, 0, 4);
                    $month = substr($time, 5, 2);
                    $day = substr($time, 8, 2);
                    if (mktime($hour, $min, $sec, $month, $day, $year) > time()) {
                        continue;
                    }

                    $progdesc = $prog['descProgramme'];
                    if (strlen($progdesc) > 125) {
                        $progdesc = substr($progdesc, 0, 126) . " [...]";
                    }

                ?>
                    <div class="card col-12 m-3 p-3 font-monospace">
                        <div class="inline">
                            <label for="guide" class="form-label display-4 fw-bolder text-primary">Randonnée</label>
                            <div class="card-body display-6 fw-bold shadow"><?php echo $prog['labelProgramme']; ?></div>
                            <label for="guide" class="form-label display-4 fw-bolder text-primary">Difficulté</label>
                            <div class="card-body ">
                                <!-- Create difficulty program with color according to difficulty -->
                                <label class="<?php if ($prog['difficulteProgramme'] < 4) {
                                                    echo "bg-success";
                                                } elseif ($prog['difficulteProgramme'] >= 4 && $prog['difficulteProgramme'] < 7) {
                                                    echo "bg-warning";
                                                } elseif ($prog['difficulteProgramme'] >= 7) {
                                                    echo "bg-danger";
                                                } ?> badge rounded-pill w-25 mb-5 fs-4 text-centered p-3 fw-bolder text-light"><?php echo $prog['difficulteProgramme']; ?></label>
                            </div>
                        </div>
                        <img src="<?php
                                    $photo = getPhotoOfExcursion(getExcsOfProg($prog)[0]['idExcursion']);

                                    $photolink = '../ASSETS/' . $photo['lienPhoto'];

                                    echo $photolink; ?>" class="img-fluid" alt="...">
                        <label for="guide" class="form-label display-4 fw-bolder text-primary">Date départ</label>
                        <input id="startDate" class="form-control p-3 bg-success text-light fs-3 fw-bold text-center" type="date" readonly="readonly" value="<?php echo substr($prog['dateDepartProgramme'], 0, 10); ?>" />
                        <label for="guide" class="form-label display-4 fw-bolder text-primary">Date arrivée</label>
                        <input id="endDate" class="form-control p-3 bg-success text-light fs-3 fw-bold text-center" type="date" readonly="readonly" value="<?php echo substr($prog['dateArriveeProgramme'], 0, 10); ?>" />
                        <label for="guide" class="form-label display-4 fw-bolder text-primary">Description</label>
                        <div class="card-body h5 text-info bg-dark rounded rounded-5 rounded-pill" title="<?php echo $prog['descProgramme']; ?>"><?php echo $progdesc; ?></div>

                        <div class="inline center">
                            <button class="btn btn-outline-success mb-3 fw-bolder fs-5 w-50 border-5" onclick="goToPost('Structure/PageRandonee.php',<?php echo $prog['idProgramme']; ?>)" type="edit">Consulter</button>
                        </div>
                    </div>

                <?php
                } ?>

            </div>
            <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="tab-pane fade bg-white rounded p-2 col-6" id="rando_a_venir">
                <?php foreach ($progs as $prog) {
                    $time = $prog['dateArriveeProgramme'];
                    $hour = substr($time, 11, 2);
                    $min = substr($time, 14, 2);
                    $sec = substr($time, 17, 2);
                    $year = substr($time, 0, 4);
                    $month = substr($time, 5, 2);
                    $day = substr($time, 8, 2);
                    if (mktime($hour, $min, $sec, $month, $day, $year) < time()) {
                        continue;
                    }
                    ?>
                    <div class="card">
                        <div class="inline">
                            <label for="guide" class="form-label h4">Randonnée</label>
                            <div class="card-body h5"><?php echo $prog['labelProgramme']; ?></div>
                            <label for="guide" class="form-label h4">Difficulté</label>
                            <div class="card-body ">
                                <label class="bg-success text-centered"><?php echo $prog['difficulteProgramme']; ?></label>
                            </div>
                        </div>
                        <img src="<?php
                                    $photo = getPhotoOfExcursion(getExcsOfProg($prog)[0]['idExcursion']);

                                    $photolink = '../ASSETS/' . $photo['lienPhoto'];
                                    echo $photolink; ?>" class="img-fluid" alt="...">
                        <label for="guide" class="form-label h4">Date départ</label>
                        <input id="startDate" class="form-control" type="date" readonly="readonly" value="<?php echo substr($prog['dateDepartProgramme'], 0, 10); ?>" />
                        <label for="guide" class="form-label h4">Date arrivée</label>
                        <input id="endDate" class="form-control" type="date" readonly="readonly" value="<?php echo substr($prog['dateArriveeProgramme'], 0, 10); ?>" />
                        <label for="guide" class="form-label h4">Description</label>
                        <div class="card-body h5"><?php echo $prog['descProgramme']; ?></div>

                        <div class="inline center">
                            <button class="btn  btn-outline-success mb-1" onclick="goToPost('Structure/PageRandonee.php',<?php echo $prog['idProgramme']; ?>)" type="edit">Consulter</button>
                        </div>

                        <!--Modal formulaire de mofification-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Formulaire de modification</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus text-light bg-danger border rounded-pill fs-5 p-2">-</button>
                                                <input class="quantity fs-4 text-center border-0 g-0 fw-bold border-bottom border-bottom-5 border-secondary" style="outline: none!important;" min="0" name="quantity" value="0" type="number" step="1.0" date-prefix="€">
                                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus text-light bg-success border rounded-pill fs-5 p-2">+</button>
                                            </div>

                                            <legend for="selection">Départ</legend>
                                            <textarea class="form-control" aria-label="Départ et arriver"></textarea>

                                            <legend for="selection">Arrivée</legend>
                                            <textarea class="form-control" aria-label="Départ et arriver"></textarea>

                                            <div id="map-container-google-1" class="z-depth-1-half map-container m-3" style="height: 450px">
                                                <iframe src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyC46IZ31q8x_YylxY0FGZiM9QqkspgZL5w&origin=Pl.+des+Halles,+67000+Strasbourg&destination=KFC+Homme+de+fer&mode=walking" width="450" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-success">Modifier</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>
            </div>
        </div>
    </div>
</div>

<?php
$_SESSION['checkMailUtilisateur'] = $_SESSION['mailUtilisateur'];
?>