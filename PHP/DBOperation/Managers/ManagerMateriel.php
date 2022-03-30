<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerMateriel.php
*
* Description   : Le Manager pour la table Materiel.
*
* Classe        : ManagerMateriel
* Fonctions     : arrayConstructor($stmt)
*                 insertMateriel(Materiel $m)
*                 selectMateriels()
*                 selectMaterielByLabel($text)
*                 updateMaterielByLabel($m, $text)
*                 deleteMaterielByLabel($text)
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

require_once(__DIR__."/../../DBOperation/Objects/MaterielObject.php");
require_once("Manager.php");

class ManagerMateriel extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "sLabel_Materiel" => $valueStmt["labelMateriel"],
        "sDesc_Materiel" => $valueStmt["descMateriel"]
        );
    }else{
      $tab = array(
        "sLabel_Materiel" => "",
        "sDesc_Materiel" => ""
        );
    }

    return $tab;
  }

  // Database commands
  public function insertMateriel(Materiel $m)
  // Goal : Insert a material in the database
  // Entry : A material object
  {
    $req = "INSERT INTO MATERIEL(labelMateriel, descMateriel) VALUES (:LABEL, :INFO)";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":LABEL", $m->getsLabel_Materiel(), PDO::PARAM_STR);
      $stmt->bindValue(":INFO", $m->getsDesc_Materiel(), PDO::PARAM_STR);
      $stmt->execute();

      // Retour success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      return($result);

    } catch (PDOException $error) {
      // Retour error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function selectMateriels()
  // Goal : Select all materials in the database
  // Return : An array holding all the materials
  {
    $req = "SELECT * FROM MATERIEL";

    // Send the request to the database
    try
    {
      $stmt = $this->getdb()->prepare($req);
			$stmt->execute();
			
      // Retour success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['stmt'] = $stmt;
      return($result);

    } catch (PDOException $error) {
      // Retour error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function selectMaterielByLabel($text)
  // Goal : Select a material by a given name
  // Entry : A text for the name
  // Return : A material object
  {
    $req = "SELECT * FROM MATERIEL WHERE labelMateriel = :LABEL";

    // Send the request to the database
    try
    {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

			$m = new Materiel;
      $tab = $this->arrayConstructor($stmt);
      $m->hydrate($tab);
      
      // Retour success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['materiel'] = $m;
      return($result);

    } catch (PDOException $error) {
      // Retour error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

  public function updateMaterielByLabel($m, $text)
  // Goal : Update a material by a given name
  // Entry : A text for the name
  {
    $req = "UPDATE MATERIEL SET labelMateriel = :NEWLABEL, descMateriel = :NEWINFO WHERE labelMateriel = :LABEL";

    // Send the request to the database
    try
    {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
      $stmt->bindValue(":NEWLABEL", $m->getsLabel_Materiel(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWINFO", $m->getsDesc_Materiel(), PDO::PARAM_STR);
      $stmt->execute();

      // Retour success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      return($result);

    } catch(PDOException $error) {
			// Retour error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

		}
  }

  public function deleteMaterielByLabel($text)
  // Goal : Delete a material with a given name
  // Entry : A text for the name
  {
    $req = "DELETE FROM MATERIEL WHERE labelMateriel = :LABEL";

    // Send the request to the database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

      // Retour success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      return($result);

    } catch (PDOException $error) {
      // Retour error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      return($result);

    }
  }

}
?>
