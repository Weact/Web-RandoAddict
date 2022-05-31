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
$program = getProgramById($_POST['value']);

//EXCURSIONS MANAGEMENT
$excursions = getAllExcursionsFromProgram($program);

$photoHeight = "200";
$photoWidth = "200";

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
                            <button class="btn btn-outline-danger mt-2 m-1" style="width: 10em;" type="submit" name="deleteProgId" value="<?php echo $program['idProgramme'] ?>">
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

                ?><p class="d-flex justify-content-around align-items-stretch fw-bolder display-6 text-dark shadow-lg p-3 my-4 text-uppercase rounded rounded-5">


                <?php
                $prix = 0.0;
                foreach ($excursions as $excursion) {
                  $prix += (float)$excursion['prixExcursion'];
                }
                  echo $prix."€";?>
                </p>
            </p>

            <p class="shadow-sm lead fs-7 text-dark shadow-lg py-3 font-monospace">

                <?php
                echo "Depart : ". $program['dateDepartProgramme']."<br>";
                echo "Arrive : ". $program['dateArriveeProgramme'];

                ?>



                </p>
            </p>

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
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-md btn-outline-success p-1 m-1 fs-5 fw-bold uppercase" data-bs-toggle="modal"
                                      data-bs-target="#SeeExcModal<?php echo $excursion['idExcursion'] ?>">View</button>
                                      
                                        <?php
                                        if (isset($_SESSION["typeUtilisateur"])) {
                                            if (strtolower($_SESSION["typeUtilisateur"]) == "admin") {
                                        ?>



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
                </div><div class="modal fade text-dark" id="SeeExcModal<?php echo $excursion['idExcursion'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="terrainModalLabel">Excursion <?php echo $excursion['labelExcursion']?></h5>
                      </div>
                      <div class="modal-body">
                        <h5 class="modal-title" id="terrainModalLabel">ID</h5>

                        <p for="titre" class="form-label h6"><?php echo $excursion['idExcursion'];?></p>
                          <h5 class="modal-title" id="terrainModalLabel">Nom</h5>
                        <p for="titre" class="form-label h6"><?php echo $excursion['labelExcursion'];?></p>
                          <h5 class="modal-title" id="terrainModalLabel">Description</h5>
                        <p for="titre" class="form-label h6"><?php echo $excursion['descExcursion'];?></p>
                          <h5 class="modal-title" id="terrainModalLabel">Lieu de départ</h5>
                        <p for="titre" class="form-label h6"><?php echo $excursion['departExcursion'];?></p>
                          <h5 class="modal-title" id="terrainModalLabel">Lieu d'arrivé</h5>
                        <p for="titre" class="form-label h6"><?php echo $excursion['arriveeExcursion'];?></p>
                          <h5 class="modal-title" id="terrainModalLabel">Prix de l'excursion</h5>
                        <p for="titre" class="form-label h6"><?php echo $excursion['prixExcursion'];?></p>
                        <img src="<?php echo "../ASSETS/" . getPhotoOfExcursion($excursion['idExcursion'])['lienPhoto'] ?>" width="<?php echo $photoWidth ?>" height="<?php echo $photoHeight ?>" alt="randonne image top" class="card-img-top">
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

        </div>


    </div>
</div>
