<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Objects/CorrepondanceObject.php
*
* Description   : L'objet Correspondance.
*
* Classe        : Correspondance
* Fonctions     : hydrate(array $donnees)
*				  __destruct()
*				  Getters & Setters
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

class Correspondance
{
	// Private members
	private $nId_Prog;
  	private $sLabel_Type;

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

	public function getsLabel_Type()
	{
		return $this->sLabel_Type;
	}

	public function setsLabel_Type($text)
	{
		$this->sLabel_Type = $text;
	}

}
?>
