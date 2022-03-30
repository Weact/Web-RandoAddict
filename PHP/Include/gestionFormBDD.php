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

    require_once(__DIR__."/../DBOperation/PDO_Connect.php");
    $conn = connect_bd();
    require_once("userManager.php");


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

          if($donnees['sPseudo_Marcheur'] == "admin"){
            $donnees['sRole_Marcheur'] = "Admin";
          }

          if(isset($_POST['sRole_Marcheur'])) {
            $donnees['sRole_Marcheur'] = $_POST('sRole_Marcheur');
          }

          makeNewUser($donnees);
          connectUser($_POST['sMail_Marcheur_Inscription']);
         exit();


      }
      if(isset($_POST["update_role_marcheur"]))
      {
        $donnees = array(
          'sMail_Marcheur' => $_POST['update_mail_marcheur'],
          'sPseudo_Marcheur' => $_POST['sPseudo_Marcheur'],
          'sTel_Marcheur' => $_POST['sTel_Marcheur'],
          'sMdp_Marcheur' => $_POST['sMdp_Marcheur'],
          'sRole_Marcheur' => $_POST['update_role_marcheur']
          );

          if($donnees['sPseudo_Marcheur'] == "admin"){
            $donnees['sRole_Marcheur'] = "Admin";
          }

          if(isset($_POST['sRole_Marcheur'])) {
            $donnees['sRole_Marcheur'] = $_POST('sRole_Marcheur');
          }

          makeNewUser($donnees);
          connectUser($_POST['sMail_Marcheur_Inscription']);
         exit();


      }
      if(isset($_POST["sMail_Marcheur_Connexion"])) {
          //CONNEXION AUTOMATIQUE
          $isValidMarcheur = checkUserPw($_POST["sMail_Marcheur_Connexion"], $_POST["sMdp_Marcheur"]);
          if ($isValidMarcheur){
            connectUser($_POST["sMail_Marcheur_Connexion"]);
          }
      }
      elseif(isset($_POST["labelExcursion"]))
        {
          $mng = new ManagerExcursion($conn);

          $donnees = array(
            'sDesc_Excursion' => $_POST['descExcursion'],
            'sLabel_Excursion' => $_POST['labelExcursion'],
            'sDepart_Excursion' => $_POST['departExcursion'],
            'sArrivee_Excursion' => $_POST['arriveeExcursion'],
            'fPrix_Excursion' => $_POST['prixExcursion']
            );

          $new_item = new Excursion();
          $new_item->hydrate($donnees);
          $result = $mng->insertExcursion($new_item);

        }
      if(isset($_POST["sLabel_Prog"]))
        {
          $mng = new ManagerProgramme($conn);

          //TO DO : ADD sExcur_Prog
          $donnees = array(
            'sLabel_Prog' => $_POST['sLabel_Prog'],
            'sDesc_Prog' => $_POST['sDesc_Prog'],
            'sDepart_Prog' => $_POST['sDepart_Prog'] . " " . $_POST['sDepartHeure_Prog'].":00",
            'sArrivee_Prog' => $_POST['sArrivee_Prog'] . " " . $_POST['sArriveHeure_Prog'].":00",
            'nCapacite_Prog' => $_POST['nCapacite_Prog'],
            'nDifficulte_Prog' => $_POST['nDifficulte_Prog'],
            'sValide_Prog' => "En attente"
            );

            var_dump($donnees);
          $new_item = new Programme();
          $new_item->hydrate($donnees);
          $mng->insertProgramme($new_item, $_POST['sExcur_Prog'], []);

        }


        if(isset($_POST["disconnect"])){
        connectUser("");

        }

?>
