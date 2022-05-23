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
    $conn = connect_bd();

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

        $CONNARDDEROMAIN = $donnees['sNom_Image']; //C'est Valentin qui a donné ce nom là à la variable, et je n'ai pas le droit de le changer.
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

    function getProgramById($num) {
      $conn = connect_bd();
      $mng = new ManagerProgramme($conn);

      var_dump($mng->selectProgrammeById($num)['programme']);

    }

?>
