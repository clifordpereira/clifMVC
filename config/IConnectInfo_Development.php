<?php 
/**
 * Database connection configuration for local development
 */
interface IConnectInfo
{
	const HOST = "localhost";
	const UNAME = "root";
	const PW = "";
	const DBNAME = "clif_mvc";

	public static function doConnect();
}
?>