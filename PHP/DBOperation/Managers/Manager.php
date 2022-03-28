<!--/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Managers/Manager.php
*
* Description   : ---.
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
\*******************************************************************************/-->


<?php
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
