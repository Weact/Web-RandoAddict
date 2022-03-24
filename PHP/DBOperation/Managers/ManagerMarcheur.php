<?php
require_once("../Objects/MarcheurObject.php")
require_once("Manager.php")

class ManagerMarcheur extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "sMail_Utilisateur" => $valueStmt["mailUtilisateur"],
        "sPseudo_Utilisateur" => $valueStmt["pseudoUtilisateur"],
        "sTel_Utilisateur" => $valueStmt["telUtilisateur"],
        "sMdp_Utilisateur" => $valueStmt["mdpUtilisateur"],
        "sRole_Utilisateur" => $valueStmt["roleUtilisateur"]
    }else{
      $tab = array(
        "sMail_Utilisateur" => "",
        "sPseudo_Utilisateur" => "",
        "sTel_Utilisateur" => "",
        "sMdp_Utilisateur" => "",
        "sRole_Utilisateur" => ""
        );
    }

    return $tab;
  }

  // Database commands
  public function insertMarcheur(Marcheur $m)
  // Goal : Insert a user in the database
  // Entry : A marcheur object
  {
    $req = "INSERT INTO MARCHEUR(mailMarcheur, pseudoMarcheur, telUtilisateur, mdpUtilisateur, roleUtilisateur) VALUES (:MAIL, :PSEUDO, :TEL, :MDP, :ROLE)";

    // Send the request to the database
    try {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":MAIL", $m->getsMail_Utilisateur, PDO::PARAM_STR);
      $stmt->bindValue(":PSEUDO", $m->getsPseudo_Utilisateur, PDO::PARAM_STR);
      $stmt->bindValue(":TEL", $m->getsTel_Utilisateur, PDO::PARAM_STR);
      $stmt->bindValue(":MDP", $m->getsMdp_Utilisateur, PDO::PARAM_STR);
      $stmt->bindValue(":ROLE", $m->getsRole_Utilisateur, PDO::PARAM_STR);
      $stmt->execute();

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
      exit();

    }
  }

  public function existMarcheurByMail($mail, $mdp)
  // Goal : Return a boolean if a user exists
  {
    $req = "SELECT * FROM MARCHEUR WHERE mailUtilisateur = :MAIL";

    // Send the request to the Database
    try {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount > 0)
			{
				$valueStmt = $stmt->fetchAll()[0];
				return password_verify($mdp, $valueStmt["mdpUtilisateur"]);
			}else{
				return false;
			}

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
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
			return $stmt;

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
			exit();

    }
  }

}
?>
