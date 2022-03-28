<?php
class Traversee
{
  // Private members
  private $nId_Excursion;
  private $sLabel_Terrain;

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
  public function getnId_Excursion()
  {
    return $this->nId_Excursion;
  }

  public function setnId_Excursion($num)
  {
    $this->nId_Excursion = $num;
  }

  public function getsLabel_Terrain()
  {
    return $this->sLabel_Terrain;
  }

  public function setsLabel_Terrain($text)
  {
    $this->sLabel_Terrain = $text;
  }

}

?>
