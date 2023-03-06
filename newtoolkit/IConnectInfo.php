<?php 
/**
 * 
 */
interface IConnectInfo
{
	const HOST = "localhost";
	const UNAME = "root";
	const PW = "";
	const DBNAME = "test";

	public static function doConnect();
}
?>