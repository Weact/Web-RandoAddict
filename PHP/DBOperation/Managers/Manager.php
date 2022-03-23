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
