<?php 
require_once 'Config.php';

define('DEBUG_INFO', '100');
define('DEBUG_SQL', '75');
define('DEBUG_WARNING', '50');
define('DEBUG_ERROR', '25');
define('DEBUG_CRITICAL', '10');

session_start();

/**
* To debugg while developmet or maintanence or even testing
*/
class Debugger
{
	
	public static function debug($data, $key = null, $debugLevel = DEBUG_INFO)
	{
		if (! isset($_SESSION['debugData'])) {
			$_SESSION['debugData'] = array();
		}

		if ($debugLevel <= Config::getConfig('DEBUG_LEVEL')) {
			$_SESSION['debugData'][$key] = $data;
		}

	}//endof debug()

	public static function debugPrint()
	{
		$arDebugData = $_SESSION['debugData'];
		print Debugger::printArray($arDebugData);

		$_SESSION['debugData'] = array();
	}

	public static function printArray($var, $title=true)
	{
		/*
		* <REMOVE HEADER
		* @addedby CP
		* if there isn't any value in debugginArray return without printing the headers
		*/
		if (empty($var)) {
			return;
		}
		// REMOVE HEADER>		

		// print debug table
		$string = '<table border="1">';
		if ($title) {
			// print headers (key, value)
			$string .= "<tr><td><b>Key</b></td><td><b>Value</b></td></tr>\n";
		}

		if (is_array($var)) {
			foreach ($var as $key => $value) {
				$string .= "<tr>\n";
				$string .= "<td><b>$key</b></td><td>";

				if (is_array($value)) {
					$string .= Debugger::printArray($value, false);
				} elseif(gettype($value) == 'object') {
					$string .= "Object of class " . get_class($value);
				} else {
					$string .= "$value";
				}

				$string .= "</td></tr>\n";
			}//endof foreach
		}//endof if

		$string .= "</table>\n";
		return $string;

	}//endof printArray()

}//endof class
?>