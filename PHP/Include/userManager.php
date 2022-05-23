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
require_once(__DIR__ . "/../DBOperation/Managers/ManagerMarcheur.php");
require_once(__DIR__ . "/../DBOperation/Managers/ManagerProgramme.php");
require_once(__DIR__ . "/../DBOperation/Managers/ManagerExcursion.php");
$conn = connect_bd();

function makeNewUser($donnees)
{
  $conn = connect_bd();

  $mng = new ManagerMarcheur($conn);

  $new_marcheur = new Marcheur();
  $new_marcheur->hydrate($donnees);
  $result = $mng->insertMarcheur($new_marcheur);
  $_POST["sMail_Marcheur_Connexion"] = $_POST['sMail_Marcheur_Inscription'];
}

if (isset($_GET['mail_user'])) {
  updateUserRole($_GET['mail_user'], $_GET['role_user']);
}

function updateUserRole($mail, $role)
{
  $conn = connect_bd();
  $mng = new ManagerMarcheur($conn);
  $new_marcheur = $mng->selectMarcheurByMail($mail)['marcheur'];
  $new_marcheur->setsRole_Marcheur($role);
  $result = $mng->updateMarcheurByMail($new_marcheur, $mail);

  //echo json_encode($result);
}

function redirectUser()
{
  header("HTTP/1.1 303 See Other");
  header("Location: ./Accueil.php");
  exit();
}

// MUST USE REDIRECTUSER() AFTER CALLING THIS METHOD
function connectUser($mail)
{
  $conn = connect_bd();
  $mng = new ManagerMarcheur($conn);
  $current_marcheur = $mng->selectMarcheurByMail($mail)['marcheur'];

  $_SESSION['nomUtilisateur'] = $current_marcheur->getsPseudo_Marcheur();
  $_SESSION['typeUtilisateur'] = $current_marcheur->getsRole_Marcheur();
}

function checkUserPw($mail, $pw)
{
  $conn = connect_bd();
  $mng = new ManagerMarcheur($conn);
  $current_marcheur = $mng->selectMarcheurByMail($mail)['marcheur'];

  $resulteotjea = $mng->existMarcheurByMail($mail, $pw)['passwordVerify'];
  return $resulteotjea;
}

function getAllUsers()
{
  $conn = connect_bd();
  $mng = new ManagerMarcheur($conn);

  $users = $mng->selectMarcheurs()['stmt'];

  return $users;
}
