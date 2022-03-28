<?php
require_once("../Objects/MaterielObject.php")
require_once("Manager.php")

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
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":LABEL", $m->getsLabel_Materiel, PDO::PARAM_STR);
      $stmt->bindValue(":INFO", $m->getsDesc_Materiel, PDO::PARAM_STR);
      $stmt->execute();

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
      exit();

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
      $stmt = $this->db->prepare($req);
			$stmt->execute();
			return $stmt;

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
			exit();

    }
  }

  public function selectMaterielByLabel($text)
  // Goal : Select a material by a given name
  // Entry : A text for the name
  // Return : A material object
  {
    $req = "SELECT * FROM MATERIEL WHERE labelMateriel = :LABEL"

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

			$m = new Materiel;
      $tab = arrayConstructor($stmt);
      $m->hydrate($tab);
      
      return $m;

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
			exit();

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
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
      $stmt->bindValue(":NEWLABEL", $m->getsLabel_Materiel, PDO::PARAM_STR);
      $stmt->bindValue(":NEWINFO", $m->getsDesc_Materiel, PDO::PARAM_STR);
      $stmt->execute();

    } catch(PDOException $error) {
			echo "<script>console.log('".$error->getMessage()."')</script>";
			exit();

		}
  }

  public function deleteMaterielByLabel($text)
  // Goal : Delete a material with a given name
  // Entry : A text for the name
  {
    $req = "DELETE FROM MATERIEL WHERE labelMateriel = :LABEL";

    // Send the request to the database
    try {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
			exit();

    }
  }

}
?>
