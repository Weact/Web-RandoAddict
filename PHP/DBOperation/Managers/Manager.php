<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/Manager.php
*
* Description   : La classe Manager, dont tous les autres Managers héritent.
* 				  Elle possède en variable la connexion à la base de donnée.
* 				  Les Managers servent à envoyer des requêtes à la BDD à l'aide de PDO_Connect.
* 				  Chaque classes incluent les objets correspondants, il n'est donc pas nécessaire de l'inclure manuellement si le Manager est inclue.
*
* Classe        : Manager
* Fonctions     : __construct($_db)
*                 __destruct()
*                 getdb()
*                 setdb($conn)
*                 __toString()
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

class Manager
{
  // Private members
  private $db;

  public function __construct($_db)
  {
    $this->setDb($_db);
  }

	public function __destruct()
	{
		// None
	}

  // Getters & Setters
	public function getdb()
	{
		return $this->db;
	}

	public function setdb($conn)
	{
		$this->db = $conn;
	}

  // Others
	public function __toString()
	{
		return "Database=".$this->getDb();
	}

}
?>
