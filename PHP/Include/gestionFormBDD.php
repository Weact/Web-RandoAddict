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

require_once(__DIR__ . "/../DBOperation/PDO_Connect.php");
$conn = connect_bd();
require_once("userManager.php");
require_once("programManager.php");

//Vérification et initialisation des variables de session le cas échéant.
if (!isset($_SESSION['typeUtilisateur'])) {
  $_SESSION['typeUtilisateur'] = "anon";
}
if (!isset($_SESSION['nomUtilisateur'])) {
  $_SESSION['nomUtilisateur'] = "anon";
}

//Gestion de toutes les réceptions de tous les formulaires formulaires.

// GERE L'INSCRIPTION UTILISATEUR NORMAL ET INSCRIPTION UTILISATEUR PAR ADMIN
if (isset($_POST["sMail_Marcheur_Inscription"])) {

  // GERE L'INSCRIPTION UTILISATEUR PAR ADMIN
  if (isset($_POST['crea_sPseudo_Marcheur'])) {
    $donnees = $arrayName = array(
      'sMail_Marcheur' => $_POST['sMail_Marcheur_Inscription'],
      'sPseudo_Marcheur' => $_POST['crea_sPseudo_Marcheur'],
      'sTel_Marcheur' => $_POST['crea_sTel_Marcheur'],
      'sMdp_Marcheur' => $_POST['crea_sMdp_Marcheur'],
      'sRole_Marcheur' => 'Marcheur'
    );

    if (isset($_POST['crea_sRole_Marcheur'])) {
      $donnees['sRole_Marcheur'] = $_POST['crea_sRole_Marcheur'];
    }

    if (strtolower($donnees['sPseudo_Marcheur']) == "admin") {
      $donnees['sRole_Marcheur'] = "Admin";
    }
    makeNewUser($donnees);
    redirectUser(); // does the exit();

  } else { // ENTRER DANS CETTE CONDITION ELSE SIGNIFIE QU'UNE INSCRIPTION EST EFFECTUE PAR L'UTILISATEUR
    if (isset($_POST['sPseudo_Marcheur'])) {
      $donnees = array(
        'sMail_Marcheur' => $_POST['sMail_Marcheur_Inscription'],
        'sPseudo_Marcheur' => $_POST['sPseudo_Marcheur'],
        'sTel_Marcheur' => $_POST['sTel_Marcheur'],
        'sMdp_Marcheur' => $_POST['sMdp_Marcheur'],
        'sRole_Marcheur' => 'Marcheur'
      );

      if ($donnees['sPseudo_Marcheur'] == "admin") {
        $donnees['sRole_Marcheur'] = "Admin";
      }

      if (isset($_POST['sRole_Marcheur'])) {
        $donnees['sRole_Marcheur'] = $_POST['sRole_Marcheur'];
      }

      makeNewUser($donnees);
      connectUser($_POST['sMail_Marcheur_Inscription']);
      redirectUser(); // does the exit();
    }
  }
}

if (isset($_POST["deleteProgID"])) {
  $msg = deleteProgId($_POST["deleteProgID"]);
}

if(isset($_POST["leaveProgID"])){
  $result = leaveProg($_SESSION['mailUtilisateur'], $_POST["leaveProgID"] );
}

if (isset($_POST["update_role_marcheur"])) {
  $donnees = array(
    'sMail_Marcheur' => $_POST['update_mail_marcheur'],
    'sPseudo_Marcheur' => $_POST['sPseudo_Marcheur'],
    'sTel_Marcheur' => $_POST['sTel_Marcheur'],
    'sMdp_Marcheur' => $_POST['sMdp_Marcheur'],
    'sRole_Marcheur' => $_POST['update_role_marcheur']
  );

  if ($donnees['sPseudo_Marcheur'] == "admin") {
    $donnees['sRole_Marcheur'] = "Admin";
  }

  if (isset($_POST['sRole_Marcheur'])) {
    $donnees['sRole_Marcheur'] = $_POST('sRole_Marcheur');
  }

  makeNewUser($donnees);
  connectUser($_POST['sMail_Marcheur_Inscription']);
  exit();
}
if (isset($_POST["sMail_Marcheur_Connexion"])) {
  //CONNEXION AUTOMATIQUE
  $isValidMarcheur = checkUserPw($_POST["sMail_Marcheur_Connexion"], $_POST["sMdp_Marcheur"]);
  if ($isValidMarcheur) {
    connectUser($_POST["sMail_Marcheur_Connexion"]);
  }
}

if (isset($_POST["Nom_terrain_autre"])) {
  $donnees = array(
    'sLabel_Terrain' => $_POST['Nom_terrain_autre'],
    'sDesc_Terrain' => "desc"
  );
  makeNewTer($donnees);
} elseif (isset($_POST["Nom_materiel_autre"])) {
  $donnees = array(
    'sLabel_Materiel' => $_POST['Nom_materiel_autre'],
    'sDesc_Materiel' => "desc"
  );
  makeNewMat($donnees);
} elseif (isset($_POST["labelExcursion"])) {
  $nomImage = "";
  $uploaddir = '.././ASSETS/';
  $uploadfile = $uploaddir . basename($_FILES["image"]["name"]);
  $imageFileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));

  if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
    $nomImage = time() . uniqid(rand()) . "." . $imageFileType;
    $uploadfile = $uploaddir . basename($nomImage);
    move_uploaded_file($_FILES["image"]["tmp_name"], $uploadfile);
  }

  $donnees = array(
    'sDesc_Excursion' => $_POST['descExcursion'],
    'sLabel_Excursion' => $_POST['labelExcursion'],
    'sDepart_Excursion' => $_POST['departExcursion'],
    'sArrivee_Excursion' => $_POST['arriveeExcursion'],
    'fPrix_Excursion' => $_POST['prixExcursion'],
    'sNom_Image' => $nomImage
  );

  makeNewExcursion($donnees, $_POST['terrain']);
}
if (isset($_POST["sLabel_Prog"])) {
  $mng = new ManagerProgramme($conn);

  //TO DO : ADD sExcur_Prog
  $donnees = array(
    'sLabel_Prog' => $_POST['sLabel_Prog'],
    'sDesc_Prog' => $_POST['sDesc_Prog'],
    'sDepart_Prog' => $_POST['sDepart_Prog'] . " " . $_POST['sDepartHeure_Prog'] . ":00",
    'sArrivee_Prog' => $_POST['sArrivee_Prog'] . " " . $_POST['sArriveHeure_Prog'] . ":00",
    'nCapacite_Prog' => $_POST['nCapacite_Prog'],
    'nDifficulte_Prog' => $_POST['nDifficulte_Prog'],
    'sValide_Prog' => "En attente"
  );

  $new_item = new Programme();
  $new_item->hydrate($donnees);

  if( isset( $_POST["editForm"] ) ){
    $mng->updateProgrammeById($new_item, $_POST['editForm']);
  }else{
    // It's inserting a new programme into the database.
    $mng->insertProgramme($new_item, $_POST['sExcur_Prog'], $_POST['materiel']);
  }

}


if (isset($_POST["idMarcheurJoin"])) {
  participateProg($_POST["idMarcheurJoin"], $_POST["roleMarcheurJoin"], $_POST["idProgJoin"]);
}

if (isset($_POST["disconnect"])) {
  connectUser("");
}
