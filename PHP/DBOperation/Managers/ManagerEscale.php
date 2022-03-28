<?php
require_once("../Objects/EscaleObject.php")
require_once("Manager.php")

class ManagerEscale extends Manager
{
  private function arrayConstructor($stmt)
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Excursion" => $valueStmt["idExcursion"],
        "nId_Prog" => $valueStmt["idProg"],

        );
    }else{
      $tab = array(
        "nId_Excursion" => "",
        "nId_Prog" => "",
        );
    }

    return $tab;
  }

  // Database commands

}
?>
