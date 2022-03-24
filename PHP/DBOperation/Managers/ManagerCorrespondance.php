<?php
require_once("../Objects/CorrespondanceObject.php")
require_once("Manager.php")

class ManagerCorrespondance extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Prog" => $valueStmt["idProg"],
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

}

?>
