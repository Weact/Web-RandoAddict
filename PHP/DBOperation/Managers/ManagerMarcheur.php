<!--/*******************************************************************************\
* Fichier       : /PHP/DBOperation/ManagerMarcheur.php
*
* Description   : ---.
*
* Classe        : ManagerExcursion
* Fonctions     : arrayConstructor($stmt)
*                 insertMarcheur(Marcheur $m)
*                 existMarcheurByMail($mail, $mdp)
*                 selectMarcheurs()
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/
/*******************************************************************************\
* 25-03-2022 Romain Schlotter   : Création de l'objet de retour $return et de sa conversion en json
\*******************************************************************************/-->

<?php
require_once("../Objects/MarcheurObject.php")
require_once("Manager.php")
class ManagerMarcheur extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount > 0)
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
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":MAIL", $m->getsMail_Marcheur, PDO::PARAM_STR);
      $stmt->bindValue(":PSEUDO", $m->getsPseudo_Marcheur, PDO::PARAM_STR);
      $stmt->bindValue(":TEL", $m->getsTel_Marcheur, PDO::PARAM_STR);
      $stmt->bindValue(":MDP", $m->getsMdp_Marcheur, PDO::PARAM_STR);
      $stmt->bindValue(":ROLE", $m->getsRole_Marcheur, PDO::PARAM_STR);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

      exit();

    }
  }

  public function existMarcheurByMail($mail, $mdp)
  // Goal : Return a boolean if a user exists
  {
    $req = "SELECT * FROM MARCHEUR WHERE mailMarcheur = :MAIL";

    // Send the request to the database
    try {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount > 0)
			{
				$valueStmt = $stmt->fetchAll()[0];
        
        // Retour success
        $result['success'] = true;
        $result['error'] = false;
        $result['message'] = "success";
        $result['passwordVerify'] = password_verify($mdp, $valueStmt["mdpMarcheur"]);
        echo json_encode($result);

			}else{
        // Return error
        $result['success'] = true;
        $result['error'] = true;
        $result['message'] = "Mot de passe invalide";
        $result['passwordVerify'] = false;
        echo json_encode($result);
			}

    } catch (PDOException $error) {      
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

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
      $stmt = $this->db->prepare($req);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt;
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

			exit();

    }
  }

  public function selectMarcheurByMail($mail)
  {
    $req = "SELECT * FROM MARCHEUR WHERE mailMarcheur = :MAIL";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
			$stmt->execute();

		  $m = new Marcheur;
      $tab = arrayConstructor($stmt);
      $m->hydrate($tab);
        
      // Retour success
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = "success";
      $result['marcheur'] = $m;
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

      exit();

    }
  }

  public function updateMarcheurByMail(Marcheur $m, $mail)
  {
    $req = "UPDATE MARCHEUR SET mailMarcheur = :NEWMAIL, pseudoMarcheur = :NEWPSEUDO, telMarcheur = :NEWTEL, mdpMarcheur = :NEWMDP, roleMarcheur = :NEWROLE WHERE mailMarcheur = :MAIL";
  
    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
      $stmt->bindValue(":NEWMAIL", $m->getsMail_Marcheur, PDO::PARAM_STR);
      $stmt->bindValue(":NEWPSEUDO", $m->getsPseudo_Marcheur, PDO::PARAM_STR);
      $stmt->bindValue(":NEWTEL", $m->getsTel_Marcheur, PDO::PARAM_STR);
      $stmt->bindValue(":NEWMDP", $m->getsMdp_Marcheur, PDO::PARAM_STR);
      $stmt->bindValue(":NEWROLE", $m->getsRole_Marcheur, PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

      exit();

    }
  }

  public function deleteMarcheurByMail($mail)
  {
    $req = "DELETE FROM MARCHEUR WHERE mailMarcheur = :MAIL";

    // Send the request to the database
    try {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);
 
			exit();

    }
  }

}
?>
