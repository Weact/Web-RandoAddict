<?php
require_once("../Objects/TraverseeObject.php")
require_once("Manager.php")

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

}
?>
