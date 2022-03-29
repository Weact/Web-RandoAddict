<?php
/*******************************************************************************\
* Fichier       : /PHP/getdb()Operation/Managers/ManagerPhoto.php
*
* Description   : Le Manager pour la table Photo.
*
* Classe        : ManagerPhoto
* Fonctions     : arrayConstructor($stmt)
*                 insertPhoto(Photo $p)
*                 selectPhotos()
*                 selectPhotoById($num)
*                 updatePhotoById(Photo $p, $num)
*                 deletePhotoById($num)
*                 selectPhotosByLabel($text)
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

require_once("../Objects/PhotoObject.php");
require_once("Manager.php");

class ManagerPhoto extends Manager
{
  private function arrayConstructor($stmt)
  // Goal : It should return the array for the corresponding object
  {
    if($stmt->rowCount() > 0)
    {
      $valueStmt = $stmt->fetchAll()[0];

      $tab = array(
        "nId_Photo" => $valueStmt["idPhoto"],
        "sLien_Photo" => $valueStmt["lienPhoto"],
        "sLabel_Photo" => $valueStmt["labelPhoto"],
        "nId_Excursion" => $valueStmt["idExcursion"]
        );
    }else{
      $tab = array(
        "nId_Photo" => "",
        "sLien_Photo" => "",
        "sLabel_Photo" => "",
        "nId_Excursion" => ""
        );
    }

    return $tab;
  }

  // Database commands
  public function insertPhoto(Photo $p)
  // Goal : Insert a photo in the database
  // Entry : A photo object
  {
    $req = "INSERT INTO PHOTO(lienPhoto, labelPhoto, idExcursion) VALUES (:LIEN, :LABEL, :ID)";

    // Send the request to the database
    try
    {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":LIEN", $p->getsLien_Photo(), PDO::PARAM_STR);
      $stmt->bindValue(":LABEL", $p->getsLabel_Photo(), PDO::PARAM_STR);
      $stmt->bindValue(":ID", $p->nId_Excursion(), PDO::PARAM_INT);
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

  public function selectPhotos()
  // Goal : Select all photos in the database
  // Return : An array holding all the photos
  {
    $req = "SELECT * FROM PHOTO";

    // Send the request to the database
    try
    {
      $stmt = $this->getdb()->prepare($req);
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

  public function selectPhotoById($num)
  // Goal : Select a photo by a given ID
  // Entry : A num for the ID
  // Return : A photo object
  {
    $req = "SELECT * FROM PHOTO WHERE idPhoto = :ID";

		//Envoie de la requête à la base
		try
		{
			$stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

			$p = new Photo;
      $tab = arrayConstructor($stmt);
			$p->hydrate($tab);

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "success";
      $result['photo'] = $p;
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

  public function updatePhotoById(Photo $p, $num)
  // Goal : Update a photo by a given ID
  // Entry : A number for the ID
  {
    $req = "UPDATE PHOTO SET lienPhoto = :NEWLIEN, labelPhoto = :NEWLABEL, idExcursion = :NEW_ID WHERE idPhoto = :ID";

    try
    {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
      $stmt->bindValue(":NEWLIEN", $p->getsLien_Photo(), PDO::PARAM_STR);
      $stmt->bindValue(":NEWLABEL", $p->getsLabel_Photo(), PDO::PARAM_STR);
      $stmt->bindValue(":NEW_ID", $p->getnId_Excursion(), PDO::PARAM_INT);

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "Photo mise à jour";
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

  public function deletePhotoById($num)
  // Goal : Delete a program with a given ID
  // Entry : A num for the ID
  {
    $req = "DELETE FROM PHOTO WHERE idPhoto = :ID";

    // Send the request to the Database
    try {
      $stmt = $this->getdb()->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

      // Return success
      $result['success'] = true;
      $result['error'] = false;
      $result['message'] = "Photo supprimée";
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

  public function selectPhotosByLabel($text)
  {
    $req = "SELECT * FROM PHOTO WHERE labelPhoto = :LABEL";

    // Send the request to the database
    try
    {
      $stmt = $this->getdb()->prepare($req);
      $stmt->bindValue(":ID", $num, PDO::PARAM_STR);
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

}
?>
