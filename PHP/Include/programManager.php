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
    $conn = connect_bd();

      function makeNewProgram($donnees) {
      $conn = connect_bd();
          $mng = new ManagerMarcheur($conn);

          $new_marcheur = new Marcheur();
          $new_marcheur->hydrate($donnees);
          $result = $mng->insertMarcheur($new_marcheur);
          $_POST["sMail_Marcheur_Connexion"] = $_POST['sMail_Marcheur_Inscription'];

      }

    function getAllExc() {
          $conn = connect_bd();
          $mng = new ManagerExcursion($conn);

          $users = $mng->selectExcursions()['stmt'];

          return $users;
    }

    function getAllPrograms() {
          $conn = connect_bd();
          $mng = new ManagerProgramme($conn);

          $users = $mng->selectProgrammes()['stmt'];

          return $users;
    }

?>
