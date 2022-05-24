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

?>
<section class="py-5 text-center container">
    <div class="row py-3 shadow-lg">
        <div class="col mx-auto bg-light">
            <h1 class="fw-bolder display-3 text-dark shadow-lg p-3 my-4 text-uppercase rounded rounded-5">

                <?php
                echo $program['labelProgramme'];
                ?>

            </h1>
            <p class="shadow-sm lead fs-4 text-dark shadow-lg py-3 font-monospace">

                <?php
                echo $program['descProgramme'];
                ?>

            </p>
            <p>
                <a href="#" class="btn btn-success my-2 fs-3 fw-bold">Rejoindre en tant que Guide</a>
                <a href="#" class="btn btn-primary my-2 fs-3 fw-bold">Rejoindre en tant que Marcheur</a>
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
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-md btn-outline-success p-1 m-1 fs-5 fw-bold uppercase">View</button>
                                        <button type="button" class="btn btn-md btn-outline-warning p-1 m-1 fs-5 fw-bold uppercase">Edit</button>
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