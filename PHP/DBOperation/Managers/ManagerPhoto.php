<?php
require_once("../Objects/PhotoObject.php")
require_once("Manager.php")

class ManagerPhoto extends Manager
{
  // Database commands
  public function insertPhoto(Photo $p)
  // Goal : Insert a photo in the database
  // Entry : A photo object
  {
    $req = "INSERT INTO PHOTO(lienPhoto, labelPhoto, idPhoto) VALUES (:LIEN, :LABEL, :ID)";

    // Send the request to the database
    try
    {
      $stmt = $this->db->prepare($req);
      $stmt->bindValue(":LIEN", $p->getsLien_Photo, PDO::PARAM_STR);
      $stmt->bindValue(":LABEL", $p->getsLabel_Photo, PDO::PARAM_STR);
      $stmt->bindValue(":ID", $p->nId_Photo, PDO::PARAM_INT);
      $stmt->execute();

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
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
      $stmt = $this->db->prepare($req);
			$stmt->execute();
			return $stmt;

    } catch (PDOException $error) {
      echo "<script>console.log('".$error->getMessage()."')</script>";
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
			$stmt = $this->db->prepare($req);
			$stmt->bindValue(":ID", $num, PDO::PARAM_INT);
			$stmt->execute();

			$p = new Photo;

			if($stmt->rowCount() > 0)
			{
				$valueStmt = $stmt->fetchAll()[0];

				$tab = array(
					"nId_Photo" => $valueStmt["idPhoto"],
          "sLien_Photo" => $valueStmt["LienPhoto"],
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

			$p->hydrate($tab);
			return $p;

		}
		catch(PDOException $error)
		{
			echo "<script>console.log('".$error->getMessage()."')</script>";
			exit();

		}
  }

}
?>
