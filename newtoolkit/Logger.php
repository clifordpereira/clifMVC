<?php 
// individual logger class is included in the register method
/**
* 
*/
class Logger
{
	private $hLogFile;
	private $logLevel;

	// Log Levels. The higher the number, the less severe the message
	// Gaps are left in the numbering to allow for other levels
	const DEBUG 	= 100;
	const INFO 		= 75;
	const NOTICE 	= 50;
	const WARNING 	= 25;
	const ERROR 	= 10;
	const CRITICAL 	= 5;
	

	// Class uses the singleton pattern
	function __construct()
	{
		# code...
	}


	public static function register($logName, $connectionString)
	{
		$urlData = parse_url($connectionString);

		if (! isset($urlData['scheme'])) {
			throw new Exception("Invalid log connection string $connectionString");
		}

		@include_once('Logger/class.' . $urlData['scheme'] . 'LoggerBackend.php');

		$className = $urlData['scheme'] . 'LoggerBackend';

		if (! class_exists($className)) {
			throw new Exception("No logging backend available for " . $urlData['scheme']);			
		}

		$objBack = new $className($urlData);

		Logger::manageBackends($logName, $objBack);
	}//endof register()


	public static function getInstance($name)
	{
		return Logger::manageBackends($name);
	}


	private static function manageBackends($name, LoggerBackend $objBack = null)
	{
		static $backEnds;

		if (! isset($backEnds)) {
			$backEnds = array();
		}

		if ($objBack == null) {
			// we must be retrieving
			if (isset($backEnds[$name])) {
				return $backEnds[$name];
			} else {
				throw new Exception("The specified backend $name was not registered with Logger");
			}
		} else {
			$backEnds[$name] = $objBack;
		}
	}//endof manageBackends()


	public static function levelToString($logLevel)
	{
		switch ($logLevel) {
			case Logger::DEBUG:
				return 'Logger::DEBUG';
				break;
			
			case Logger::INFO:
				return 'Logger::INFO';
				break;
			
			case Logger::NOTICE:
				return 'Logger::NOTICE';
				break;
			
			case Logger::WARNING:
				return 'Logger::WARNING';
				break;
			
			case Logger::ERROR:
				return 'Logger::ERROR';
				break;
			
			case Logger::CRITICAL:
				return 'Logger::CRITICAL';
				break;
			
			default:
				return '[unknown]';
				break;
		}
	}//endof levelToString()

}//endof class
?>