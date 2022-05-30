<?php
require_once(__DIR__ . "/../Include/programManager.php");


$programs;
if (isset($_POST['rechercheRandonnee'])) {
    $programs = getProgramsByName(strtolower($_POST['rechercheRandonnee']));
} else {
    $programs = getAllPrograms();
}

foreach ($programs as $program) {
    $name = $program[1];
    $difficulty = $program[6];
    $description = $program[2];

    if (strlen($name) > 8) {
        $name = substr($name, 0, 9) . "";
        $name = str_replace(" ", "_", $name);
    }
    if (strlen($description) > 250) {
        $description = substr($description, 0, 251) . "";
    }

    $FirstPhoto = getPhotoOfExcursion(getExcsOfProg($program)[0]['idExcursion']);

    $photo = '../ASSETS/' . $FirstPhoto[1] . '';
    $photoWidth = "400";
    $photoHeight = "400";

    if (!file_exists($photo)) {
        $photo = '../ASSETS/' . $FirstPhoto[1] . '';
    }
?>

    <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 mb-1" id="randonneeCardBase">
        <div class="card text-dark fw-bold">
            <img src="<?php echo $photo ?>" width="<?php echo $photoWidth ?>" height="<?php echo $photoHeight ?>" alt="randonne image top" class="card-img-top">
            <div class="card-img-overlay d-flex flex-column align-items-center">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title display-5 text-light font-monospace border border-2 border-success p-2 text-capitalize" style="background-color: rgba(0, 100, 230, 0.3);" id="randonneeTitre" name="randonneeTitre"><?php echo $name ?></h3>
                    </div> <!-- 1 -->
                    <div class="col d-flex justify-content-center align-items-center">
                        <span class="badge bg-primary fs-3 p-2"><?php echo $difficulty ?></span>
                    </div> <!-- 2 -->
                </div> <!-- 3 -->
                <div class="container-fluid d-flex justify-content-center align-items-center p-2 mb-2 border rounded border-primary" id="randonneeDescription" name="randonneeDescription" style="background-color: rgba(200,200,200,0.5); height:100%!important;">
                    <p class="card-text"><?php echo $description ?></p>
                </div> <!-- 4 -->
                <input type="button" value="Consulter" class="btn btn-success w-100 mt-auto" onclick="goToPost('Structure/PageRandonee.php?',<?php echo $program['idProgramme'] ?>);">

                <?php
                if (isset($_SESSION["typeUtilisateur"])) {
                ?>
                    <div class="d-flex justify-content-around p-2 border rounded m-2" style="background-color: rgba(0, 125, 200, 0.3)">
                        <?php
                        if (strtolower($_SESSION["typeUtilisateur"]) == "admin") {
                        ?>

                            <form method="POST" action="#" id="editProgForm">
                                <button class="btn btn-outline-warning mt-2 m-1" style="width: 10em;" type="submit" name="editProgID" value="<?php echo $program['idProgramme'] ?>">
                                    <i class="bi bi-pencil-square fs-3 fw-bold" aria-hidden="true"></i>
                                </button>
                            </form>
                            <form id='deleteProgForm' name='deleteProgForm' class="form" method="POST" action="#">
                                <button class="btn btn-outline-danger mt-2 m-1" style="width: 10em;" type="submit" name="deleteProgID" value="<?php echo $program['idProgramme'] ?>">
                                    <i class="bi bi-trash-fill fs-3 fw-bold" aria-hidden="true"></i>
                                </button>
                            </form>
                            <?php
                        }
                        if (isset($_SESSION["mailUtilisateur"])) {
                            $participations = getParticipantsProg($program['idProgramme']);

                            foreach ($participations as $participation) {
                                $real_participant_mail = str_replace(" ", "", $participation["mailMarcheur"]);
                                $mail_logged_user = str_replace(" ", "", $_SESSION["mailUtilisateur"]);

                                if ($real_participant_mail == $mail_logged_user) {
                            ?>
                                    <form method="POST" action="#" id="leavePartiProgID">
                                        <button class="btn btn-outline-light mt-2 m-1" style="width: 10em;" type="submit" name="leaveProgID" value="<?php echo $program['idProgramme'] ?>">
                                            <i class="bi bi-door-open-fill fs-3 fw-bold" aria-hidden="true"></i>
                                        </button>
                                    </form>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div> <!-- 5 -->
                <?php
                }
                ?>
            </div> <!-- 6 -->
        </div> <!-- 7 -->
    </div> <!-- 8 -->

<?php
}
?>