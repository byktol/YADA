<?php
require_once('Food.php');

class CompositeFood extends Food
{
	private $children;
	
	function __construct($name)
	{
		parent::__construct($name);
		$children = array();
	}
	
	public getChildren()
	{
		return $children;
	}
	
	public setChildren($children)
	{
		$this->children = $children;
	}
}
?>
