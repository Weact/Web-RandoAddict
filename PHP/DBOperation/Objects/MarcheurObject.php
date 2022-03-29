<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Objects/MarcheurObject.php
*
* Description   : L'objet Marcheur.
*
* Classe        : Marcheur
* Fonctions     : hydrate(array $donnees)
*				          __destruct()
*				          Getters & Setters
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

class Marcheur
{
	// Private members
	private $sMail_Marcheur;
	private $sPseudo_Marcheur;
  private $sTel_Marcheur;
  private $sMdp_Marcheur;
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
  public function getsMail_Marcheur()
  {
    return $this->sMail_Marcheur;
  }

  public function setsMail_Marcheur($text)
  {
    $this->sMail_Marcheur = $text;
  }

  public function getsPseudo_Marcheur()
  {
    return $this->sPseudo_Marcheur;
  }

  public function setsPseudo_Marcheur($text)
  {
    $this->sPseudo_Marcheur = $text;
  }

  public function getsTel_Marcheur()
  {
    return $this->sTel_Marcheur;
  }

  public function setsTel_Marcheur($text)
  {
    $this->sTel_Marcheur = $text;
  }

  public function getsMdp_Marcheur()
  {
    return $this->sMdp_Marcheur;
  }

  public function setsMdp_Marcheur($text)
  {
    $this->sMdp_Marcheur = $text;
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
