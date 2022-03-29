<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerTraversee.php
*
* Description   : Le Manager pour la table Traversée.
*
* Classe        : ManagerTraversee
* Fonctions     : arrayConstructor($stmt)
*                 insertTraversee(Traversee $n)
*                 selectTraversees()
*                 selectTraverseeById($num)
*                 updateTraverseeById(Traversee $t, $num)
*                 deleteTraverseeById($num)
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

require_once("DBOperation/Objects/TraverseeObject.php");
require_once("Manager.php");

class ManagerTraversee extends Manager
{
  private function arrayConstructor($stmt)
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Excursion" => $valueStmt["idExcursion"];
        "sLabel_Terrain" => $valueStmt["labelTerrain"];
      );
    }else{
      $tab = array(
        "nId_Excursion" => "";
        "sLabel_Terrain" => "";
      );
    }

    return $tab;
  }

  // Database commands
  public function insertTraversee(Traversee $n)
  {
    $req = "INSERT INTO TRAVERSEE(idExcursion, labelTerrain) VALUES (:ID, :LABEL)";

    // Send the request to the Database
    try
    {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":ID", $n->getnId_Excursion(), PDO::PARAM_INT);
      $stmt->bindValue(":LABEL", $n->getsLabel_Terrain(), PDO::PARAM_STR);
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

  public function selectTraversees()
  {
    $req = "SELECT * FROM TRAVERSEE";

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

  public function selectTraverseeById($num)
  {
    $req = "SELECT * FROM TRAVERSEE WHERE idExcursion = :ID";

    // Send the request to the Database
    try
    {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

      $t = new Traversee;
      $tab = $this->arrayConstructor($stmt);
      $t->hydrate($tab);
			
      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['Traversee'] = $t;
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

  public function updateTraverseeById(Traversee $t, $num)
  {
    $req = "UPDATE TRAVERSEE SET idExcursion = :NEW_ID, labelTerrain = :NEWLABEL WHERE idExcursion = :ID";

    // Send the request to the Database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
      $stmt->bindValue(":NEW_ID", $t->getnId_Excursion(), PDO::PARAM_INT);
      $stmt->bindValue(":NEWLABEL", $t->getsLabel_Terrain(), PDO::PARAM_STR);
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

  public function deleteTraverseeById($num)
  {
    $req = "DELETE FROM TRAVERSEE WHERE idExcursion = :ID";

    // Send the request to the Database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
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
