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

require_once(__DIR__ . "/../DBOperation/PDO_Connect.php");
require_once(__DIR__ . "/../DBOperation/Managers/ManagerProgramme.php");
require_once(__DIR__ . "/../DBOperation/Managers/ManagerExcursion.php");
require_once(__DIR__ . "/../DBOperation/Managers/ManagerTerrain.php");
require_once(__DIR__ . "/../DBOperation/Managers/ManagerPhoto.php");
require_once(__DIR__ . "/../DBOperation/Managers/ManagerParticipation.php");
require_once(__DIR__ . "/../DBOperation/Managers/ManagerMateriel.php");

$conn = connect_bd();

if (isset($_POST['action'])) {
  switch ($_POST['action']) {
    case "edit":
      $mng_Prog = new ManagerProgramme($conn);
      echo json_encode($mng_Prog->selectProgrammeById($_POST["idProg"]));
      break;
    case "edit2":
      $mng_Exc = new ManagerExcursion($conn);
      echo json_encode($mng_Exc->selectExcursionsByProgrammeId($_POST["idProg"]));
      break;
    case "edit3":
      $mng_Mat = new ManagerMateriel($conn);
      echo json_encode($mng_Mat->selectMaterielByProgrammeId($_POST["idProg"]));
      break;
  }
}

function makeNewProgram($donnees)
{
  $conn = connect_bd();
  $mng = new ManagerMarcheur($conn);

  $new_marcheur = new Marcheur();
  $new_marcheur->hydrate($donnees);
  $result = $mng->insertMarcheur($new_marcheur);
  $_POST["sMail_Marcheur_Connexion"] = $_POST['sMail_Marcheur_Inscription'];
}

function makeNewTer($donnees)
{
  $conn = connect_bd();
  $mng = new ManagerTerrain($conn);

  $new_item = new Terrain();
  $new_item->hydrate($donnees);
  $result = $mng->insertTerrain($new_item);
}

function makeNewMat($donnees)
{
  $conn = connect_bd();
  $mng = new ManagerMateriel($conn);

  $new_item = new Materiel();
  $new_item->hydrate($donnees);
  $result = $mng->insertMateriel($new_item);
}

function getMatsOfProg($idProg)
{
  $conn = connect_bd();
  $mng = new ManagerNecessaire($conn);

  $users = $mng->selectNecessaireById($idProg)['stmt'];

  return $users;
}

function getProgOfUser($userId)
{
  $conn = connect_bd();
  $mng = new ManagerParticipation($conn);

  $parts = $mng->selectPartcipationByUserId($userId)['stmt'];
  $progs = [];

  foreach ($parts as $part) {
    array_push($progs, getProgramById($part['idProgramme']));
  }

  return $progs;
}

function getAllExc()
{
  $conn = connect_bd();
  $mng = new ManagerExcursion($conn);

  $users = $mng->selectExcursions()['stmt'];

  return $users;
}

function getFirstPhotoByProgrammeId($id)
{
  $conn = connect_bd();
  $mng_Exc = new ManagerExcursion($conn);
  $mng_Photo = new ManagerPhoto($conn);

  $excursions = $mng_Exc->selectExcursionsByProgrammeId($id)['stmt'];

  return $mng_Photo->selectPhotosByExcursionId($excursions[0]['idExcursion'])['stmt'][0];
}

function getAllMat()
{
  $conn = connect_bd();
  $mng = new ManagerMateriel($conn);

  $users = $mng->selectMateriels()['stmt'];

  return $users;
}

function getAllTer()
{
  $conn = connect_bd();
  $mng = new ManagerTerrain($conn);

  $users = $mng->selectTerrains()['stmt'];

  return $users;
}

function makeNewPhoto($donnees)
{
  $conn = connect_bd();

  $mng_photo = new ManagerPhoto($conn);
  $new_photo = new Photo();
  $new_photo->hydrate($donnees);
  $result = $mng_photo->insertPhoto($new_photo);
}

function makeNewExcursion($donnees, $terrains)
{
  $conn = connect_bd();

  $mng = new ManagerExcursion($conn);
  $new_item = new Excursion();
  $new_item->hydrate($donnees);
  $result = $mng->insertExcursion($new_item, $terrains);

  $new_item = $result['newExcursionId'];

  $photo_lien = $donnees['sNom_Image'];
  $donnees_photo = array(
    'sLien_Photo' => $photo_lien,
    'sLabel_Photo' => "LabelPhoto",
    'nId_Excursion' => $new_item
  );

  makeNewPhoto($donnees_photo);
}

function getAllPrograms()
{
  $conn = connect_bd();
  $mng = new ManagerProgramme($conn);

  $users = $mng->selectProgrammes()['stmt'];

  return $users;
}
function getProgramById($id)
{
  $conn = connect_bd();
  $mng = new ManagerProgramme($conn);

  $users = $mng->selectProgrammeById($id)['stmt'];

  return $users;
}

function getAllPhotos()
{
  $conn = connect_bd();
  $mng = new ManagerPhoto($conn);

  $users = $mng->selectPhotos();

  return $users;
}

function getPhotoOfExcursion($excursionId)
{
  $photos = getAllPhotos()['stmt'];
  foreach ($photos as $photo) {
    if ($photo['idExcursion'] == $excursionId) {
      return $photo;
    }
  }
  return $photos[0];
}

function getAllExcursionsFromProgram($pgrm)
{
  $conn = connect_bd();

  $mng_excur = new ManagerExcursion($conn);
  $excurs = $mng_excur->selectExcursionsByProgrammeId($pgrm['idProgramme'])['stmt'];

  return $excurs;
}

function getProgramsByName($prog_name)
{
  $conn = connect_bd();
  $mng = new ManagerProgramme($conn);

  $progs = $mng->selectProgrammesByLabel(strtolower($prog_name))['stmt'];

  return $progs;
}

function getExcsOfProg($prog)
{
  $conn = connect_bd();
  $mng2 = new ManagerExcursion($conn);
  $mng3 = new ManagerEscale($conn);

  $escales = $mng3->selectEscalesByIdProg($prog['idProgramme'])['stmt'];
  $excursions = [];
  foreach ($escales as $escale) {
    array_push($excursions, $mng2->selectExcursionById($escale['idExcursion'])['stmt']);
  }
  return $excursions;
}

function getPriceOfProg($prog)
{
  $conn = connect_bd();
  $excs = getExcsOfProg($prog);

  $price = (float)0.0;
  foreach ($excs as $exc) {
    $price += (float)$exc['prixExcursion'];
  }

  return $price;
}

function participateProg($idUser, $roleUser, $idProg)
{
  $conn = connect_bd();

  $mng = new ManagerParticipation($conn);
  $new_item = new Participation();
  $new_item->setnId_Prog($idProg);
  $new_item->setsMail_Marcheur($idUser);
  $new_item->setsRole_Marcheur($roleUser);

  $result = $mng->insertParticipation($new_item);
}

function getParticipantsProg($idProg)
{
  $conn = connect_bd();
  $mng = new ManagerParticipation($conn);

  $users = $mng->selectPartcipationById($idProg)['stmt'];

  return $users;
}

function deleteProgId($idProg)
{
  $conn = connect_bd();
  $mng = new ManagerProgramme($conn);

  $msg = $mng->deleteProgrammeById($idProg)['message'];

  return $msg;
}

function leaveProg($mailUtilisateur, $idProg)
{
  $conn = connect_bd();

  $mng_parti = new ManagerParticipation($conn);

  $result = $mng_parti->deleteParticipationByIdFromParticipant($idProg, $mailUtilisateur);

  return $result;
}
