<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerParticipation.php
*
* Description   : Le Manager pour la table Participation.
*
* Classe        : ManagerParticipation
* Fonctions     : arrayConstructor($stmt)
*                 insertParticipation(Participation $p)
*                 selectParticipations()
*                 selectPartcipationById($num)
*                 updateParticipationById(Participation $p, $num)
*                 deleteParticipationById($num)
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

require_once(__DIR__."/../Objects/ParticipationObject.php");
require_once("Manager.php");

class ManagerParticipation extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Prog" => $valueStmt["idProg"],
        "sMail_Utilisateur" => $valueStmt["mailUtilisateur"],
        "sRole_Utilisateur" => $valueStmt["roleUtilisateur"]
    }else{
      $tab = array(
        "nId_Prog" => "",
        "sMail_Utilisateur" => "",
        "sRole_Utilisateur" => ""
        );
    }

    return $tab;
  }

  // Database commands
  public function insertParticipation(Participation $p)
  {
    $req = "INSERT INTO PARTICIPATION(idProgramme, mailMarcheur, roleMarcheur) VALUES (:ID, :MAIL, :_ROLE)";

    // Send the request to the Database
    try
    {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":ID", $p->getnId_Prog(), PDO::PARAM_INT);
      $stmt->bindValue(":MAIL", $p->getsMail_Marcheur(), PDO::PARAM_STR);
      $stmt->bindValue(":_ROLE", $p->getsRole_Marcheur(), PDO::PARAM_STR);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

			exit();

    }
  }

  public function selectParticipations()
  {
    $req = "SELECT * FROM PARTICIPATION";

    // Send the request to the Database
    try
    {
      $stmt = $this->getdb()->prepare($req);
			$stmt->execute();
			
      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt->fetchAll();
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

			exit();

    }
  }

  public function selectPartcipationById($num)
  {
    $req = "SELECT * FROM Participation WHERE idProgramme = :ID";

    // Send the request to the Database
    try
    {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

      $p = new Participation;
      $tab = $this->arrayConstructor($stmt);
      $p->hydrate($tab);
			
      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['participation'] = $p;
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

			exit();

    }
  }

  public function updateParticipationById(Participation $p, $num)
  {
    $req = "UPDATE PARTICIPATION SET idProgramme = :NEW_ID, mailMarcheur = :NEWMAIL, roleMarcheur = :NEWROLE WHERE idProgramme = :ID";

    // Send the request to the Database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
      $stmt->bindValue(":NEW_ID", $p->getnId_Prog(), PDO::PARAM_INT);
      $stmt->bindValue(":NEWMAIL", $p->getsMail_Marcheur(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWROLE", $p->getsRole_Marcheur(), PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

			exit();

    }
  }

  public function deleteParticipationById($num)
  {
    $req = "DELETE FROM PARTICIPATION WHERE idProgramme = :ID";

    // Send the request to the Database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

			exit();

    }
  }

}
?>
