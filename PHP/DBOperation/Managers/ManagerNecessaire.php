<!--/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerNecessaire.php
*
* Description   : ---.
*
* Classe        : ManagerNecessaire
* Fonctions     : arrayConstructor($stmt)
*                 insertNecessaire(Necessaire $n)
*                 selectNecessaires()
*                 selectNecessaireById($num)
*                 updateNecessaireById(Necessaire $n, $num)
*                 deleteNecessaireById($num)
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/-->

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
  public function insertNecessaire(Necessaire $n)
  {
    $req = "INSERT INTO NECESSAIRE(idProgramme, labelMateriel) VALUES (:ID, :LABEL)";

    // Send the request to the Database
    try
    {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":ID", $n->getnId_Prog, PDO::PARAM_INT);
      $stmt->bindValue(":LABEL", $n->getsLabel_Materiel, PDO::PARAM_STR);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

			exit();

    }
  }

  public function selectNecessaires()
  {
    $req = "SELECT * FROM NECESSAIRE";

    // Send the request to the Database
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
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

			exit();

    }
  }

  public function selectNecessaireById($num)
  {
    $req = "SELECT * FROM NECESSAIRE WHERE idProgramme = :ID";

    // Send the request to the Database
    try
    {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

      $n = new Necessaire;
      $tab = arrayConstructor($stmt);
      $n->hydrate($tab);
			
      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['necessaire'] = $n;
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

			exit();

    }
  }

  public function updateNecessaireById(Necessaire $n, $num)
  {
    $req = "UPDATE NECESSAIRE SET idProgramme = :NEW_ID, labelMateriel = :NEWLABEL WHERE idProgramme = :ID";

    // Send the request to the Database
    try {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
      $stmt->bindValue(":NEW_ID", $n->getnId_Prog, PDO::PARAM_INT);
      $stmt->bindValue(":NEWLABEL", $n->getsLabel_Materiel, PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

			exit();

    }
  }

  public function deleteNecessaireById($num)
  {
    $req = "DELETE FROM NECESSAIRE WHERE idProgramme = :ID";

    // Send the request to the Database
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
      $result['success'] = true;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

			exit();

    }
  }

}
?>
