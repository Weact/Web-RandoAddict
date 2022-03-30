<?php
/*******************************************************************************\
* Fichier       : /PHP/DBOperation/Objects/EscaleObject.php
*
* Description   : L'objet Escale.
*
* Classe        : Escale
* Fonctions     : hydrate(array $donnees)
*				  __destruct()
*				  Getters & Setters
*
* Créateur      : Luc Cornu
* 
\*******************************************************************************/

class Escale
{
	// Private members
	private $nId_Excursion;
	private $nId_Prog;

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
  public function getnId_Excursion()
  {
    return $this->nId_Excursion;
  }

  public function setnId_Excursion($num)
  {
    $this->nId_Excursion = $num;
  }

  public function getnId_Prog()
  {
    return $this->nId_Prog;
  }

  public function setnId_Prog($num)
  {
    $this->nId_Prog = $num;
  }

}
?>
