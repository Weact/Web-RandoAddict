<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Objects/TypeObject.php
*
* Description   : L'objet Type.
*
* Classe        : Type
* Fonctions     : hydrate(array $donnees)
*				          __destruct()
*				          Getters & Setters
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

class Type
{
	// Private members
	private $sLabel_Type;
	private $sDesc_Type;

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
  public function getsLabel_Type()
  {
    return $this->sLabel_Type;
  }

  public function setsLabel_Type($text)
  {
    $this->sLabel_Type = $text;
  }

  public function getsDesc_Type()
  {
    return $this->sDesc_Type;
  }

  public function setsDesc_Type($text)
  {
    $this->sDesc_Type = $text;
  }

}
?>
