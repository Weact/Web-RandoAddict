<?php

/*******************************************************************************\
 * Fichier       : /PHP/PageRandonee.php
 *
 * Description   : Fichier PHP incluant les ressources php et html nécéssaires pour la page
 * Fonction      : -.
 *
 * Créateur      : Gaetan Galati
 * Superviseur   : Lucas DRUCKES
\*******************************************************************************/
/*******************************************************************************\
 * 23-03-2022    : Création page
 * 28-03-2022    : Pull Request et mise en commun avec le travail général
\*******************************************************************************/

session_start();
require_once(__DIR__ . '/../Include/programManager.php');

// Get programme by ID
$conn = connect_bd();
$mng_Prog = new ManagerProgramme($conn);
$program = json_decode(json_encode($mng_Prog->selectProgrammeById($_POST['idProg'])['programme']), true);

// var_dump($program);

$mng_Exc = new ManagerExcursion($conn);
$excursions = $mng_Exc->selectExcursionsByProgrammeId($_POST['idProg'])['stmt'];

// $excursions = getAllExcursionsFromProgram($program);

$photoHeight = "200";
$photoWidth = "200";

$FirstPhoto = getFirstPhotoByProgrammeId($program['idProg']);
if (count($FirstPhoto) > 0) {
    $photo = '../ASSETS/' . $FirstPhoto[0]['lienPhoto'];
} else {
    $photo = '../ASSETS/PaysageRandonnee_2.jpg';
}
?>

<section class="py-5 text-center container">
    <div class="col-sm-16 col-md-9 col-lg-8 col-xl-7 mb-1 mx-auto" id="randonneeCardBase">
        <div class="card text-dark fw-bold">
            <img src="<?php echo $photo; ?>" alt="randonne image top" class="card-img-top">
            <div class="card-img-overlay d-flex flex-column align-items-center" style="background-color: rgba(200,200,200,0.5);">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title display-3" id="randonneeTitre" name="randonneeTitre">
                            <?php
                            $name = $program['labelProg'];
                            if (strlen($name) > 29) {
                                $name = substr($name, 0, 30) . "...";
                            }
                            echo $name;

                            ?>
                        </h3>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center">
                        <span class="badge <?php echo getColorByDifficulty($program["diffProg"]); ?> fs-3 p-2"><?php echo $program["diffProg"]; ?></span>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-center align-items-center p-2 mb-2 border rounded border-primary" id="randonneeDescription" name="randonneeDescription" style="height:100%!important;">
                    <p class="card-text"><?php echo $program['descProg']; ?></p>
                </div>

                <div class="d-flex flex-wrap row p-3 border rounded border-light justify-content-around font-monospace fw-bold" style="background-color: rgba(0, 125, 255, 0.55)">
                    <div class="col-8">
                        <h3 class="display-6">Date de départ</h3>
                        <p class="fs-4 text-dark"> <?php echo $program['departProg']; ?> </p>
                    </div>
                    <div class="col-8">
                        <h3 class="display-6">Date d'arrivée</h3>
                        <p class="fs-4 text-dark"> <?php echo $program['arriveeProg']; ?> </p>
                    </div>

                    <?php

                    if (isset($_SESSION['mailUtilisateur'])) {
                        if (strtolower($_SESSION['typeUtilisateur']) != "anon" && strtolower($_SESSION['typeUtilisateur'] != '')) {
                    ?>
                            <form id="join_prog" name="join_prog" class="form" method="POST" action="#">
                                <input hidden name="idMarcheurJoin" value="<?php echo $_SESSION['mailUtilisateur']; ?> "></input>
                                <input hidden name="roleMarcheurJoin" value="Marcheur"></input>
                                <input hidden name="idProgJoin" value="<?php echo $program['idProg']; ?>"></input>
                                <button type="submit" class="btn btn-outline-warning mt-2 m-1 font-monospace fw-bold">Rejoindre en tant que Marcheur</button>
                            </form>
                    <?php
                        }
                    }
                    ?>

                </div>
                <?php
                if (isset($_SESSION["typeUtilisateur"])) {
                    if (strtolower($_SESSION["typeUtilisateur"]) == "admin") {
                        include_once("FormProg.php");
                        $id = $program['idProg'];
                        include_once('../Include/adminGestion.php');
                    }
                }
                ?>
            </div>
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


                        <div class="card-body bg-dark">
                            <p class="card-text fs-5"><?php echo $excursion['descExcursion'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-md btn-outline-success p-1 m-1 fs-5 fw-bold uppercase">View</button>
                                    <?php
                                    if (isset($_SESSION["typeUtilisateur"])) {
                                        if (strtolower($_SESSION["typeUtilisateur"]) == "admin") {
                                    ?>
                                            <button type="button" class="btn btn-md btn-outline-warning p-1 m-1 fs-5 fw-bold uppercase">Edit</button>

                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                                <small class="lead text-light fs-2"><?php echo $excursion['prixExcursion'] ?>€</small>
                            </div>
                            <div class="d-flex justify-content-between align-items-center shadow-mg bg-dark text-light">
                                <small class="lead fs-2 text-capitalize"><?php echo $excursion['departExcursion'] ?> </small>
                                <small class="lead fs-2 text-capitalize"><?php echo $excursion['arriveeExcursion'] ?></small>
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