<?php
class Participation
{
	// Private members
	private $nId_Prog;
	private $sMail_Marcheur;
  private $sRole_Marcheur;

	// Methods
	// Hydrate
	public function hydrate(array $donnees)
	{
		foreach($donnees as $key => $value)
		{
      // We get the name of the setter corresponding to the attribut
			$method = "set".$key;

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

  public function getsMail_Marcheur()
  {
    return $this->sMail_Marcheur;
  }

  public function setsMail_Marcheur($text)
  {
    $this->sMail_Marcheur = $text;
  }

  public function getsRole_Marcheur()
  {
    return $this->sRole_Marcheur;
  }

  public function setsRole_Marcheur($text)
  {
    $this->sRole_Marcheur = $text;
  }

}
?>
