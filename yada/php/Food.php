<?php

require_once 'config.php';

// A simple data type that abstracts a food
abstract class Food implements Clonable
{
	// The name of this food
	private $name;
	// The nutrition facts for this food
	private $facts;
	// Whether the food is enabled
	private $enabled = true;
	// The id of the food
	private $id;
	// Keywords for this food
	private $keywords = null;

	// Constructs a new instance of the Food class
	function __construct($name)
	{
		$this->setName($name);
	}
	
	// Gets the name of the food
	public function getName()
	{
		return $this->name;
	}
	
	// Sets the name of the food
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function createUniqueId()
	{
		$this->id = microtime();
	}
	
	public function getEnabled()
	{
		return $this->enabled;
	}
	
	public function setEnabled($enabled)
	{
		$this->enabled = $enabled;
	}
	
	public function getKeywords()
	{
		return $this->keywords;
	}
	
	public function setKeywords($keywords)
	{
		$this->keywords = $keywords;
	}
	
	// Gets the nutrition facts for this food
	public function getNutritionFacts($countDisabled)
	{
		// If the food is disabled and we don't want to count disabled foods
		if(!$this->getEnabled() && !$countDisabled)
			return array();
		return $this->facts;
	}
	
	// Sets the nutrition facts for this food
	public function setNutritionFacts($facts)
	{
		$this->facts = $facts;
	}
	
	// $countDisabled - true if we want to count the nutrition facts of disabled foods false if we want to ignore
	public function getNutritionFact($name, $countDisabled)
	{
		$facts = $this->getNutritionFacts($countDisabled);
		for($i=0;$i<count($facts);$i++)
		{
			if($facts[$i]->getName() == $name)
			{
				return $facts[$i]->getValue() != 0 ? $facts[$i]->getValue() : 0;
			}
		}
		return 0;
	}
	
	public function setNutritionFact($name, $value)
	{
		$facts = $this->getNutritionFacts(true);
		for($i=0;$i<count($facts);$i++)
		{
			if($facts[$i]->getName() == $name)
			{
				$facts[$i]->setValue($value);
			}
		}
	}
	
	public abstract function hasChildren();
	public abstract function getChildren();
	public abstract function setChildren($children);
	
	public function toString()
	{
		return $this->name.': id = '.$this->id.', enabled = '.$this->enabled.', calories = '.$this->getNutritionFact('calories', true);
	}

  public function clones() {
    $clone = clone $this;
    $arrayOfFacts = array();
    foreach ($this->facts as $f) {
      $arrayOfFacts[] = clone $f;
    }
    $clone->facts = $arrayOfFacts;
    return $clone;
  }
}

?>
