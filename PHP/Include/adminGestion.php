<?php

    echo '<div class="d-flex p-2 border rounded m-2 border-light" style="background-color: rgba(0, 125, 255, 0.25)">
    <button class="btn btn-outline-warning mt-2 m-1" id="edt' . $id . '" onclick="editSelf(' . $id . ')" data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: 10em;">
        <i class="bi bi-pencil-square fs-3 fw-bold" aria-hidden="true"></i>
    </button>
    <button class="btn btn-outline-danger mt-2 m-1" id="del' . $id . '" onclick="deleteSelf(' . $id . ')" style="width: 10em;">
        <i class="bi bi-trash-fill fs-3 fw-bold" aria-hidden="true"></i>
    </button>
    </div>

    <script>
    function editSelf(id) {
        $.post("./Include/gestionFormBDD.php", {action: "edit", idProg: id}, function (data, status) {
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

                $.post("./Include/gestionFormBDD.php", {action: "Exc", idProg: id}, function (data, status) {
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

                $.post("./Include/gestionFormBDD.php", {action: "Mat", idProg: id}, function(data, status) {
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
        $.post("./Include/gestionFormBDD.php", {action: "delete", idProg: id}, function (data, status) {
            let result = jQuery.parseJSON(data);
            if (result["success"]) {
                document.getElementById("randonneeCardBase"+id).remove();
            }else{
                alert("erreur");
            }
        });

    }

    </script>';
?>