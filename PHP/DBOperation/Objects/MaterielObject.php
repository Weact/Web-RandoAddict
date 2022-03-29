<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Objects/MaterielObject.php
*
* Description   : L'objet Materiel.
*
* Classe        : Materiel
* Fonctions     : hydrate(array $donnees)
*				  __destruct()
*				  Getters & Setters
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

class Materiel
{
	// Private members
	private $sLabel_Materiel;
	private $sDesc_Materiel;

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
	public function getsLabel_Materiel()
	{
		return $this->sLabel_Materiel;
	}

	public function setsLabel_Materiel($text)
	{
		$this->sLabel_Materiel = $text;
	}

	public function getsDesc_Materiel()
	{
		return $this->sDesc_Materiel;
	}

	public function setsDesc_Materiel($text)
	{
		$this->sDesc_Materiel = $text;
	}

	// Others

}
?>
