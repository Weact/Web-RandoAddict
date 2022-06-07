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
            <div class="tab-pane fade show active bg-white rounded p-2 align-items-center col-12" id="rando_effectuee">

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
                    <div class="card m-3 p-3 font-monospace align-items-center">
                        <div class="inline col-12">
                            <label for="guide" class="form-label display-4 fw-bolder text-primary">Randonnée</label>
                            <div class="card-body display-6 fw-bold shadow"><?php echo $prog['labelProgramme']; ?></div>
                            <label for="guide" class="form-label display-4 fw-bolder text-primary">Difficulté</label>
                            <div class="card-body">
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

                                    echo $photolink; ?>" class="img-fluid w-50" alt="...">
                        <label for="guide" class="form-label display-4 fw-bolder text-primary">Date départ</label>
                        <input id="startDate" class="form-control p-3 bg-success text-light fs-3 fw-bold text-center w-50" type="date" readonly="readonly" value="<?php echo substr($prog['dateDepartProgramme'], 0, 10); ?>" />
                        <label for="guide" class="form-label display-4 fw-bolder text-primary w-50">Date arrivée</label>
                        <input id="endDate" class="form-control p-3 bg-success text-light fs-3 fw-bold text-center w-50" type="date" readonly="readonly" value="<?php echo substr($prog['dateArriveeProgramme'], 0, 10); ?>" />
                        <label for="guide" class="form-label display-4 fw-bolder text-primary">Description</label>
                        <div class="card-body h5 text-info bg-dark rounded rounded-5 rounded-pill w-50" title="<?php echo $prog['descProgramme']; ?>"><?php echo $progdesc; ?></div>

                        <div class="inline center col-6 m-2">
                            <button class="btn btn-outline-success mb-3 fw-bolder fs-2 border-5 w-100" onclick="goToPost('Structure/PageRandonee.php',<?php echo $prog['idProgramme']; ?>)" type="edit">Consulter</button>
                        </div>
                    </div>

                <?php
                } ?>

            </div>
            <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="tab-pane fade bg-white rounded p-2 col-12" id="rando_a_venir">
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

                    $progdesc = $prog['descProgramme'];
                    if (strlen($progdesc) > 125) {
                        $progdesc = substr($progdesc, 0, 126) . " [...]";
                    }

                    ?>
                    <div class="card m-3 p-3 font-monospace align-items-center">
                        <div class="inline col-12">
                            <label for="guide" class="form-label display-4 fw-bolder text-primary">Randonnée</label>
                            <div class="card-body display-6 fw-bold shadow"><?php echo $prog['labelProgramme']; ?></div>
                            <label for="guide" class="form-label display-4 fw-bolder text-primary">Difficulté</label>
                            <div class="card-body">
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

                                    echo $photolink; ?>" class="img-fluid w-50" alt="...">
                        <label for="guide" class="form-label display-4 fw-bolder text-primary">Date départ</label>
                        <input id="startDate" class="form-control p-3 bg-success text-light fs-3 fw-bold text-center w-50" type="date" readonly="readonly" value="<?php echo substr($prog['dateDepartProgramme'], 0, 10); ?>" />
                        <label for="guide" class="form-label display-4 fw-bolder text-primary w-50">Date arrivée</label>
                        <input id="endDate" class="form-control p-3 bg-success text-light fs-3 fw-bold text-center w-50" type="date" readonly="readonly" value="<?php echo substr($prog['dateArriveeProgramme'], 0, 10); ?>" />
                        <label for="guide" class="form-label display-4 fw-bolder text-primary">Description</label>
                        <div class="card-body h5 text-info bg-dark rounded rounded-5 rounded-pill w-50" title="<?php echo $prog['descProgramme']; ?>"><?php echo $progdesc; ?></div>

                        <div class="inline center col-6 m-2">
                            <button class="btn btn-outline-success mb-3 fw-bolder fs-2 border-5 w-100" onclick="goToPost('Structure/PageRandonee.php',<?php echo $prog['idProgramme']; ?>)" type="edit">Consulter</button>
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