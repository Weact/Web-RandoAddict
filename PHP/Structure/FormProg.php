<div class="modal fade" id="editProgModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input id="typeForm" name="editForm" type="hidden" value="" />

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
