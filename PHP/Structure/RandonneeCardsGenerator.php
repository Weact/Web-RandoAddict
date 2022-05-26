<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Modifier le programme de la randonnée</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">
                <form id='creation_programme' name='creation_programme' class="form" method="POST" action="#">
                    <legend for="selection_rando">Nom du programme</legend>
                    <input type="text" name="sLabel_Prog" class="form-control" id="selectionNom" aria-label="NomExcursion" required>

                    <legend for="selection_rando">Sélection de randonnée</legend>
                    <select multiple name="sExcur_Prog[]" id="selectionRando00" class="form-control" required>
                        <optgroup>
                            <?php
                            require_once(__DIR__ . '/../Include/programManager.php');
                            $excursions = getAllExc();
                            foreach ($excursions as $excursion) {
                                echo "<option value='" . $excursion[0] . "'>" . $excursion[1] . "</option>";
                            }

                            ?>
                        </optgroup>
                    </select>

                    <legend for="selectionTerrain">Difficulté de la randonnée</legend>
                    <select name="nDifficulte_Prog" id="selectionTerrain" class="form-control" required>
                        <option value="">Choisissez la difficultée du terrain</option>
                        <optgroup>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                        </optgroup>
                    </select>

                    <legend for="nb_rando">Nombre de randonneurs</legend>
                    <div class="def-number-input number-input safari_only">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus text-light bg-danger border rounded-pill fs-5 p-2">-</button>
                        <input name="nCapacite_Prog" class="quantity fs-4 text-center border-0 g-0 fw-bold border-bottom border-bottom-5 border-secondary" id="selectionQuantite" min="1" name="quantity" value="1" type="number">
                        <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus text-light bg-success border rounded-pill fs-5 p-2">+</button>
                    </div>

                    <legend for="selection_rando">Type de programme</legend><br>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c1" id="ck1">
                        <label class="form-check-label h6" for="ck1">Senior</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c2" id="ck2">
                        <label class="form-check-label h6" for="ck2">Junior</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c3" id="ck3">
                        <label class="form-check-label h6" for="ck3">Majeur</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c4" id="ck4">
                        <label class="form-check-label h6" for="ck4">Nature</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="c5" id="ck5">
                        <label class="form-check-label h6" for="ck5">Histoire</label>
                    </div>

                    <legend for="startDate">Date de départ</legend>
                    <input name="sDepart_Prog" id="startDate" class="form-control" type="date" required />

                    <legend for="startDate">Heure de départ</legend>
                    <div class="cs-form">
                        <input name="sDepartHeure_Prog" id="startHour" type="time" class="form-control" value="" required />
                    </div>

                    <legend for="arriveDate">Date d'arriver</legend>
                    <input name="sArrivee_Prog" id="arriveDate" class="form-control" type="date" required />

                    <legend for="arriveDate">Heure d'arrivée</legend>
                    <div class="cs-form">
                        <input name="sArriveHeure_Prog" id="arriveHour" type="time" class="form-control" value="" required />
                    </div>
                    <div>
                        <legend for="selection" id="selectionMateriel">Matériel</legend>
                        <?php
                        require_once(__DIR__ . '/../Include/programManager.php');
                        $materiels = getAllMat();
                        foreach ($materiels as $materiel) {
                            echo '<div class="form-check form-check-inline">
                                <input class="form-check-input" name="materiel[]" type="checkbox" id="' . $materiel[0] . '" value="' . $materiel[0] . '">
                                <label class="form-check-label h6" for="' . $materiel[0] . '">' . $materiel[0] . "</label>
                            </div>";
                        }

                        ?>

                        <br>
                    </div>
                    <button type="button" class="btn btn-outline-warning fs-5 fw-bold border-2" data-bs-toggle="modal" data-bs-target="#materielModal">Ajouter un materiel</button>

                    <legend for="selection_rando">Description</legend>
                    <textarea name="sDesc_Prog" class="form-control" id="descProg" aria-label="Background et notes" required></textarea>
                    <br>
                    <button class="btn  btn-outline-success mb-1" type="submit">Valider</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../Include/programManager.php");
$programs = getAllPrograms();

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
                <input type="button" value="Consulter" class="btn btn-success w-100 mt-auto">';

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
