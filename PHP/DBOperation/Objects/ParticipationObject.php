<?php
class Participation
{
	// Private members
	private $nId_Prog;
	private $sMail_Utilisateur;
  private $sRole_Utilisateur;

	// Methods
	// Hydrate
	public function hydrate(array $donnees)
	{
		foreach($donnees as $key => $value)
		{
      // We get the name of the setter corresponding to the attribut
			$method = "set".ucfirst($key);

			// If the setter exists
			if(method_exists($this, $method))
			{
				// We call the setter
				$this->$method($value);
			}
		}
	}

	public function __destruct()
	{
		// None
	}

	// Getters & Setters
  public function getnId_Prog()
  {
    return $this->nId_Prog;
  }

  public function setnId_Prog($num)
  {
    $this->nId_Prog = $num;
  }

  public function getsMail_Utilisateur()
  {
    return $this->sMail_Utilisateur;
  }

  public function setsMail_Utilisateur($text)
  {
    $this->sMail_Utilisateur = $text;
  }

  public function getsRole_Utilisateur()
  {
    return $this->sRole_Utilisateur;
  }

  public function setsRole_Utilisateur($text)
  {
    $this->sRole_Utilisateur = $text;
  }

}
?>
