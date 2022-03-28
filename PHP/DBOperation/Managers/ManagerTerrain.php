<!--/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/ManagerTerrain.php
*
* Description   : ---.
*
* Classe        : ManagerTerrain
* Fonctions     : arrayConstructor($stmt)
*                 insertTerrain(Terrain $t)
*                 selectTerrains()
*                 selectTerrainByLabel($text)
*                 updateTerrainByLabel(TERRAIN $t, $text)
*                 deleteTerrainByLabel($text)
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/-->

<?php
require_once("../Objects/TerrainObject.php")
require_once("Manager.php")

class ManagerTerrain extends Manager
{
  private function arrayConstructor($stmt)
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "sLabel_Terrain" => $valueStmt["labelTerrain"];
        "sDesc_Terrain" => $valueStmt["descTerrain"];
      );
    }else{
      $tab = array(
        "sLabel_Terrain" => "";
        "sDesc_Terrain" => "";
      );
    }

    return $tab;
  }

  // Database commands
  public function insertTerrain(Terrain $t)
  // Goal : Insert a terrain in the database
  // Entry : A terrain object
  {
    $req = "INSERT INTO TERRAIN(labelTerrain, descTerrain) VALUES (:LABEL, :INFO)";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":LABEL", $t->getsLabel_Terrain, PDO::PARAM_STR);
      $stmt->bindValue(":INFO", $t->getsDesc_Terrain, PDO::PARAM_STR);
      $stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

      exit();

    }
  }

  public function selectTerrains()
  // Goal : Select all terrains in the database
  // Return : An array holding all the terrains
  {
    $req = "SELECT * FROM TERRAIN";

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
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

      exit();

    }
  }

  public function selectTerrainByLabel($text)
  // Goal : Select the terrain identified by the given text
  // Entry : A text
  // Return : A terrain identified by the text
  {
    $req = "SELECT * FROM TERRAIN WHERE labelTerrain = :LABEL"

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

			$t = new Terrain;
      $tab = arrayConstructor($stmt);
      $t->hydrate($tab);
      
      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['terrain'] = $t;
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

      exit();

    }
  }

  public function updateTerrainByLabel(TERRAIN $t, $text)
  // Goal : Update a terrain with a given name
  // Entry : A text for the name
  {
    $req = "UPDATE TERRAIN SET labelTerrain = :NEWLABEL, descTerrain = :NEWINFO WHERE labelTerrain = :LABEL";

    // Send the request to the Database
    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
      $stmt->bindValue(":NEWLABEL", $t->getsLabel_Terrain, PDO::PARAM_STR);
      $stmt->bindValue(":NEWINFO", $t->getsDesc_Terrain, PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

      exit();

    }
  }

  public function deleteTerrainByLabel($text)
  // Goal : Delete a terrain with a given name
  // Entry : A text for the name
  {
    $req = "DELETE FROM TERRAIN WHERE labelTerrain = :LABEL";

    // Send the request to the Database
    try
    {
      $stmt = $this->db->prepare($req);
			$stmt->bindValue(":LABEL", $text, PDO::PARAM_STR);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      echo json_encode($result);

    } catch (PDOException $error) {
      // Return error
      $result['success'] = false;
      $result['error'] = true;
      $result['message'] = $error->getMessage();
      echo json_encode($result);

      exit();

    }
  }

}
?>