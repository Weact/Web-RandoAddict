<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Objects/TerrainObject.php
*
* Description   : L'objet Terrain.
*
* Classe        : Terrain
* Fonctions     : hydrate(array $donnees)
*				  __destruct()
*				  Getters & Setters
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

class Terrain
{
	// Private members
	private $sLabel_Terrain;
	private $sDesc_Terrain;

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
	public function getsLabel_Terrain()
	{
		return $this->sLabel_Terrain;
	}

	public function setsLabel_Terrain($text)
	{
		$this->sLabel_Terrain = $text;
	}

	public function getsDesc_Terrain()
	{
		return $this->sDesc_Terrain;
	}

	public function setsDesc_Terrain($text)
	{
		$this->sDesc_Terrain = $text;
	}

	// Others

}

?>
