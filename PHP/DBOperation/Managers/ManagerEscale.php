<!--/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerEscale.php
*
* Description   : ---.
*
* Classe        : ManagerEscale
* Fonctions     : arrayConstructor($stmt)
*                 insertEscale($e)
*                 selectEscales()
*                 selectEscaleByIdProg($num)
*                 selectEscaleByIdExcursion($num)
*                 updateEscaleByIdProg($e, $num)
*                 updateEscaleByIdExcursion(Escale $e, $num)
*                 deleteEscaleByIdProg($num)
*                 deleteEscaleByIdExcursion($num)
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/-->

<?php
require_once("../Objects/EscaleObject.php");
require_once("Manager.php");

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
  public function insertEscale(Escale $e)
  {
    $req = "INSERT INTO ESCALE(idExcursion, idProgramme) VALUES (:IDEXC, :IDPROG)";

    // Send the request to the Database
    try
    {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":IDEXC", $e->getnId_Excursion, PDO::PARAM_INT);
      $stmt->bindValue(":IDPROG", $e->getnId_Prog, PDO::PARAM_INT);
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

  public function selectEscales()
  {
    $req = "SELECT * FROM ESCALE";

    // Send the request to the database
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

  public function selectEscaleByIdProg($num)
  {
    $req = "SELECT * FROM ESCALE WHERE idProgramme = :ID";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

      $e = new Escale;
      $tab = arrayConstructor($stmt);
      $e->hydrate($tab);
			
      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['escale'] = $e;
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

  public function selectEscaleByIdExcursion($num)
  {
    $req = "SELECT * FROM ESCALE WHERE idExcursion = :ID";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

      $e = new Escale;
      $tab = arrayConstructor($stmt);
      $e->hydrate($tab);
			
      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['escale'] = $e;
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

  public function updateEscaleByIdProg(Escale $e, $num)
  {
    $req = "UPDATE ESCALE SET idProgramme = :IDPROG, idExcursion = :IDEXC WHERE idProgramme = :ID";

    // Send the request to the Database
    try {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
      $stmt->bindValue(":IDPROG", $e->getnId_Prog, PDO::PARAM_INT);
      $stmt->bindValue(":IDEXC", $e->getnId_Excursion, PDO::PARAM_INT);
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

  public function updateEscaleByIdExcursion(Escale $e, $num)
  {
    $req = "UPDATE ESCALE SET idProgramme = :IDPROG, idExcursion = :IDEXC WHERE idExcursion = :ID";

    // Send the request to the Database
    try {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
      $stmt->bindValue(":IDPROG", $e->getnId_Prog, PDO::PARAM_INT);
      $stmt->bindValue(":IDEXC", $e->getnId_Excursion, PDO::PARAM_INT);
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

  public function deleteEscaleByIdProg($num)
  {
    $req = "DELETE FROM ESCALE WHERE idProgramme = :ID";

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

  public function deleteEscaleByIdExcursion($num)
  {
    $req = "DELETE FROM ESCALE WHERE idExcursion = :ID";

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
