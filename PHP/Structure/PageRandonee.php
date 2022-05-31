<?php

/*******************************************************************************\
 * Fichier       : /PHP/PageRandonee.php
 *
 * Description   : Fichier PHP incluant les ressources php et html nécéssaires pour la page
 * Fonction      : -.for
 *
 * Créateur      : Lucas DRUCKES
\*******************************************************************************/
/*******************************************************************************\
 * 23-03-2022    : Création page
 * 28-03-2022    : Pull Request et mise en commun avec le travail général
\*******************************************************************************/

session_start();
require_once(__DIR__ . '/../Include/programManager.php');

// PROGRAM MANAGEMENT
$program = getProgramById($_POST['idProg']);

//EXCURSIONS MANAGEMENT
$excursions = getAllExcursionsFromProgram($program);

$photoHeight = "200";
$photoWidth = "200";

$prixtotal = 0;
foreach ($excursions as $excursion) {
    $prixtotal = $prixtotal + $excursion['prixExcursion'];

?>
    <div class="modal fade text-dark" id="SeeExcModal<?php echo strtoupper($excursion['idExcursion']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title display-5" id="terrainModalLabel"><?php echo strtoupper("excursion ".$excursion['labelExcursion']); ?></h5>
                </div>
                <div class="modal-body font-monospace">
                    <h5 class="modal-title display-6 shadow-lg text-success" id="terrainModalLabel">ID</h5>

                    <p for="titre" class="form-label fs-4 shadow-sm text-primary"><?php echo $excursion['idExcursion']; ?></p>
                    <h5 class="modal-title display-6 shadow-lg text-success" id="terrainModalLabel">NOM</h5>
                    <p for="titre" class="form-label fs-4 shadow-sm text-primary"><?php echo $excursion['labelExcursion']; ?></p>
                    <h5 class="modal-title display-6 shadow-lg text-success" id="terrainModalLabel">DESCRIPTION</h5>
                    <p for="titre" class="form-label fs-4 shadow-sm text-primary"><?php echo $excursion['descExcursion']; ?></p>
                    <h5 class="modal-title display-6 shadow-lg text-success" id="terrainModalLabel"><?php echo strtoupper("lieu de départ"); ?></h5>
                    <p for="titre" class="form-label fs-4 shadow-sm text-primary"><?php echo $excursion['departExcursion']; ?></p>
                    <h5 class="modal-title display-6 shadow-lg text-success" id="terrainModalLabel"><?php echo strtoupper("lieu d'arrivée"); ?></h5>
                    <p for="titre" class="form-label fs-4 shadow-sm text-primary"><?php echo $excursion['arriveeExcursion']; ?></p>
                    <h5 class="modal-title display-6 shadow-lg text-success" id="terrainModalLabel">PRIX DE L'EXCURSION</h5>
                    <p for="titre" class="form-label fs-4 shadow-sm text-primary"><?php echo $excursion['prixExcursion']; ?>€</p>
                    <img src="<?php echo "../ASSETS/" . getPhotoOfExcursion($excursion['idExcursion'])['lienPhoto'] ?>" width="500" height="500" alt="randonne image top" class="card-img-top">
                    <title><?php echo $excursion['labelExcursion']  ?></title>
                    <rect width="100%" height="100%" fill="#55595c">
                        </img>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn-close fs-5" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
<?php
}

?>
<section class="py-5 text-center container">
    <div class="row py-3 shadow-lg">
        <div class="col mx-auto bg-light">
            <h1 class="d-flex justify-content-around align-items-stretch fw-bolder display-3 text-dark shadow-lg p-3 my-4 text-uppercase rounded rounded-5">

                <?php
                echo $program['labelProgramme'];
                ?>
                <?php
                if (isset($_SESSION["typeUtilisateur"])) {
                    if (strtolower($_SESSION["typeUtilisateur"]) == "admin") {
                ?>
                        <form id='deleteProgForm' name='deleteProgForm' class="form" method="POST" action="#">
                            <button class="btn btn-outline-danger mt-2 m-1" style="width: 10em;" type="submit" name="deleteProgID" value="<?php echo $program['idProgramme'] ?>">
                                <i class="bi bi-trash-fill fs-3 fw-bold" aria-hidden="true"></i>
                            </button>
                        </form>
                <?php
                    }
                }
                ?>
            </h1>
            <p class="shadow-sm lead fs-4 text-dark shadow-lg py-3 font-monospace">

                <?php
                echo $program['descProgramme'];
                ?>

            </p>

            <?php
            $dateDepart = new DateTime($program['dateDepartProgramme']);
            $dateArrivee = new DateTime($program['dateArriveeProgramme']);
            $dateFormat = "H\hi d/m/Y";

            $dateDepart = $dateDepart->format($dateFormat);
            $dateArrivee = $dateArrivee->format($dateFormat);
            ?>

            <div class="d-flex justify-content-evenly flex-wrap shadow-sm lead fs-4 text-dark shadow-lg py-3 font-monospace fw-bold">
                <p class="p-3 display-6">
                    <i class="bi bi-arrow-up-circle-fill"></i>

                    <?php
                    echo $dateDepart;
                    ?>
                </p>
                <p class="p-3 display-6">
                    <?php
                    echo $dateArrivee;
                    ?>
                    <i class="bi bi-arrow-down-circle-fill"></i>
                </p>
            </div>

            <div class="d-flex justify-content-evenly flex-wrap shadow-sm shadow-lag py-3 my-3 font-monospace fw-bold">
                <span class="badge rounded-pill fs-4 lead p-4 text-dark">
                    <?php
                    echo ucfirst("prix total à régler: ") . $prixtotal . "€";
                    ?>
                </span>
                <span class="badge rounded-pill fs-4 lead p-4 text-dark">
                    <?php
                    echo ucfirst("Difficulté de la randonné: ") . $program['difficulteProgramme'];
                    ?>
                </span>
            </div>

            <p>
                <?php
                if (isset($_SESSION['typeUtilisateur'])) {
                    if (strtolower($_SESSION['typeUtilisateur']) == "guide" || strtolower($_SESSION['typeUtilisateur']) == "admin") {
                ?>
            <form id="join_prog" name="join_prog" class="form" method="POST" action="#">
                <input hidden name="idMarcheurJoin" value="<?php echo $_SESSION['mailUtilisateur']; ?> "></input>
                <input hidden name="roleMarcheurJoin" value="Guide"></input>
                <input hidden name="idProgJoin" value="<?php echo $program['idProgramme']; ?>"></input>
                <button type="submit" class="btn btn-success my-2 fs-3 fw-bold">Rejoindre en tant que Guide</button>
            </form>
    <?php
                    }
                }
    ?>
    <?php
    if (isset($_SESSION['typeUtilisateur'])) {
        if (strtolower($_SESSION['typeUtilisateur']) != "anon" && strtolower($_SESSION['typeUtilisateur'] != '')) {
    ?>
            <form id="join_prog" name="join_prog" class="form" method="POST" action="#">
                <input hidden name="idMarcheurJoin" value="<?php echo $_SESSION['mailUtilisateur']; ?> "></input>
                <input hidden name="roleMarcheurJoin" value="Marcheur"></input>
                <input hidden name="idProgJoin" value="<?php echo $program['idProgramme']; ?>"></input>
                <button type="submit" class="btn btn-primary my-2 fs-3 fw-bold">Rejoindre en tant que Marcheur</button>
            </form>
    <?php
        }
    }
    ?>

    </p>
        </div>
    </div>
</section>

<div class="album py-5">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($excursions as $excursion) {
            ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="<?php echo "../ASSETS/" . getPhotoOfExcursion($excursion['idExcursion'])['lienPhoto'] ?>" width="<?php echo $photoWidth ?>" height="<?php echo $photoHeight ?>" alt="randonne image top" class="card-img-top">
                        <title><?php echo $excursion['labelExcursion']  ?></title>
                        <rect width="100%" height="100%" fill="#55595c">
                            </img>

                            <div class="card-body bg-dark">
                                <p class="card-text fs-5"><?php echo $excursion['descExcursion'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group col-8">
                                        <button type="button" class="btn btn-md btn-outline-success p-1 m-1 fs-4 fw-bold uppercase" data-bs-toggle="modal" data-bs-target="#SeeExcModal<?php echo $excursion['idExcursion'] ?>">
                                            Détails
                                        </button>

                                    </div>
                                    <span class="badge rounded-pill bg-primary fs-5 lead fw-bolder"><?php echo $excursion['prixExcursion'] ?>€</span>
                                </div>
                                <div class="d-flex flex-wrap justify-content-between align-items-center shadow-mg bg-dark text-light">
                                    <small class="lead fs-2 text-capitalize" title="<?php echo $excursion['departExcursion']; ?>">
                                        <?php
                                        $e_depart = $excursion['departExcursion'];

                                        if (strlen($e_depart) > 6) {
                                            $e_depart = substr($e_depart, 0, 7) . "";
                                            $e_depart = str_replace(" ", "_", $e_depart);
                                            $e_depart = $e_depart . "...";
                                        }

                                        echo $e_depart;
                                        ?>
                                    </small>
                                    <small class="lead fs-2 text-capitalize" title="<?php echo $excursion['arriveeExcursion']; ?>">
                                        <?php
                                        $e_arrivee = $excursion['arriveeExcursion'];

                                        if (strlen($e_arrivee) > 6) {
                                            $e_arrivee = substr($e_arrivee, 0, 7) . "";
                                            $e_arrivee = str_replace(" ", "_", $e_arrivee);
                                            $e_arrivee = $e_arrivee . "...";
                                        }

                                        echo $e_arrivee;
                                        ?>
                                    </small>
                                </div>
                            </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>