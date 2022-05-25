<?php
/*******************************************************************************\
* Fichier       : /PHP/Include/gestionFormBDD.php
*
* Description   : Fichier répertoriant les réceptions de formulaires et leur gestion.
*
* Créateur      : Romain Schlotter
\*******************************************************************************/
/*******************************************************************************\
* 29-03-2022   : Création du fichier
\*******************************************************************************/

    require_once(__DIR__."/../DBOperation/PDO_Connect.php");
    require_once(__DIR__."/../DBOperation/Managers/ManagerProgramme.php");
    require_once(__DIR__."/../DBOperation/Managers/ManagerExcursion.php");
    require_once(__DIR__."/../DBOperation/Managers/ManagerPhoto.php");
    require_once(__DIR__."/../DBOperation/Managers/ManagerEscale.php");

    if (isset($_POST['action'])) {
      switch ($_POST['action']) {
        case 'edit':
          $conn = connect_bd();
          $mng_Prog = new ManagerProgramme($conn);

          echo json_encode($mng_Prog->selectProgrammeById($_POST["idProg"]));
          break;

        case 'delete':
          // echo '<script> alert("'.$_POST["idProg"].'"); </script>';
          deleteProgramme($_POST["idProg"]);
          break;

        case 'edit2':
          $conn = connect_bd();
          $mng_Exc = new ManagerExcursion($conn);

          echo json_encode($mng_Exc->selectExcursionsByProgrammeId($_POST["idProg"]));
          break;

      }
    }

    function makeNewProgram($donnees) {
      $conn = connect_bd();
      $mng = new ManagerMarcheur($conn);

      $new_marcheur = new Marcheur();
      $new_marcheur->hydrate($donnees);
      $result = $mng->insertMarcheur($new_marcheur);
      $_POST["sMail_Marcheur_Connexion"] = $_POST['sMail_Marcheur_Inscription'];

    }

    function makeNewMat($donnees) {
      $conn = connect_bd();
      $mng = new ManagerMateriel($conn);

      $new_item = new Materiel();
      $new_item->hydrate($donnees);
      $result = $mng->insertMateriel($new_item);

    }

    function getAllExc() {
      $conn = connect_bd();
      $mng = new ManagerExcursion($conn);

      $users = $mng->selectExcursions()['stmt'];

      return $users;

    }

    function getAllMat() {
      $conn = connect_bd();
      $mng = new ManagerMateriel($conn);

      $users = $mng->selectMateriels()['stmt'];

      return $users;

    }

    function makeNewExcursion($donnees) {
      $conn = connect_bd();

      $mng = new ManagerExcursion($conn);
      $new_item = new Excursion();
      $new_item->hydrate($donnees);
      $result = $mng->insertExcursion($new_item);

      $new_item = $result['newExcursionId'];

      $CONNARDDEROMAIN = $donnees['sNom_Image']; // C'est Valentin qui a donné ce nom là à la variable, et je n'ai pas le droit de le changer.
      // Validé par Luc CORNU, je n'ai pas le droit de le changer
      $donnees_photo = array(
        'sLien_Photo' => $CONNARDDEROMAIN,
        'sLabel_Photo' => "LabelPhoto",
        'nId_Excursion' => $new_item
        );

      //var_dump($donnees_photo);
      $mng_photo = new ManagerPhoto($conn);
      $new_photo = new Photo();
      $new_photo->hydrate($donnees_photo);
      $result = $mng_photo->insertPhoto($new_photo);

    }

    function getAllPrograms() {
      $conn = connect_bd();
      $mng = new ManagerProgramme($conn);

      $users = $mng->selectProgrammes()['stmt'];

      return $users;

    }

    function getFirstPhotoByProgrammeId($id) {
      $conn = connect_bd();
      $mng_Exc = new ManagerExcursion($conn);
      $mng_Photo = new ManagerPhoto($conn);

      $excursions = $mng_Exc->selectExcursionsByProgrammeId($id)['stmt'];
      if (count($excursions) > 0) {
        $excursions = $excursions[0];

      } else {
        $excursions = $mng_Exc->selectExcursions()['stmt'][0];

      }
      
      return $mng_Photo->selectPhotosByExcursionId($excursions['idExcursion'])['stmt'];

    }

    function deleteProgramme($id) {
      $conn = connect_bd();
      $mng_Prog = new ManagerProgramme($conn);

      echo json_encode($mng_Prog->deleteProgrammeById($id));

    }

?>
