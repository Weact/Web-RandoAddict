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
    session_start();

    //Vérification et initialisation des variables de session le cas échéant.
    if (!isset($_SESSION['typeUtilisateur']))
    {
        $_SESSION['typeUtilisateur'] = "anon";
    }
    if (!isset($_SESSION['nomUtilisateur']))
    {
        $_SESSION['nomUtilisateur'] = "anon";
    }

    //Gestion de toutes les réceptions de tous les formulaires formulaires.
      if(isset($_POST["sMail_Marcheur_Inscription"]))
      {
        $donnees = array(
          'sMail_Marcheur' => $_POST['sMail_Marcheur_Inscription'],
          'sPseudo_Marcheur' => $_POST['sPseudo_Marcheur'],
          'sTel_Marcheur' => $_POST['sTel_Marcheur'],
          'sMdp_Marcheur' => $_POST['sMdp_Marcheur'],
          'sRole_Marcheur' => 'Marcheur'
          );

          makeNewUser($donnees);
          connectUser($_POST['sMail_Marcheur_Inscription']);
         exit();


      }
      elseif(isset($_POST["sMail_Marcheur_Connexion"])) {
          //CONNEXION AUTOMATIQUE
          connectUser($_POST["sMail_Marcheur_Connexion"]);

      }
      elseif(isset($_POST["departExcursion"]))
        {
        require_once("Structure/HeaderAdmin.php");
          require_once("DBOperation/Managers/ManagerExcursion.php");
          require_once("DBOperation/PDO_Connect.php");
          $conn = connect_bd();
          $mng = new ManagerExcursion($conn);

          $donnees = array(
            'sDesc_Excursion' => $_POST['descExcursion'],
            'sLabel_Excursion' => "TITRE",
            'sDepart_Excursion' => $_POST['departExcursion'],
            'sArrivee_Excursion' => $_POST['arriveeExcursion'],
            'fPrix_Excursion' => $_POST['prixExcursion']
            );

          $new_item = new Excursion();
          $new_item->hydrate($donnees);
          $result = $mng->insertExcursion($new_item);

        }
      elseif(isset($_POST["sLabel_Prog"]))
        {
        require_once("Structure/HeaderAdmin.php");
          require_once("DBOperation/Managers/ManagerProgramme.php");
          require_once("DBOperation/PDO_Connect.php");
          $conn = connect_bd();
          $mng = new ManagerProgramme($conn);

          //TO DO : ADD sExcur_Prog
          $donnees = array(
            'sLabel_Prog' => $_POST['sLabel_Prog'],
            'sDesc_Prog' => $_POST['sDesc_Prog'],
            'sDepart_Prog' => $_POST['sDepart_Prog'] . " " . $_POST['sDepartHeure_Prog'].":00",
            'sArrivee_Prog' => $_POST['sArrivee_Prog'] . " " . $_POST['sArriveHeure_Prog'].":00",
            'nCapacite_Prog' => 5,
            'nDifficulte_Prog' => 2,
            'sValide_Prog' => "En attente"
            );

          $new_item = new Programme();
          $new_item->hydrate($donnees);
          $mng->insertProgramme($new_item);

        }

        if(isset($_POST["disconnect"])){
        connectUser("");

        }

      function makeNewUser($donnees) {
          require_once("DBOperation/Managers/ManagerMarcheur.php");
          require_once("DBOperation/PDO_Connect.php");
          $conn = connect_bd();
          $mng = new ManagerMarcheur($conn);

          $new_marcheur = new Marcheur();
          $new_marcheur->hydrate($donnees);
          $result = $mng->insertMarcheur($new_marcheur);
          $_POST["sMail_Marcheur_Connexion"] = $_POST['sMail_Marcheur_Inscription'];

      }

    function connectUser($mail){
        require_once("DBOperation/Managers/ManagerMarcheur.php");
        require_once("DBOperation/PDO_Connect.php");
        $conn = connect_bd();

        $mng = new ManagerMarcheur($conn);
        $current_marcheur = $mng->selectMarcheurByMail($mail)['marcheur'];

        $_SESSION['nomUtilisateur'] = $current_marcheur->getsPseudo_Marcheur();
        $_SESSION['typeUtilisateur'] = $current_marcheur->getsRole_Marcheur();

         header("HTTP/1.1 303 See Other");
         header("Location: ./Accueil.php");
         exit();
    }
?>
