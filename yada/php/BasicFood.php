<?php
require_once 'config.php';

require_once 'Food.php';

// TODO
class BasicFood extends Food
{
	public static $Undefined = null;

	// Constructs a new instance of the BasicFood class
	function __construct($name)
	{
		parent::__construct($name);
	}
	
	// Basic food does not have children
	function hasChildren()
	{
		return false;
	}
	
	// Basic food does not have children 
	function getChildren()
	{
		return false;
	}
	
	// Basic food does not have children
	function setChildren($children)
	{
		return false;
	}
}
?>
