<?php
class Programme
{
	// Private members
	private $nId_Prog;
  private $sLabel_Prog;
  private $sDesc_Prog;
  private $sDepart_Prog;
  private $sArrivee_Prog;
  private $nCapacite_Prog;
  private $nDifficulte_Prog;
  private $sValide_Prog;

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

  public function getsLabel_Prog()
  {
    return $this->sLabel_Prog;
  }

  public function setsLabel_Prog($text)
  {
    $this->sLabel_Prog = $text;
  }

  public function getsDesc_Prog()
  {
    return $this->sDesc_Prog;
  }

  public function setsDesc_Prog($text)
  {
    $this->sDesc_Prog = $text;
  }

  public function getsDepart_Prog()
  {
    return $this->sDepart_Prog;
  }

  public function setsDepart_Prog($text)
  {
    $this->sDepart_Prog = $text;
  }

  public function getsArrivee_Prog()
  {
    return $this->sArrivee_Prog;
  }

  public function setsArrivee_Prog($text)
  {
    $this->sArrivee_Prog = $text;
  }

  public function getnCapacite_Prog()
  {
    return $this->nCapacite_Prog;
  }

  public function setnCapacite_Prog($num)
  {
    $this->nCapacite_Prog = $num;
  }

  public function getnDifficulte_Prog()
  {
    return $this->nDifficulte_Prog;
  }

  public function setnDifficulte_Prog($num)
  {
    $this->nDifficulte_Prog = $num;
  }

  public function getsValide_Prog()
  {
    return $this->sValide_Prog;
  }

  public function setsValide_Prog($text)
  {
    $this->sValide_Prog = $text;
  }

}
?>
