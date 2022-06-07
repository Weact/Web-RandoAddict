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

        <?php
        session_start();
        require_once(__DIR__ . '/../Include/programManager.php');

        $conn = connect_bd();
        $mng_Prog = new ManagerProgramme($conn);

        $passedPrograms = $mng_Prog->selectPassedProgrammeByMailMarcheur($_SESSION["mailUtilisateur"])["stmt"];
        $futurePrograms = $mng_Prog->selectFuturProgrammeByMailMarcheur($_SESSION["mailUtilisateur"])["stmt"];
        ?>

        <!---Contenus des onglets------------>

        <div class="tab-content">
            <div class="tab-pane fade show active bg-white rounded p-2" id="rando_effectuee">

                <div class="col-sm-16 col-md-9 col-lg-8 col-xl-7 mb-1 mx-auto" id="randonneeCardBase">
                    <?php
                    foreach ($passedPrograms as $p_Prog) {
                        $FirstPhoto = getFirstPhotoByProgrammeId($p_Prog[0]);
                        if (count($FirstPhoto) > 0) {
                            $photo = '../ASSETS/' . $FirstPhoto[0]['lienPhoto'];
                        } else {
                            $photo = '../ASSETS/PaysageRandonnee_2.jpg';
                        }
                    ?>
                        <div class="card text-dark fw-bold">
                            <img src="<?php echo $photo; ?>" alt="randonne image top" height="600" class="card-img-top">
                            <div class="card-img-overlay d-flex flex-column align-items-center" style="background-color: rgba(200,200,200,0.5);">
                                <div class="row">
                                    <div class="col-9">
                                        <h3 class="card-title display-3" id="randonneeTitre" name="randonneeTitre">
                                            <?php
                                            $name = $p_Prog[1];
                                            if (strlen($name) > 29) {
                                                $name = substr($name, 0, 30) . "...";
                                            }
                                            echo $name;

                                            ?>
                                        </h3>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center align-items-center">
                                        <span class="badge <?php echo getColorByDifficulty($p_Prog[6]); ?> fs-3 p-2"><?php echo $p_Prog[6]; ?></span>
                                    </div>
                                </div>
                                <div class="container-fluid d-flex justify-content-center align-items-center p-2 mb-2 border rounded border-primary" id="randonneeDescription" name="randonneeDescription" style="height:100%!important;">
                                    <p class="card-text"><?php echo $p_Prog[2]; ?></p>
                                </div>

                                <div class="d-flex flex-wrap row p-3 border rounded border-light justify-content-around font-monospace fw-bold" style="background-color: rgba(0, 125, 255, 0.55)">
                                    <div class="col-8">
                                        <h3 class="fs-3">Date de départ</h3>
                                        <p class="fs-6 text-dark"> <?php echo $p_Prog[3]; ?> </p>
                                    </div>
                                    <div class="col-8">
                                        <h3 class="fs-3">Date d'arrivée</h3>
                                        <p class="fs-6 text-dark"> <?php echo $p_Prog[4]; ?> </p>
                                    </div>
                                </div>

                                <input type="button" value="Consulter" class="btn btn-success w-100 mt-auto" onclick="goToPost('Structure/PageRandonee.php', <?php echo $p_Prog[0]; ?>)">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="tab-pane fade bg-white rounded p-2" id="rando_a_venir">
                <div class="col-sm-16 col-md-9 col-lg-8 col-xl-7 mb-1 mx-auto" id="randonneeCardBase">
                    <?php
                    foreach ($futurePrograms as $f_Prog) {
                        $FirstPhoto = getFirstPhotoByProgrammeId($f_Prog[0]);
                        if (count($FirstPhoto) > 0) {
                            $photo = '../ASSETS/' . $FirstPhoto[0]['lienPhoto'];
                        } else {
                            $photo = '../ASSETS/PaysageRandonnee_2.jpg';
                        }
                    ?>
                        <div class="card text-dark fw-bold">
                            <img src="<?php echo $photo; ?>" alt="randonne image top" height="600" class="card-img-top">
                            <div class="card-img-overlay d-flex flex-column align-items-center" style="background-color: rgba(200,200,200,0.5);">
                                <div class="row">
                                    <div class="col-9">
                                        <h3 class="card-title display-3" id="randonneeTitre" name="randonneeTitre">
                                            <?php
                                            $name = $f_Prog[1];
                                            if (strlen($name) > 29) {
                                                $name = substr($name, 0, 30) . "...";
                                            }
                                            echo $name;

                                            ?>
                                        </h3>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center align-items-center">
                                        <span class="badge <?php echo getColorByDifficulty($f_Prog[6]); ?> fs-3 p-2"><?php echo $f_Prog[6]; ?></span>
                                    </div>
                                </div>
                                <div class="container-fluid d-flex justify-content-center align-items-center p-2 mb-2 border rounded border-primary" id="randonneeDescription" name="randonneeDescription" style="height:100%!important;">
                                    <p class="card-text"><?php echo $f_Prog[2]; ?></p>
                                </div>

                                <div class="d-flex flex-wrap row p-3 border rounded border-light justify-content-around font-monospace fw-bold" style="background-color: rgba(0, 125, 255, 0.55)">
                                    <div class="col-8">
                                        <h3 class="fs-3">Date de départ</h3>
                                        <p class="fs-6 text-dark"> <?php echo $f_Prog[3]; ?> </p>
                                    </div>
                                    <div class="col-8">
                                        <h3 class="fs-3">Date d'arrivée</h3>
                                        <p class="fs-6 text-dark"> <?php echo $f_Prog[4]; ?> </p>
                                    </div>
                                </div>

                                <input type="button" value="Consulter" class="btn btn-success w-100 mt-auto" onclick="goToPost('Structure/PageRandonee.php', <?php echo $f_Prog[0]; ?>)">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>