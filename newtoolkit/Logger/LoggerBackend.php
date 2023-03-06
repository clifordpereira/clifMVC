<?php 
/**
* 
*/
abstract class LoggerBackend
{
	protected $urlData;

	// 
	function __construct($urlData)
	{
		$this->urlData = $urlData;
	}

	abstract function logMessage($message, $logLevel = Logger::INFO, $module);

}//endof class
?>