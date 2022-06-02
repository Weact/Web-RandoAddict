<!-- Modal -->
<?php
include_once("FormProg.php");
require_once(__DIR__ . "/../Include/programManager.php");

$programs;
if (isset($_POST['labelProg']) && $_POST['labelProg'] != '') {
    $programs = getProgramsByName($_POST['labelProg']);
} else {
    $programs = getAllValidePrograms();
}

foreach ($programs as $program) {
    $name = $program[1];

    if (strlen($program[1]) > 8) {
        $name = substr($name, 0, 9) . "...";
    }

    $FirstPhoto = getFirstPhotoByProgrammeId($program['idProgramme']);
    if (count($FirstPhoto) > 0) {
        $photo = '../ASSETS/' . $FirstPhoto[0]['lienPhoto'];
    } else {
        $photo = '../ASSETS/PaysageRandonnee_2.jpg';
    }
    // var_dump($FirstPhoto);

    echo '<div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 mb-1" id="randonneeCardBase' . $program[0] . '">
        <div class="card text-dark fw-bold">
            <img src="' . $photo . '" width="400" height="400" alt="randonne image top" class="card-img-top">
            <div class="card-img-overlay d-flex flex-column align-items-center" style="background-color: rgba(200,200,200,0.5);">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title display-3" id="randonneeTitre" name="randonneeTitre">' . $name . '</h3>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center">
                        <span class="badge ' . getColorByDifficulty($program[6]) . ' fs-3 p-2">' . $program[6] . '</span>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-center align-items-center p-2 mb-2 border rounded border-primary" id="randonneeDescription" name="randonneeDescription" style="height:100%!important;">
                    <p class="card-text">' . $program[2] . '</p>
                </div>
                <input type="button" value="Consulter" class="btn btn-success w-100 mt-auto" onclick="goToPost(\'Structure/PageRandonee.php\','. $program[0] .');">';

    if (isset($_SESSION) && $_SESSION['nomUtilisateur'] == 'admin') {
        // var_dump($_SESSION);
        $id = $program[0];
        include('../Include/adminGestion.php');
    }

    echo '</div>
        </div>
    </div>';
}
?>