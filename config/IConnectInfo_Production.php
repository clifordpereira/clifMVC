<?php 
/**
 * Database connection configuration for production
 */
interface IConnectInfo
{
	const HOST = "localhost";
	const UNAME = "dbuser";
	const PW = "dbpassword";
	const DBNAME = "database";

	public static function doConnect();
}
?>