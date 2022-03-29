<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerType.php
*
* Description   : Le Manager pour la table Type.
*
* Classe        : ManagerType
* Fonctions     : arrayConstructor($stmt)
*                 insertType(Type $t)
*                 selectTypes()
*                 selectTypeByLabel($text)
*                 updateTypeByLabel(Type $t, $text)
*                 deleTypeByLabel($text)
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

require_once("DBOperation/Objects/TypeObject.php");
require_once("Manager.php");

class ManagerType extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "sLabel_Type" => $valueStmt["labelType"],
        "sDesc_Type" => $valueStmt["descType"]
        );
    }else{
      $tab = array(
        "sLabel_Type" => "",
        "sDesc_Type" => ""
        );
    }

    return $tab;
  }

  // Database commands
  public function insertType(Type $t)
  // Goal : Insert a type of program in the database
  // Entry : A type object
  {
    $req = "INSERT INTO TYPE(labelType, descType) VALUES (:LABEL, :INFO)";

    // Send the request to the Database
    try {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":LABEL", $t->getsLabel_Type(), PDO::PARAM_STR);
      $stmt->bindValue(":INFO", $t->getsDesc_Type(), PDO::PARAM_STR);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
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

  public function selectTypes()
  // Goal : Select all types of program in the database
  // Return : An array holding all the types
  {
    $req = "SELECT * FROM TYPE";

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

  public function selectTypeByLabel($text)
  // Goal : Select a type of program by a given name
  // Entry : A text for the name
  // Return : A type object
  {
    $req = "SELECT * FROM TYPE WHERE labelType = :LABEL"

    // Send the request to the Database
    try
    {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

			$t = new Type;
      $tab = $this->arrayConstructor($stmt);
      $t->hydrate($tab);
      
      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['type'] = $t;
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

  public function updateTypeByLabel(Type $t, $text)
  // Goal : Update a type with a given name
  // Entry : A text for the name
  {
    $req = "UPDATE TYPE SET labelType = :NEWLABEL, descType = :NEWINFO WHERE labelType = :LABEL";

    // Send the request to the Database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
      $stmt->bindValue(":NEWLABEL", $t->getsLabel_Type(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWINFO", $t->getsDesc_Type(), PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
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

  public function deleTypeByLabel($text)
  // Goal : Delete a type with a given name
  // Entry : A text for the name
  {
    $req = "DELETE FROM TYPE WHERE labelType = :LABEL";

    // Send the request to the Database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
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

}
?>
