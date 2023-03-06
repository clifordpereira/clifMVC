<?php 
// require_once("Config.php"); // this should be placed in the client code
require_once("LoggerBackend.php"); // abstract class

/**
* 
*/
class mysqlLoggerBackend extends LoggerBackend
{
	private $logLevel;
	private $hConn;
	private $table = 'logdata';
	private $messageField = 'message';
	private $logLevelField = 'loglevel';
	private $timestampField = 'logdate';
	private $moduleField = 'module';

	function __construct($urlData)
	{
		parent::__construct($urlData);

		$this->logLevel = Config::getConfig('LOGGER_LEVEL');

		$host = $urlData['host'];
		$port = $urlData['port'];
		$user = $urlData['user'];
		$password = $urlData['pass'];
		$arPath = explode('/', $urlData['path']);
		$database = $arPath[1];

		if (! strlen($database)) {
			throw new Exception("mysqlLoggerBackend: Invalid connection string. No Database name was specified");
		}

		// <FORPGSQL
		/*
		$connstr = '';
		if ($host) {
			$connstr .= "host=$host ";
		}

		if ($port) {
			$connstr .= "port=$port ";
		}

		if ($user) {
			$connstr .= "user=$user ";
		}

		if ($password) {
			$connstr .= "password=$password ";
		}

		$connstr .= "dbname=$database";
		*/
		// FORPGSQL>


		print "Logging data to the database: $database";

		// suppress native errors. we'll handle them with and exception
		// $this->hConn = mysqli_connect($host, $user, $password, $database);
		$this->hConn = mysqli_connect("localhost", "root", "", "test");

		if (! ($this->hConn)) {
			throw new Exception("Unable to connect to the database");
		}


		$queryData = $urlData['query'];
		if (strlen($queryData)) {
			$arTmpQuery = explode('&', $queryData);

			$arQuery = array();
			foreach ($arTmpQuery as $queryItem) {
				$arQueryItem = explode('=', $queryItem);
				$arQuery[urldecode($arQueryItem[0])] = urldecode($arQueryItem[1]);
			}
		}

		
		// below code is just a convenience, not mandatory
		if (isset($arQuery['table'])) {
			$this->table = $arQuery['table'];
		}

		if (isset($arQuery['messageField'])) {
			$this->messageField = $arQuery['messageField'];
		}

		if (isset($arQuery['logLevelField'])) {
			$this->logLevelField = $arQuery['logLevelField'];
		}
		
		if (isset($arQuery['timestampField'])) {
			$this->timestampField = $arQuery['timestampField'];
		}
		
		if (isset($arQuery['moduleField'])) {
			$this->moduleField = $arQuery['moduleField'];
		}

	}//endof __construct()


	public function logMessage($msg, $logLevel = LOGGER::INFO, $module = null)
	{
		if ($logLevel <= $this->logLevel) {

			$strLogLevel = Logger::levelToString($logLevel);

			$msg = mysqli_escape_string($this->hConn, $msg);

			if (isset($module)) {
				$module = "'" . mysqli_escape_string($this->hConn, $module) . "'";
			} else {
				$module = 'NULL';
			}

			$arFields = array();
			$arFields[$this->messageField] = "'" . mysqli_escape_string($this->hConn, $msg) . "'";
			$arFields[$this->logLevelField] = mysqli_escape_string($this->hConn, $logLevel);
			$arFields[$this->timestampField] = "CURRENT_TIMESTAMP";
			$arFields[$this->moduleField] = $module;

			$sql = 'INSERT INTO ' . $this->table;
			$sql .= ' (' . join(', ', array_keys($arFields)) . ')';
			$sql .= ' VALUES (' . join(', ', array_values($arFields)) . ')';

			$this->hConn->query($sql);

		}//endof if()

	}//endof logMessage()

}//endof 
?>