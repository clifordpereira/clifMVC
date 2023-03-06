<?php 
/**
* 
*/
class Config
{
	private static $cfg = array();

	// empty constructor not meant to instantiate
	function __construct() { }

	public static function addConfig($key, $value)
	{
		self::$cfg[$key] = $value;
	}

	public static function getConfig($key)
	{
		if (isset(self::$cfg[$key])) {
			return self::$cfg[$key];
		} else {
			throw new Exception("$key not defined in config");			
		}

	}//endof getConfig()

}//endof class
?>