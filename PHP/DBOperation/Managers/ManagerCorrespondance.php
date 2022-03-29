<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerExcursion.php
*
* Description   : Le Manager pour la table correspondance_type.
*
* Classe        : ManagerExcursion
* Fonctions     : arrayConstructor($stmt)
*                 insertExcursion(Excursion $e)
*                 selectExcursions()
*                 selectExcursionById($num)
*                 selectExcursionsByPrice($float)
*                 selectExcursionsByLabel($text)
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/
/*******************************************************************************\
* 25-03-2022 Romain Schlotter   : Création de l'objet de retour $return et de sa conversion en json
\*******************************************************************************/

require_once("DBOperation/Objects/CorrespondanceObject.php");
require_once("Manager.php");

class ManagerCorrespondance extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Prog" => $valueStmt["idProgramme"],
        "sLabel_Type" => $valueStmt["labelType"]
        );
    }else{
      $tab = array(
        "nId_Prog" => "",
        "sLabel_Type" => ""
        );
    }

    return $tab;
  }

  // Database commands
  public function insertCorrespondance(Correspondance $c)
  {
    $req = "INSERT INTO CORRESPONDANCE_TYPE(idProgramme, labelType) VALUES (:ID, :LABEL)";

    // Send the request to the Database
    try {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":ID", $c->getnId_Prog(), PDO::PARAM_INT);
      $stmt->bindValue(":LABEL", $c->getsLabel_Type(), PDO::PARAM_STR);
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

  public function selectCorrespondances()
  {
    $req = "SELECT * FROM CORRESPONDANCE_TYPE";

    // Send the request to the Database
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

  public function selectCorrespondanceById($num)
  {
    $req = "SELECT * FROM CORRESPONDANCE_TYPE WHERE idProgramme = :ID";

    // Send the request to the Database
    try
    {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

      $c = new Correspondance;
      $tab = $this->arrayConstructor($stmt);
      $c->hydrate($tab);
			
      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['correspondance'] = $c;
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

  public function updateCorrespondanceById(Correspondance $c, $num)
  {
    $req = "UPDATE CORRESPONDANCE_TYPE SET idProgramme = :NEW_ID, labelType = :NEWLABEL WHERE idProgramme = :ID";

    // Send the request to the Database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
      $stmt->bindValue(":NEW_ID", $c->getnId_Prog(), PDO::PARAM_INT);
      $stmt->bindValue(":NEWLABEL", $c->getsLabel_Type(), PDO::PARAM_STR);
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

  public function deleteCorrespondanceById($num)
  {
    $req = "DELETE FROM CORRESPONDANCE_TYPE WHERE idProgramme = :ID";

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
