<?php
class Terrain
{
	// Private members
	private $sMail_Utilisateur;
	private $sPseudo_Utilisateur;
  private $sTel_Utilisateur;
  private $sMdp_Utilisateur;
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
  public function getsMail_Utilsateur()
  {
    return $this->sMail_Utilisateur;
  }

  public function setsMail_Utilisateur($text)
  {
    $this->sMail_Utilisateur = $text;
  }

  public function getsPseudo_Utilsateur()
  {
    return $this->sPseudo_Utilisateur;
  }

  public function setsPseudo_Utilisateur($text)
  {
    $this->sPseudo_Utilisateur = $text;
  }

  public function getsTel_Utilsateur()
  {
    return $this->sTel_Utilisateur;
  }

  public function setsTel_Utilisateur($text)
  {
    $this->sTel_Utilisateur = $text;
  }

  public function getsMdp_Utilsateur()
  {
    return $this->sMdp_Utilisateur;
  }

  public function setsMdp_Utilisateur($text)
  {
    $this->sMdp_Utilisateur = $text;
  }

  public function getsRole_Utilsateur()
  {
    return $this->sRole_Utilisateur;
  }

  public function setsRole_Utilisateur($text)
  {
    $this->sRole_Utilisateur = $text;
  }

}
?>
