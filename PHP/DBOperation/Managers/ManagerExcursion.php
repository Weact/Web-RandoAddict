<!--/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerExcursion.php
*
* Description   : ---.
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
\*******************************************************************************/-->

<?php
require_once("../Objects/ExcursionObject.php");
require_once("Manager.php");

class ManagerExcursion extends Manager
{
  private function arrayConstructor($stmt)
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Excursion" => $valueStmt["idExcursion"],
        "sLabel_Excursion" => $valueStmt["labelExcursion"],
        "sDesc_Excursion" => $valueStmt["descExcursion"],
        "sDepart_Excursion" => $valueStmt["departExcursion"],
        "sArrivee_Excursion" => $valueStmt["arriveeExcursion"],
        "fPrix_Excursion" => $valueStmt["prixExcursion"]
        );
    } else {
      $tab = array(
        "nId_Excursion" => "",
        "sLabel_Excursion" => "",
        "sDesc_Excursion" => "",
        "sDepart_Excursion" => "",
        "sArrivee_Excursion" => "",
        "fPrix_Excursion" => ""
        );
    }

    return $tab;
  }

  // Database commands
  public function insertExcursion(Excursion $e)
  // Goal : Insert an excursion in the database
  // Entry : A excursion object
  {
    $req = "INSERT INTO EXCURSION(labelExcursion, descExcursion, departExcursion, arriveeExcursion, prixExcursion) VALUES (:LABEL, :INFO, :DEPART, :ARRIVEE, :PRIX)";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
      // $stmt->bindValue(":ID", $e->getnId_Excursion, PDO::PARAM_INT)
      $stmt->bindValue(":LABEL", $e->getsLabel_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":INFO", $e->getsDesc_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":DEPART", $e->getsDepart_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":ARRIVEE", $e->getsArrivee_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":PRIX", $e->getfPrix_Excursion, PDO::PARAM_STR); // There is no PDO::PARAM_FLOAT
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

  public function selectExcursions()
  // Goal : Select all excursions in the database
  // Return : An array holding all the excursions
  {
    $req = "SELECT * FROM EXCURSION";

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

  public function selectExcursionById($num)
  // Goal : Select an excursion by a given ID
  // Entry : A num for the ID
  // Return : An Excursion object
  {
    $req = "SELECT * FROM EXCURSION WHERE idExcursion = :ID";

		//Envoie de la requête à la base
		try
		{
			$stmt = $this->db->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

			$e = new Excursion;
      $tab = arrayConstructor($stmt);
			$e->hydrate($tab);
      
      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['excursion'] = $e;
      echo json_encode($result);

		} catch(PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

			exit();

		}
  }

  public function updateExcursionById(Excursion $e, $num)
  {
    $req = "UPDATE EXCURSION SET idExcursion = :NEW_ID, labelExcursion = :NEWLABEL, descExcursion = :NEWINFO, departExcursion = :NEWDEPART, arriveeExcursion = :NEWARRIVEE, prixExcursion = :NEWPRIX WHERE idExcursion = :ID";

    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
      $stmt->bindValue(":NEW_ID", $e->getnId_Excursion, PDO::PARAM_INT);
      $stmt->bindValue(":NEWLABEL", $e->getsLabel_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":NEWINFO", $e->getsDesc_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":NEWDEPART", $e->getsDepart_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":NEWARRIVEE", $e->getsArrivee_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":NEWPRIX", $m->getfPrix_Excursion, PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      echo json_encode($result);

    } catch(PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

			exit();

		}
  }

  public function deleteExcursionById($num)
  {
    $req = "DELETE FROM EXCURSION WHERE idExcursion = :ID";

    // Send the request to the database
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

  public function selectExcursionsByPrice($float)
  // Goal : Select all excursions with a price under a given number
  // Entry : A float for the maximum price acceptable
  // Return : An array holding all the corresponding excursions
  {
    $req = "SELECT * FROM EXCURSION WHERE prixExcursion <= :PRIX";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":PRIX", $float, PDO::PARAM_STR);
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

  public function selectExcursionsByLabel($text)
  // Goal : Select all the excursions with a given label
  // Entry : A text for the label
  // Return : An array holding all the corresponding excursions
  {
    $req = "SELECT * FROM EXCURSION WHERE labelExcursion = :LABEL";

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

}
?>
