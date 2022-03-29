<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerMarcheur.php
*
* Description   : Le Manager pour la table Marcheur.
*
* Classe        : ManagerMarcheur
* Fonctions     : arrayConstructor($stmt)
*                 insertMarcheur(Marcheur $m)
*                 existMarcheurByMail($mail, $mdp)
*                 selectMarcheurs()
*                 selectMarcheurByMail($mail)
*                 updateMarcheurByMail(Marcheur $m, $mail)
*                 deleteMarcheurByMail($mail)
*
* Créateur      : Luc Cornu
*
\*******************************************************************************/
/*******************************************************************************\
* 25-03-2022 Romain Schlotter   : Création de l'objet de retour $return et de sa conversion en json
\*******************************************************************************/

require_once("DBOperation/Objects/MarcheurObject.php");
require_once("Manager.php");
class ManagerMarcheur extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
		{
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "sMail_Marcheur" => $valueStmt["mailMarcheur"],
        "sPseudo_Marcheur" => $valueStmt["pseudoMarcheur"],
        "sTel_Marcheur" => $valueStmt["telMarcheur"],
        "sMdp_Marcheur" => $valueStmt["mdpMarcheur"],
        "sRole_Marcheur" => $valueStmt["roleMarcheur"]
      );
    } else {
      $tab = array(
        "sMail_Marcheur" => "",
        "sPseudo_Marcheur" => "",
        "sTel_Marcheur" => "",
        "sMdp_Marcheur" => "",
        "sRole_Marcheur" => ""
      );
    }

    return $tab;
  }

  // Database commands
  public function insertMarcheur(Marcheur $m)
  // Goal : Insert a user in the database
  // Entry : A marcheur object
  {
    $req = "INSERT INTO MARCHEUR(mailMarcheur, pseudoMarcheur, telMarcheur, mdpMarcheur, roleMarcheur) VALUES (:MAIL, :PSEUDO, :TEL, :MDP, :ROLE)";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":MAIL", $m->getsMail_Marcheur(), PDO::PARAM_STR);
      $stmt->bindValue(":PSEUDO", $m->getsPseudo_Marcheur(), PDO::PARAM_STR);
      $stmt->bindValue(":TEL", $m->getsTel_Marcheur(), PDO::PARAM_STR);
      $stmt->bindValue(":MDP", md5($m->getsMdp_Marcheur()), PDO::PARAM_STR);
      $stmt->bindValue(":ROLE", $m->getsRole_Marcheur(), PDO::PARAM_STR);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

      exit();

    }
  }

  public function existMarcheurByMail($mail, $mdp)
  // Goal : Return a boolean if a user exists
  {
    $req = "SELECT * FROM MARCHEUR WHERE mailMarcheur = :MAIL";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount() > 0)
			{
				$valueStmt = $stmt->fetchAll()[0];

        // Retour success
        $result['success'] = true;
        $result['error'] = false;
        $result['message'] = "success";
        $result['passwordVerify'] = (md5($mdp) == $valueStmt["mdpMarcheur"]);
        return($result);

			}else{
        // Return error
        $result['success'] = true;
        $result['error'] = true;
        $result['message'] = "Mot de passe invalide";
        $result['passwordVerify'] = false;
        return($result);
			}

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

      exit();

    }
  }

  public function selectMarcheurs()
  // Goal : Select all users in the database
  // Return : An array holding all the users
  {
    $req = "SELECT * FROM MARCHEUR";

    // Send the request to the database
    try
    {
      $stmt = $this->getdb()->prepare($req);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt;
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

  public function selectMarcheurByMail($mail)
  {
    $req = "SELECT * FROM MARCHEUR WHERE mailMarcheur = :MAIL";

    // Send the request to the database
    try
    {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
			$stmt->execute();

		  $m = new Marcheur;
      $tab = $this->arrayConstructor($stmt);
      $m->hydrate($tab);

      // Retour success
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = "success";
      $result['marcheur'] = $m;
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

      exit();

    }
  }

  public function updateMarcheurByMail(Marcheur $m, $mail)
  {
    $req = "UPDATE MARCHEUR SET mailMarcheur = :NEWMAIL, pseudoMarcheur = :NEWPSEUDO, telMarcheur = :NEWTEL, mdpMarcheur = :NEWMDP, roleMarcheur = :NEWROLE WHERE mailMarcheur = :MAIL";

    try
    {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
      $stmt->bindValue(":NEWMAIL", $m->getsMail_Marcheur(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWPSEUDO", $m->getsPseudo_Marcheur(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWTEL", $m->getsTel_Marcheur(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWMDP", md5($m->getsMdp_Marcheur()), PDO::PARAM_STR);
      $stmt->bindValue(":NEWROLE", $m->getsRole_Marcheur(), PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

      exit();

    }
  }

  public function deleteMarcheurByMail($mail)
  {
    $req = "DELETE FROM MARCHEUR WHERE mailMarcheur = :MAIL";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

			exit();

    }
  }

}
?>
