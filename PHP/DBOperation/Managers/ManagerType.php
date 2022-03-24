<?php
require_once("../Objects/TypeObject.php")
require_once("Manager.php")

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

    // Send the request to the database
    try {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":LABEL", $t->getsLabel_Type, PDO::PARAM_STR);
      $stmt->bindValue(":INFO", $t->getsDesc_Type, PDO::PARAM_STR);
      $stmt->execute();

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
      exit();

    }
  }

  public function selectTypes()
  // Goal : Select all types of program in the database
  // Return : An array holding all the types
  {
    $req = "SELECT * FROM TYPE";

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

  public function selectTypeByLabel($text)
  // Goal : Select a type of program by a given name
  // Entry : A text for the name
  // Return : A type object
  {
    $req = "SELECT * FROM TYPE WHERE labelType = :LABEL"

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

			$t = new Type;

      $tab = arrayConstructor($stmt);

      $t->hydrate($tab);
      return $t;

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
			exit();

    }
  }

}
?>
