<?php 
/**
* Universal Database Connection class
*/
class UniversalConnect implements IConnectInfo
{
	private static $server = IConnectInfo::HOST;
	private static $currentDB = IConnectInfo::DBNAME;
	private static $user = IConnectInfo::UNAME;
	private static $pass = IConnectInfo::PW;

	private static $hookup;

    private function __construct() {}

    private function __clone() {}

    // singleton pattern is avoided here because it can act like global variables
	public static function doConnect()
	{
		$dbname = self::$currentDB;
		$strDSN = "mysql:host=localhost;dbname=$dbname";

		try {
			// if (!isset(self::$hookup)) {} // singleton pattern avoided purposefully
			self::$hookup = new PDO($strDSN, self::$user, self::$pass, array());
			self::$hookup->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			# try db-error logging into some file
			echo "Here is why it failed: " . $e->getMessage();
		}//end of try-catch

		return self::$hookup;

	}//endof dbconn()

}//endof UniversalConnect{}

?>