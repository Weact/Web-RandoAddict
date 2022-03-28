<?php
class Excursion
{
  // Private members
	private $nId_Excursion;
  private $sLabel_Excursion;
  private $sDesc_Excursion;
  private $sChemin_Excursion;
  private $fPrix_Excursion;

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

  public function getsLabel_Excursion()
  {
    return $this->sLabel_Excursion;
  }

  public function setsLabel_Excursion($text)
  {
    $this->sLabel_Excursion = $text;
  }

  public function getsDesc_Excursion()
  {
    return $this->sDesc_Excursion;
  }

  public function setsDesc_Excursion($text)
  {
    $this->sDesc_Excursion = $text;
  }

  public function getsChemin_Excursion()
  {
    return $this->sChemin_Excursion;
  }

  public function setsChemin_Excursion($text)
  {
    $this->sChemin_Excursion = $text;
  }

  public function getfPrix_Excursion()
  {
    return $this->fPrix_Excursion;
  }

  public function setfPrix_Excursion($float)
  {
    $this->fPrix_Excursion = $float;
  }

}
?>
