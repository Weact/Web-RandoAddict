<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerProgramme.php
*
* Description   : Le Manager pour la table Programme.
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
\*******************************************************************************/

require_once(__DIR__."/../Objects/ProgrammeObject.php");
require_once("ManagerEscale.php");
require_once("ManagerNecessaire.php");
require_once("ManagerMateriel.php");

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
        "sValide_Prog" => $valueStmt["valideProgramme"]
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
        "sValide_Prog" => ""
        );
    }

    return $tab;
  }

  private function autoInsertEscale(array $ids, $prog_id)
  {
    $m_e = new ManagerEscale(connect_bd());

    foreach($ids as $excursionId)
    {
      $donnees = array (
        "nId_Prog"  => $prog_id,
        "nId_Excursion" => $excursionId
      );

      $e = new Escale;
      $e->hydrate($donnees);

      $m_e->insertEscale($e);
    }
  }

  private function autoInsertNecessaire(array $labels, $prog_id)
  {
    $m_n = new ManagerNecessaire(connect_bd());

    foreach($labels as $materielLabel)
    {
      $donnees = array (
        "nId_Prog"  => $prog_id,
        "sLabel_Materiel" => $materielLabel
      );

      $n = new Necessaire;
      $n->hydrate($donnees);

      $m_n->insertNecessaire($n);
    }
  }

  // Database commands
  public function insertProgramme(Programme $p, array $ids, array $labels)
  // Goal : Insert a program in the database
  // Entry : A program object
  {
    $req = "INSERT INTO PROGRAMME(labelProgramme, descProgramme, dateDepartProgramme, dateArriveeProgramme, capaciteProgramme, difficulteProgramme, valideProgramme) VALUES (:LABEL, :INFO, :DEPART, :ARIVEE, :CAP, :DIF, :VALIDE)";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":LABEL", $p->getsLabel_Prog(), PDO::PARAM_STR);
      $stmt->bindValue(":INFO", $p->getsDesc_Prog(), PDO::PARAM_STR);
      $stmt->bindValue(":DEPART", $p->getsDepart_Prog(), PDO::PARAM_STR);
      $stmt->bindValue(":ARIVEE", $p->getsArrivee_Prog(), PDO::PARAM_STR);
      $stmt->bindValue(":CAP", $p->getnCapacite_Prog(), PDO::PARAM_INT);
      $stmt->bindValue(":DIF", $p->getnDifficulte_Prog(), PDO::PARAM_INT);
      $stmt->bindValue(":VALIDE", $p->getsValide_Prog(), PDO::PARAM_STR);
      $stmt->execute();

      // Creation of a row in Escale & Necessaire
      $last_id = $this->getdb()->lastInsertId();
      $this->autoInsertEscale($ids, $last_id);
      $this->autoInsertNecessaire($labels, $last_id);

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

    }
  }

  public function selectProgrammes()
  // Goal : Select all programs in the database
  // Return : An array holding all the programs
  {
    $req = "SELECT * FROM PROGRAMME";

    // Send the request to the database
    try {
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
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function selectProgrammeById($num)
  // Goal : Select a program by a given ID
  // Entry : A num for the ID
  // Return : A program object
  {
    $req = "SELECT * FROM PROGRAMME WHERE idProgramme = :ID";

		//Envoie de la requête à la base
		try {
			$stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

			$p = new Programme;
      $tab = $this->arrayConstructor($stmt);
			$p->hydrate($tab);

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['programme'] = $p;
      return($result);

		} catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function updateProgrammeById(Programme $p, $num)
  // Goal : Update a program by a given ID
  // Entry : A number for the ID
  {
    $req = "UPDATE PROGRAMME SET labelProgramme = :NEWLABEL, descProgramme = :NEWINFO, dateDepartProgramme = :NEWDEPART, dateArriveeProgramme = :NEWARRIVEE, capaciteProgramme = :NEWCAP, difficulteProgramme = :NEWDIF, valideProgramme = :NEWVALIDE WHERE idProgramme = :ID";

    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
      $stmt->bindValue(":NEWLABEL", $p->getsLabel_Prog(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWINFO", $p->getsDesc_Prog(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWDEPART", $p->getsDepart_Prog(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWARRIVEE", $p->getsArrivee_Prog(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWCAP", $p->getsCapacite_Prog(), PDO::PARAM_INT);
      $stmt->bindValue(":NEWDIF", $p->getsDifficulte_Prog(), PDO::PARAM_INT);
      $stmt->bindValue(":NEWVALIDE", $p->getsValide_Prog(), PDO::PARAM_STR);
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

    }
  }

  public function deleteProgrammeById($num)
  // Goal : Delete a program with a given ID
  // Entry : A num for the ID
  {
    $req = "DELETE FROM PROGRAMME WHERE idProgramme = :ID";

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
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function selectProgrammesByLabel($text)
  // Goal : Select a program by a given name
  // Entry : A text for the name
  // Return : An array holding all the programs with the same name
  {
    $req = "SELECT * FROM PROGRAMME WHERE labelProgramme LIKE :LABEL";
    $text = "%".$text."%";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt;
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function selectProgrammesWithValideDate()
  // Goal : Select a program still valid considering the date
  // Return : An array holding all the programs valid
  {
    $req = "SELECT * FROM PROGRAMME WHERE departProgramme > (CURDATE() + INTERVAL 3 DAY)"; // TO-DO : Verify this one

    // Send the request to the database
    try {
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
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function selectProgrammesByDifficulty($num)
  // Goal : Select a program with a lesser difficulty than a number
  // Entry : A num for the difficulty
  // Return : An array holding all the programs with a lesser difficulty
  {
    $req = "SELECT * FROM PROGRAMME WHERE difficulteProgramme <= :DIF";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":DIF", $num, PDO::PARAM_STR);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt;
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function selectPassedProgrammeByMailMarcheur($mail)
  {
    $req = "SELECT * FROM PROGRAMME WHERE PROGRAMME.dateDepartProgramme < CURDATE() AND PROGRAMME.idProgramme IN (SELECT PARTICIPATION.idProgramme FROM PARTICIPATION WHERE PARTICIPATION.mailMarcheur = :MAIL)";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt;
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function selectFuturProgrammeByMailMarcheur($mail)
  {
    $req = "SELECT * FROM PROGRAMME WHERE PROGRAMME.dateDepartProgramme > CURDATE() AND PROGRAMME.idProgramme IN (SELECT PARTICIPATION.idProgramme FROM PARTICIPATION WHERE PARTICIPATION.mailMarcheur = :MAIL)";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":MAIL", $mail, PDO::PARAM_STR);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt;
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function selectMaterielByProgrammeId($id)
  {
    $req = "SELECT * FROM MATERIEL WHERE MATERIEL.labelMateriel IN (SELECT NECESSAIRE.labelMateriel FROM NECESSAIRE WHERE NECESSAIRE.idProgramme = :ID)";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":ID", $id, PDO::PARAM_INT);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt;
      return($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

}

?>
