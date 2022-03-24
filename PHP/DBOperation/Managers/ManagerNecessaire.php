<?php
require_once("../Objects/NecessaireObject.php")
require_once("Manager.php")

class ManagerNecessaire extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Prog" => $valueStmt["idProg"],
        "sLabel_Materiel" => $valueStmt["labelMateriel"]
        );
    }else{
      $tab = array(
        "nId_Prog" => "",
        "sLabel_Materiel" => ""
        );
    }

    return $tab;
  }

  // Database commands

}
?>
