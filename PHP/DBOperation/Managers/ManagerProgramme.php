<!--/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerProgramme.php
*
* Description   : ---.
*
* Classe        : ManagerProgramme
* Fonctions     : arrayConstructor($stmt)
*                 insertProgramme(Programme $p)
*                 selectProgrammes()
*                 selectProgrammeById($num)
*                 updateProgrammeById(Programme $p, $num)
*                 deleteProgrammeById($num)
*                 selectProgrammesByLabel($text)
*                 selectProgrammesWithValideDate()
*                 selectProgrammesByDifficulty($num)
*
* Créateur      : Luc Cornu
*
\*******************************************************************************/-->

<?php
require_once("../Objects/ProgrammeObject.php");
require_once("Manager.php");

class ManagerProgramme extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Prog" => $valueStmt["idProgramme"],
        "sLabel_Prog" => $valueStmt["labelProgramme"],
        "sDesc_Prog" => $valueStmt["descProgramme"],
        "sDepart_Prog" => $valueStmt["dateDepartProgramme"],
        "sArrivee_Prog" => $valueStmt["dateArriveeProgramme"],
        "nCapacite_Prog" => $valueStmt["capaciteProgramme"],
        "nDifficulte_Prog" => $valueStmt["difficulteProgramme"],
        "sValideProg" => $valueStmt["valideProgramme"]
        );
    }else{
      $tab = array(
        "nId_Prog" => "",
        "sLabel_Prog" => "",
        "sDesc_Prog" => "",
        "sDepart_Prog" => "",
        "sArrivee_Prog" => "",
        "nCapacite_Prog" => "",
        "nDifficulte_Prog" => "",
        "sValideProg" => ""
        );
    }

    return $tab;
  }

  // Database commands
  public function insertProgramme(Programme $p)
  // Goal : Insert a program in the database
  // Entry : A program object
  {
    $req = "INSERT INTO PROGRAMME(labelProgramme, descProgramme, dateDepartProgramme, dateArriveeProgramme, capaciteProgramme, difficulteProgramme, valideProgramme) VALUES (:LABEL, :INFO, :DEPART, :ARIVEE, :CAP, :DIF, :VALIDE)";

    // Send the request to the database
    try {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":LABEL", $p->getsLabel_Prog, PDO::PARAM_STR);
      $stmt->bindValue(":INFO", $p->getsDesc_Prog, PDO::PARAM_STR);
      $stmt->bindValue(":DEPART", $p->getsDepart_Prog, PDO::PARAM_STR);
      $stmt->bindValue(":ARIVEE", $p->getsLabel_Prog, PDO::PARAM_STR);
      $stmt->bindValue(":CAP", $p->getnCapacite_Prog, PDO::PARAM_INT);
      $stmt->bindValue(":DIF", $p->getnDifficulte_Prog, PDO::PARAM_INT);
      $stmt->bindValue(":VALIDE", $p->getsValide_Prog, PDO::PARAM_STR);
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

  public function selectProgrammes()
  // Goal : Select all programs in the database
  // Return : An array holding all the programs
  {
    $req = "SELECT * FROM PROGRAMME";

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
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

			exit();

    }
  }

  public function selectProgrammeById($num)
  // Goal : Select a program by a given ID
  // Entry : A num for the ID
  // Return : A program object
  {
    $req = "SELECT * FROM PROGRAMME WHERE idProgramme = :ID";

		//Envoie de la requête à la base
		try
		{
			$stmt = $this->db->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

			$p = new Programme;
      $tab = arrayConstructor($stmt);
			$p->hydrate($tab);

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['programme'] = $p;
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

  public function updateProgrammeById(Programme $p, $num)
  // Goal : Update a program by a given ID
  // Entry : A number for the ID
  {
    $req = "UPDATE PROGRAMME SET labelProgramme = :NEWLABEL, descProgramme = :NEWINFO, dateDepartProgramme = :NEWDEPART, dateArriveeProgramme = :NEWARRIVEE, capaciteProgramme = :NEWCAP, difficulteProgramme = :NEWDIF, valideProgramme = :NEWVALIDE WHERE idProgramme = :ID";

    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
      $stmt->bindValue(":NEWLABEL", $p->getsLabel_Prog, PDO::PARAM_STR);
      $stmt->bindValue(":NEWINFO", $p->getsDesc_Prog, PDO::PARAM_STR);
      $stmt->bindValue(":NEWDEPART", $p->getsDepart_Prog, PDO::PARAM_STR);
      $stmt->bindValue(":NEWARRIVEE", $p->getsArrivee_Prog, PDO::PARAM_STR);
      $stmt->bindValue(":NEWCAP", $p->getsCapacite_Prog, PDO::PARAM_INT);
      $stmt->bindValue(":NEWDIF", $p->getsDifficulte_Prog, PDO::PARAM_INT);
      $stmt->bindValue(":NEWVALIDE", $p->getsValide_Prog, PDO::PARAM_STR);
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

  public function deleteProgrammeById($num)
  // Goal : Delete a program with a given ID
  // Entry : A num for the ID
  {
    $req = "DELETE FROM PROGRAMME WHERE idProgramme = :ID";

    // Send the request to the Database
    try {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
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

  public function selectProgrammesByLabel($text)
  // Goal : Select a program by a given name
  // Entry : A text for the name
  // Return : An array holding all the programs with the same name
  {
    $req = "SELECT * FROM PROGRAMME WHERE labelProg = :LABEL";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt;
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

  public function selectProgrammesWithValideDate()
  // Goal : Select a program still valid considering the date
  // Return : An array holding all the programs valid
  {
    $req = "SELECT * FROM PROGRAMME WHERE departProg > (CURDATE() + INTERVAL 3 DAY)"; // TO-DO : Verify this one

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
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

			exit();

    }
  }

  public function selectProgrammesByDifficulty($num)
  // Goal : Select a program with a lesser difficulty than a number
  // Entry : A num for the difficulty
  // Return : An array holding all the programs with a lesser difficulty
  {
    $req = "SELECT * FROM PROGRAMME WHERE difficulteProg <= :DIF";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":DIF", $num, PDO::PARAM_STR);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt;
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
