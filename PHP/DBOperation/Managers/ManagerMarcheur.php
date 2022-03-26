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

      // Return success
      $result['success']=true;
      $result['error']=false;
      $result['message']="success";
      $result['stmt']=$stmt;
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success']=false;
      $result['error']=true;
      $result['message']=$error->getMessage();
      echo json_encode($result);

      exit();

    }
  }

  public function existMarcheurByMail($mail, $mdp)
  // Goal : Return a boolean if a user exists
  {
    //objet de retour
    $result;

    $req = "SELECT * FROM MARCHEUR WHERE mailUtilisateur = :MAIL";

    // Send the request to the Database
    try {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount > 0)
			{
				$valueStmt = $stmt->fetchAll()[0];
        
        // Retour success
        $result['success']=true;
        $result['error']=true;
        $result['message']="success";
        $result['passwordVerify']=password_verify($mdp, $valueStmt["mdpUtilisateur"]);
        echo json_encode($result);

				return password_verify($mdp, $valueStmt["mdpUtilisateur"]);
			}else{
        
        // Return error
        $result['success']=true;
        $result['error']=true;
        $result['message']="Mot de passe invalide";
        $result['passwordVerify']=false;
        echo json_encode($result);

				return false;
			}

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
      
      // Return error
      $result['success']=false;
      $result['error']=true;
      $result['message']=$error->getMessage();
      echo json_encode($result);

      exit();

    }
  }

  public function selectMarcheurs()
  // Goal : Select all users in the database
  // Return : An array holding all the users
  {
    //objet de retour
    $result;

    $req = "SELECT * FROM MARCHEUR";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->execute();

      // Return success
      $result['success']=true;
      $result['error']=false;
      $result['message']="success";
      $result['stmt']=$stmt;
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success']=true;
      $result['error']=true;
      $result['message']=$error->getMessage();
      echo json_encode($result);

			exit();

    }
  }

}
?>
