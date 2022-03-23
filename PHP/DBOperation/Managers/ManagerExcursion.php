<?php
require_once("../Objects/ExcursionObject.php")
require_once("Manager.php")

class ManagerExcursion extends Manager
{
  // Database commands
  public function insertExcursion(Excursion $e)
  // Goal : Insert an excursion in the database
  // Entry : A excursion object
  {
    $req = "INSERT INTO EXCURSION(labelExcursion, descExcursion, cheminExcursion, prixExcursion) VALUES (:LABEL, :INFO, :CHEMIN, :PRIX)";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
      // $stmt->bindValue(":ID", $e->getnId_Excursion, PDO::PARAM_INT)
      $stmt->bindValue(":LABEL", $e->getsLabel_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":INFO", $e->getsDesc_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":CHEMIN", $e->getsChemin_Excursion, PDO::PARAM_STR);
      $stmt->bindValue(":PRIX", $e->getfPrix_Excursion, PDO::PARAM_STR); // There is no PDO::PARAM_FLOAT
      $stmt->execute();

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
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
			return $stmt;

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
			exit();

    }
  }

  // TO DO

}
?>
