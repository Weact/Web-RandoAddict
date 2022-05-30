<!-- Modal -->
<?php
include_once("FormProg.php");
require_once(__DIR__ . "/../Include/programManager.php");

$programs;
if (isset($_POST['labelProg'])) {
    $programs = getProgramsByName($_POST['labelProg']);
} else {
    $programs = getAllPrograms();
}

// $conn = connect_bd();
// $mng_Prog = new ManagerProgramme($conn)
// var_dump ($mng_Prog->selectProgrammeById(137)["programme"]);

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
                        <span class="badge bg-primary fs-3 p-2">1</span>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-center align-items-center p-2 mb-2 border rounded border-primary" id="randonneeDescription" name="randonneeDescription" style="height:100%!important;">
                    <p class="card-text">' . $program[2] . '</p>
                </div>
                <input type="button" value="Consulter" class="btn btn-success w-100 mt-auto" onclick="goToPost(\'Structure/PageRandonee.php\','. $program[0] .');">';

    if (isset($_SESSION) && $_SESSION['nomUtilisateur'] == 'admin') {
        // var_dump($_SESSION);
        echo '<div class="d-flex p-2 border rounded m-2" style="background-color: rgba(0, 125, 200, 0.3)">
                <button class="btn btn-outline-warning mt-2 m-1" id="edt' . $program[0] . '" onclick="editSelf(' . $program[0] . ')" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: 10em;">
                    <i class="bi bi-pencil-square fs-3 fw-bold" aria-hidden="true"></i>
                </button>
                <button class="btn btn-outline-danger mt-2 m-1" id="del' . $program[0] . '" onclick="deleteSelf(' . $program[0] . ')" style="width: 10em;">
                    <i class="bi bi-trash-fill fs-3 fw-bold" aria-hidden="true"></i>
                </button>
            </div>

            <script>
                function editSelf(id) {
                    $.post("./Include/programManager.php", {action: "edit", idProg: id}, function (data, status) {
                        let result = jQuery.parseJSON(data);
                        if (result["success"]) {
                            // console.log(result["programme"]);
                            document.getElementById("selectionNom").value = result["programme"]["labelProg"];
                            document.getElementById("descProg").value = result["programme"]["descProg"];
                            document.getElementById("selectionTerrain").value = result["programme"]["diffProg"];
                            document.getElementById("selectionQuantite").value = result["programme"]["capaciteProg"];

                            let depart = result["programme"]["departProg"].split(" ");
                            document.getElementById("startDate").value = depart[0]; 
                            document.getElementById("startHour").value = depart[1];
                            let arrivee = result["programme"]["arriveeProg"].split(" ");
                            document.getElementById("arriveDate").value = arrivee[0];
                            document.getElementById("arriveHour").value = arrivee[1];

                            $.post("./Include/programManager.php", {action: "edit2", idProg: id}, function (data, status) {
                                let response = jQuery.parseJSON(data);
                                if (response["success"]) {
                                    // console.log(response["stmt"]);
                                    let values = [];
                                    response["stmt"].forEach(returnValue);

                                    function returnValue(item, index, arr) {
                                        values.push(item[0]);
                                    }

                                    let element = document.getElementById("selectionRando00");
                                    for (let i = 0; i < element.options.length; i++)
                                    {
                                        element.options[i].selected = values.includes(element.options[i].value);
                                    }


                                }else{
                                    alert("erreur");
                                }
                            });

                            $.post("./Include/programManager.php", {action: "edit3", idProg: id}, function(data, status) {
                                let response = jQuery.parseJSON(data);
                                if (response["success"]) {
                                    response["stmt"].forEach(checkInput);

                                    function checkInput(item, index, arr) {
                                        document.getElementById(item[0]).checked = true;
                                    }
                                    

                                }else{
                                    alert("erreur");
                                }
                            });

                            document.getElementById("typeForm").value = id;
                            
                        }else{
                            alert("erreur");
                        }
                    });

                }

                function deleteSelf(id) {
                    $.post("./Include/programManager.php", {action: "delete", idProg: id}, function (data, status) {
                        let result = jQuery.parseJSON(data);
                        if (result["success"]) {
                            document.getElementById("randonneeCardBase"+id).remove();
                        }else{
                            alert("erreur");
                        }
                    });

                }

            </script>';
    }

    echo '</div>
        </div>
    </div>';
}
?>