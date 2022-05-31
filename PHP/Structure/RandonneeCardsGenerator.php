<?php
require_once(__DIR__ . '/../Include/programManager.php');

$programs;
if (isset($_POST['rechercheRandonnee'])) {
    $programs = getProgramsByName(strtolower($_POST['rechercheRandonnee']));
} else {
    $programs = getAllPrograms();
}

foreach ($programs as $program) {
?>
    <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 mb-1" id="randonneeCardBase">
        <div class="card text-dark fw-bold">
            <img src=<?php
            $photo = getPhotoOfExcursion(getExcsOfProg($program)[0]['idExcursion']);

            $photolink = '/../../ASSETS/' . $photo['lienPhoto'];
            echo $photolink;?> alt="randonne image top" class="card-img-top">
            <div class="card-img-overlay d-flex flex-column align-items-center">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title display-3" id="randonneeTitre" name="randonneeTitre">
                          <?php echo $program["labelProgramme"]?></h3>
                    </div>
                    <div class="col d-flex justify-content-center align-items-center">
                        <span class="badge bg-primary fs-3 p-2"><?php echo $program["difficulteProgramme"]?></span>
                    </div>
                </div>
                <div class="container-fluid d-flex justify-content-center align-items-center p-2 mb-2 border rounded border-primary" id="randonneeDescription" name="randonneeDescription" style="background-color: rgba(200,200,200,0.5); height:100%!important;">
                    <p class="card-text"><?php echo substr($program["descProgramme"], 0, 250); ?></p>
                </div>

                <input type="button" value="Consulter" onclick="goToPost('Structure/PageRandonee.php','idProg', <?php echo $program['idProgramme'];?>)" class="btn btn-success w-100 mt-auto">

                </div>
                </div>
                </div>
<?php
}
?>
<script>
    function editSelf(id) {
        $.post("./Include/programManager.php", {
            action: "edit",
            idProg: id
        }, function(data, status) {
            let result = jQuery.parseJSON(data);
            console.log(result);
            if (result["success"]) {
                $programme = result["stmt"];
                document.getElementById("selectionNom").value = $programme["labelProgramme"];
                document.getElementById("descProg").value = $programme["descProgramme"];
                document.getElementById("selectionTerrain").value = $programme["diffProgramme"];
                document.getElementById("selectionQuantite").value = $programme["capaciteProgramme"];
                let depart = $programme["dateDepartProgramme"].split(" ");
                document.getElementById("startDate").value = depart[0];
                document.getElementById("startHour").value = depart[1];
                let arrivee = $programme["dateArriveeProgramme"].split(" ");
                document.getElementById("arriveDate").value = arrivee[0];
                document.getElementById("arriveHour").value = arrivee[1];
                $.post("./Include/programManager.php", {
                    action: "edit2",
                    idProg: id
                }, function(data, status) {
                    let response = jQuery.parseJSON(data);
                    if (response["success"]) {
                        let values = [];
                        response["stmt"].forEach(returnValue);

                        function returnValue(item, index, arr) {
                            values.push(item[0]);
                        }
                        let element = document.getElementById("selectionRando00");
                        for (let i = 0; i < element.options.length; i++) {
                            element.options[i].selected = values.includes(element.options[i].value);
                        }
                    } else {
                        alert("erreur");
                    }
                });
                $.post("./Include/programManager.php", {
                    action: "edit3",
                    idProg: id
                }, function(data, status) {
                    let response = jQuery.parseJSON(data);
                    if (response["success"]) {
                        response["stmt"].forEach(checkInput);

                        function checkInput(item, index, arr) {
                            document.getElementById(item[0]).checked = true;
                        }

                    } else {
                        alert("erreur");
                    }
                });
                document.getElementById("typeForm").value = id;

            } else {
                alert("erreur");
            }
        });
    }
</script> 
