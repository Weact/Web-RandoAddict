<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Objects/PhotoObject.php
*
* Description   : L'objet Photo.
*
* Classe        : Photo
* Fonctions     : hydrate(array $donnees)
*				          __destruct()
*				          Getters & Setters
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

class Photo
{
  // Private members
	private $nId_Photo;
	private $sLien_Photo;
  private $sLabel_Photo;
  private $nId_Excursion;

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
  public function getnId_Photo()
  {
    return $this->nId_Photo;
  }

  public function setnId_Photo($num)
  {
    $this->nId_Photo = $num;
  }

  public function getsLien_Photo()
  {
    return $this->sLien_Photo;
  }

  public function setsLien_Photo($text)
  {
    $this->sLien_Photo = $text;
  }

  public function getsLabel_Photo()
  {
    return $this->sLabel_Photo;
  }

  public function setsLabel_Photo($text)
  {
    $this->sLabel_Photo = $text;
  }

  public function getnId_Excursion()
  {
    return $this->nId_Excursion;
  }

  public function setnId_Excursion($num)
  {
    $this->nId_Excursion = $num;
  }

}
?>
