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
    $conn = connect_bd();
    require_once("userManager.php");
    require_once("programManager.php");

    //Vérification et initialisation des variables de session le cas échéant.
    if (!isset($_SESSION['typeUtilisateur']))
    {
        $_SESSION['typeUtilisateur'] = "anon";
    }
    if (!isset($_SESSION['nomUtilisateur']))
    {
        $_SESSION['nomUtilisateur'] = "anon";
    }
    if (!isset($_SESSION['mailUtilisateur']))
    {
        $_SESSION['mailUtilisateur'] = "anon";
    }

    //Gestion de toutes les réceptions de tous les formulaires formulaires.
      if(isset($_POST["idMarcheurJoin"])){
        participateProg($_POST["idMarcheurJoin"], $_POST["roleMarcheurJoin"], $_POST["idProgJoin"]);
      }

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
      if(isset($_POST["Nom_terrain_autre"])) {
          $donnees = array(
            'sLabel_Terrain' => $_POST['Nom_terrain_autre'],
            'sDesc_Terrain' => "desc"
            );
          makeNewTer($donnees);
      }
      elseif(isset($_POST["Nom_materiel_autre"])) {
          $donnees = array(
            'sLabel_Materiel' => $_POST['Nom_materiel_autre'],
            'sDesc_Materiel' => "desc"
            );
          makeNewMat($donnees);
      }

      elseif(isset($_POST["labelExcursion"]))
      {
        $nomImage = "";
        $uploaddir = '.././ASSETS/';
        $uploadfile = $uploaddir.basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($uploadfile,PATHINFO_EXTENSION));

        if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" )
        {
          $nomImage = time().uniqid(rand()).".".$imageFileType;
          $uploadfile = $uploaddir.basename($nomImage);
          move_uploaded_file($_FILES["image"]["tmp_name"], $uploadfile);

          //var_dump($_FILES["image"]["tmp_name"]);
          //var_dump($uploadfile);
        }

        $donnees = array(
          'sDesc_Excursion' => $_POST['descExcursion'],
          'sLabel_Excursion' => $_POST['labelExcursion'],
          'sDepart_Excursion' => $_POST['departExcursion'],
          'sArrivee_Excursion' => $_POST['arriveeExcursion'],
          'fPrix_Excursion' => $_POST['prixExcursion'],
          'sNom_Image' => $nomImage
          );

          $ter = "";
          if(isset($_POST['terrain'])){
            $_POST['terrain'];
          }
          makeNewExcursion($donnees, $ter);
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

          $new_item = new Programme();
          $new_item->hydrate($donnees);
          $mat = [];
          if(isset($_POST['materiel'])){
            $mat = $_POST['materiel'];
          }
          $mng->insertProgramme($new_item, $_POST['sExcur_Prog'], $mat);

        }


        if(isset($_POST["disconnect"])){
          connectUser("");

        }
        if(isset($_POST["mailMarcheurCheck"])){
          $_SESSION['checkMailUtilisateur'] = $_POST["mailMarcheurCheck"];
        }

        if(isset($_POST["deleteProgId"])){
          deleteProgId($_POST["deleteProgId"]);

        }
?>
