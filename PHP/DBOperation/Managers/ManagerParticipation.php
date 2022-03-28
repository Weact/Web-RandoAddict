<?php
require_once("../Objects/ParticipationObject.php")
require_once("Manager.php")

class ManagerParticipation extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Prog" => $valueStmt["idProg"],
        "sMail_Utilisateur" => $valueStmt["mailUtilisateur"],
        "sRole_Utilisateur" => $valueStmt["roleUtilisateur"]
    }else{
      $tab = array(
        "nId_Prog" => "",
        "sMail_Utilisateur" => "",
        "sRole_Utilisateur" => ""
        );
    }

    return $tab;
  }

  // Database commands

}
?>
