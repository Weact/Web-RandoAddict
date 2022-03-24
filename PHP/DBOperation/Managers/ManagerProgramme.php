<?php
require_once("../Objects/ProgrammeObject.php")
require_once("Manager.php")

class ManagerProgramme extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Prog" => $valueStmt["idProg"],
        "sLabel_Prog" => $valueStmt["labelProg"],
        "sDesc_Prog" => $valueStmt["descProg"],
        "sDepart_Prog" => $valueStmt["departProg"],
        "sArrivee_Prog" => $valueStmt["arriveeProg"],
        "nCapacite_Prog" => $valueStmt["capaciteProg"],
        "nDifficulte_Prog" => $valueStmt["difficulteProg"],
        "sValideProg" => $valueStmt["valideProg"]
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
    $req = "INSERT INTO PROGRAMME(labelProg, descProg, departProg, ariveeProg, capaciteProg, difficulteProg, valideProg) VALUES (:LABEL, :INFO, :DEPART, :ARIVEE, :CAP, :DIF, :VALIDE)";

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

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
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
			return $stmt;

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
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
			return $p;

		}
		catch(PDOException $error)
		{
			echo "<script>console.log('".$error->getMessage()."')</script>";
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
			return $stmt;

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
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
			return $stmt;

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
			exit();

    }
  }

  public function selectProgrammesByValidation($bool)
  // Goal : Select a program with validation or not
  // Entry : A boolean
  // Return : An array holding all the programs valid
  {
    // TO-DO <--
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
      return $stmt;

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
      exit();

    }
  }

}

?>
