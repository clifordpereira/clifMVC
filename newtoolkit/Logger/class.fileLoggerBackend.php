<?php 

require_once("LoggerBackend.php");
// require_once("Config.php"); // this should be placed in the client code

/**
* 
*/
class fileLoggerBackend extends LoggerBackend
{
	private $logLevel;
	private $hLogFile;

	function __construct($urlData)
	{
		parent::__construct($urlData);

		$this->logLevel = Config::getConfig('LOGGER_LEVEL');

		$logFilePath = $this->urlData['path']; // parent constructor does $this->urlData = $urlData;

		if (! strlen($logFilePath)) {
			throw new Exception("No log file path was specified in the connection string");
		}

		print "Logging data to $logFilePath";

		// Open a handle to the log file. Suppress PHP error messages.
		// Deal with those by throwing an exception.
		$this->hLogFile = @fopen($logFilePath, 'a+');

		if (! is_resource($this->hLogFile)) {
			throw new Exception("The specified log file $logFilePath could not be opened or created for writing. check file permissions " . $logFilePath);
		}

		// set encoding type to ISO-8859-1
		// stream_encoding($this->hLogFile, 'iso-8859-1');

	}//endof __construct()


	public function logMessage($msg, $logLevel = LOGGER_INFO, $module = null)
	{
		if ($logLevel > $this->logLevel) {
			return;
		}

		// date_default_timezone_set('America/New_York');
		$time = strftime('%x %X', time());
		$msg = str_replace("\t", '    ', $msg);
		$msg = str_replace("\n", ' ', $msg);

		$strLogLevel = Logger::levelToString($logLevel);

		if (isset($module)) {
			$module = str_replace("\t", '    ', $module);
			$module = str_replace("\n", ' ', $module);
		}

		// logs: date/time loglevel message modulename
		// separated by tabs, new line delimited
		$logLine = "$time\t$strLogLevel\t$msg\t$module\n\r";
		fwrite($this->hLogFile, $logLine);
	}//endof logMessage()

}//endof 
?>