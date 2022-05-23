<?php
require_once(__DIR__."/../Include/programManager.php");
$programs = getAllPrograms();

// require_once(__DIR__."/../Include/programManager.php");
// $escales = getProgramById(19);
// var_dump($escales);

foreach ($programs as $program) {
    echo '<div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 mb-1" id="randonneeCardBase">
        <div class="card text-dark fw-bold">
            <img src="../ASSETS/RandoPaysage_KFC.png" alt="randonne image top" class="card-img-top">
            <div class="card-img-overlay d-flex flex-column align-items-center">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title display-3" id="randonneeTitre" name="randonneeTitre">'.$program[1].'</h3>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center">
                        <span class="badge bg-primary fs-3 p-2">1</span>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-center align-items-center p-2 mb-2 border rounded border-primary" id="randonneeDescription" name="randonneeDescription" style="background-color: rgba(200,200,200,0.5); height:100%!important;">
                    <p class="card-text">'.$program[2].'</p>
                </div>
                <input type="button" value="Consulter" class="btn btn-success w-100 mt-auto">
                <div class="d-flex p-2 border rounded m-2" style="background-color: rgba(0, 125, 200, 0.3)">
                    <button class="btn btn-outline-warning mt-2 m-1" style="width: 10em;">
                        <i class="bi bi-pencil-square fs-3 fw-bold" aria-hidden="true"></i>
                    </button>
                    <button class="btn btn-outline-danger mt-2 m-1" style="width: 10em;">
                        <i class="bi bi-trash-fill fs-3 fw-bold" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>';
}
?>