<?php
/**
 * 
 */
class User extends DataBoundObject
{	
	// PROPERTIES
	protected $UserName;
	protected $Password;
	protected $Category;
	protected $RegisteredOn;

	
	//--------PUBLIC METHODS--------//

	// DATABASE TABLE
	public function DefineTableName()
	{
		return("users");
	}

	//OBJECT RELATION MAPPING
	public function DefineRelationMap()
	{
		return(array(
			"id" => "ID",
			"username" => "UserName",
			"password" => "Password",
			"category" => "Category",
			"registered_on" => "RegisteredOn"
		));
	}

}// endof class
?>