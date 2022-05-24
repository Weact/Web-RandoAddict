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
$program = getProgramById($_POST['idProg']);
?>


<section>
    <h1 class="text-center" style="padding-top: 10%;"><?php echo $program['labelProgramme']?></h1>
    <h2 class="text-center">Difficulté <?php echo $program['difficulteProgramme']?></h2>


    <div class="d-flex justify-content-center">
        <iframe
            src="https://www.google.com/maps/embed/v1/directions?key=AIzaSyC46IZ31q8x_YylxY0FGZiM9QqkspgZL5w&origin=Pl.+des+Halles,+67000+Strasbourg&destination=KFC+Homme+de+fer&mode=walking"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class=" text-dark font-weigh-bolder text-uppercase m-3"
        style=" border-radius: 30px; background-color: rgba(180, 180, 180, 0.8)">
        <div class="row m-5">
            <div class="col-12">
                <div class="embed-responsive embed-responsive-1by1 text-center">
                    <div class="embed-responsive-item h3">DESCRIPTION</div>
                    <div class="embed-responsive-item"><?php echo $program['descProgramme']?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-2 embed-responsive-item h4">Depart</div>
                <div class="col-2 embed-responsive-item">LIEU DE DEPART</div>
                <div class="col-2 embed-responsive-item"><?php echo $program['dateDepartProgramme']?></div>
                <div class="w-100 "></div>
                <div class="col-2 embed-responsive-item h4">Arrivée</div>
                <div class="col-2 embed-responsive-item">LIEU D'ARRIVÉE </div>
                <div class="col-2 embed-responsive-item"><?php echo $program['dateArriveeProgramme']?></div>
                <div class="w-100 "></div>
                <div class="col-2 embed-responsive-item h4">Matériel</div>
                <?php $mats = getMatsOfProg($program['idProgramme']);
                foreach($mats as $material) { ?>
                  <div class="col-2 embed-responsive-item">
                    <?php echo $material['labelMateriel']; ?>
                  </div>
                <?php
              }
                ?>

                <div class="w-100 "></div>
                <span
                    class="col-1 d-flex justify-content-center fs-5 bg-dark text-light border rounded-pill border-5 border-primary m-3">

                <?php echo $program['idProgramme']?>0.00 $</span>
                <?php
                if(isset($_SESSION['typeUtilisateur']))
                {
                  if($_SESSION['typeUtilisateur'] != "anon")
                  {
                    echo '<button type="button" class="btn btn-primary ">Rejoindre comme randonneur</button>';
                  }
                  if($_SESSION['typeUtilisateur'] == "Admin" || $_SESSION['typeUtilisateur'] == "Guide")
                  {
                    echo '<button type="button" class="btn btn-success ">Rejoindre comme Guide</button>';
                  }
                }?>
                <p
                    style="display: flex; color: white; display: flex; justify-content : center; font-size: larger; background-color: black;">
                    <span>0 </span> <span> / </span> <span> <?php echo $program['capaciteProgramme']?> </span> Participants
                </p>
            </div>
        </div>
    </div><?php
    if (isset($_SESSION['typeUtilisateur']))
    {
    if ($_SESSION['typeUtilisateur'] == "Admin"){
    ?>
    <div class="d-flex p-2 border rounded m-2" style="background-color: rgba(0, 125, 200, 0.3)">
        <button class="btn btn-outline-danger mt-2 m-1" style="width: 10em;">
            <i class="bi bi-trash-fill fs-3 fw-bold" aria-hidden="true"></i>
        </button>
    </div>
    <?php
  }}?>

    <style>
        body {
            /* a changer en fonction de la randonnée */
            background-image: url('/ASSETS/PaysageRandonnee_2.jpg');
        }
    </style>
</section>
