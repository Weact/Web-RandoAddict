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

    case 'Exc':
      $conn = connect_bd();
      $mng_Exc = new ManagerExcursion($conn);

      echo json_encode($mng_Exc->selectExcursionsByProgrammeId($_POST["idProg"]));
      break;

    case 'Mat':
      $conn = connect_bd();
      $mng_Mat = new ManagerMateriel($conn);

      echo json_encode($mng_Mat->selectMaterielByProgrammeId($_POST["idProg"]));
      break;
  }
}

if (isset($_POST['idMarcheurJoin']))
{
  $conn = connect_bd();
  $mng_Part = new ManagerParticipation($conn);

  $donnees_Part = array(
    'nId_Prog' => $_POST['idProgJoin'],
    'sMail_Marcheur' =>  $_POST['idMarcheurJoin'],
    'sRole_Marcheur' => "Marcheur"
  );
  $new_Part = new Participation();
  $new_Part->hydrate($donnees_Part);

  $mng_Part->insertParticipation($new_Part);
}


// Vérification et initialisation des variables de session le cas échéant.
if (!isset($_SESSION['typeUtilisateur'])) {
  $_SESSION['typeUtilisateur'] = "anon";
}
if (!isset($_SESSION['nomUtilisateur'])) {
  $_SESSION['nomUtilisateur'] = "anon";
}

// Gestion de toutes les réceptions de tous les formulaires.
if (isset($_POST["sMail_Marcheur_Inscription"])) {
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
  exit();
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
  // CONNEXION AUTOMATIQUE
  $isValidMarcheur = checkUserPw($_POST["sMail_Marcheur_Connexion"], $_POST["sMdp_Marcheur"]);
  if ($isValidMarcheur) {
    connectUser($_POST["sMail_Marcheur_Connexion"]);
  }
}

if (isset($_POST["Nom_terrain_autre"])) {
  $donnees = array (
    'sLabel_Terrain' => $_POST['Nom_terrain_autre'],
    'sDesc_Terrain' => 'desc'
  );
  makeNewTerrain($donnees);
}

if (isset($_POST["labelExcursion"])) {
  $nomImage = "";
  $uploaddir = '.././ASSETS/';
  $uploadfile = $uploaddir . basename($_FILES["image"]["name"]);
  $imageFileType = strtolower(pathinfo($uploadfile, PATHINFO_EXTENSION));

  if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
    $nomImage = time() . uniqid(rand()) . "." . $imageFileType;
    $uploadfile = $uploaddir . basename($nomImage);
    move_uploaded_file($_FILES["image"]["tmp_name"], $uploadfile);

    // var_dump($_FILES["image"]["tmp_name"]);
    // var_dump($uploadfile);
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

// Création de programme
if (isset($_POST["Nom_materiel_autre"])) {
  $donnees = array(
    'sLabel_Materiel' => $_POST['Nom_materiel_autre'],
    'sDesc_Materiel' => 'desc'
  );
  makeNewMat($donnees);
}

if (isset($_POST["sLabel_Prog"])) {
  $mng = new ManagerProgramme($conn);

  // $materiels = $_POST['materiel'];
  // var_dump($materiels);
  // TO DO : ADD sExcur_Prog
  $donnees = array(
    'sLabel_Prog' => $_POST['sLabel_Prog'],
    'sDesc_Prog' => $_POST['sDesc_Prog'],
    'sDepart_Prog' => $_POST['sDepart_Prog'] . " " . $_POST['sDepartHeure_Prog'] . ":00",
    'sArrivee_Prog' => $_POST['sArrivee_Prog'] . " " . $_POST['sArriveHeure_Prog'] . ":00",
    'nCapacite_Prog' => $_POST['nCapacite_Prog'],
    'nDifficulte_Prog' => $_POST['nDifficulte_Prog'],
    'sValide_Prog' => "En attente"
  );

  // var_dump($donnees);
  $new_item = new Programme();
  $new_item->hydrate($donnees);

  if (isset($_POST["editForm"])) {
    // echo $_POST["editForm"];
    $mng->updateProgrammeById($new_item, $_POST["editForm"]);
  } else {
    $mng->insertProgramme($new_item, $_POST['sExcur_Prog'], $_POST['materiel'], $_POST['type']);
  }
}


if (isset($_POST["disconnect"])) {
  connectUser("");
}
