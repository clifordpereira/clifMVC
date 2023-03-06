<?php 
/**
* 
*/
class HTTPSession
{
	private $php_session_id;
	private $native_session_id;
	private $dbhandle;
	private $logged_in;
	private $user_id;
	private $session_timeout = 600; // 10 minute inactivity timeout
	private $session_lifespan = 3600; // 1 hour session duration

	function __construct()
	{
		// connect to database
		$this->dbhandle = mysqli_connect("localhost", "root", "", "test");

		if (! ($this->dbhandle)) {
			throw new Exception("Unable to connect to the database");
		} 

		// setup handle
		session_set_save_handler(
			array($this, '_session_open_method'), 
			array($this, '_session_close_method'), 
			array($this, '_session_read_method'), 
			array($this, '_session_write_method'), 
			array($this, '_session_destroy_method'), 
			array($this, '_session_gc_method')
		);

		$strUserAgent = $_SERVER['HTTP_USER_AGENT'];
		if ($_COOKIE['PHPSESSID']) {
			$this->php_session_id = $_COOKIE['PHPSESSID'];
			// $stmt tested and correct
			$stmt = "SELECT id FROM http_session
					WHERE ascii_session_id = '$this->php_session_id' 
					AND ((now() - created) < '$this->session_lifespan seconds') 
					AND user_agent = '$strUserAgent' 
					AND ((now() - last_impression) <= '$this->session_timeout seconds' OR last_impression IS NULL)"; 

			$result = mysqli_query($this->dbhandle, $stmt); 

			// if (mysqli_num_rows($result) == 0) {
			if (!$result) {
				$failed = 1;
				// garbage cleanup from database
				$maxlifetime = $this->session_lifespan;
				// $stmt tested and working
				$stmt = "DELETE FROM http_session 
						WHERE ascii_session_id = '$this->php_session_id' 
						OR (now() - created) > '$maxlifetime seconds'"; 
				$result = mysqli_query($this->dbhandle, $stmt); 

				// clean up stray session variables
				// $stmt tested and working
				$stmt = "DELETE FROM session_variable 
							WHERE session_id NOT IN (SELECT id FROM http_session)";
				$result = mysqli_query($this->dbhandle, $stmt); 

				unset($_COOKIE['PHPSESSID']);
			}//endif (mysqli_num_rows($result) == 0)

		}//endif ($_COOKIE['PHPSESSID'])

		session_set_cookie_params($this->session_lifespan);
		session_start();
	
	}//endof __construct

	public function Impress()
	{
		if ($this->native_session_id) {
			// $stmt tested and working
			$stmt = "UPDATE http_session 
					SET last_impression = now() 
					WHERE id = $this->native_session_id ";
			$result = mysqli_query($this->dbhandle, $stmt);
		}//endif 
	}//endof Impress()


	public function IsLoggedIn()
	{
		return($this->logged_in);
	}//endofIsLoggedIn()


	public function GetUserID()
	{
		if ($this->logged_in) {
			return($this->user_id);
		} else {
			return false;
		}
	}//endof getUserID()

	# to correct this
	public function GetUserObject()
	{
		if ($this->logged_in) {
			if (class_exists("user")) {
				$objUser = new User($this->handle, $this->user_id);
				return($objUser);
			} else {
				return false;
			}
		}
	}//endof GetUserObject()


	public function GetSessionIdentifier()
	{
		return($this->php_session_id);
	}//endof GetSessionIdentifier()


	public function Login($strUserName, $strPlainPassword)
	{
		// $strMD5Password = md5($strPlainPassword);
		// $stmt tested and working
		$strMD5Password = $strPlainPassword;
		$stmt = "SELECT id
				FROM users
				WHERE username = '$strUserName'
				AND md5_pw = '$strMD5Password' ";
		$result = mysqli_query($this->dbhandle, $stmt);

		// if (mysqli_num_rows($result) > 0) {
		if ($result) {
			$row = mysqli_fetch_array($result);
			$this->user_id = $row['id'];
			$this->logged_in = true;

			// $stmt tested and working
			$stmt = "UPDATE http_session
					SET logged_in = 't', user_id = $this->user_id
					WHERE id = $this->native_session_id";
			$result = mysqli_query($this->dbhandle, $stmt);

			return true;
		} else {
			return false;
		}//endif-else

	}//endof Login()


	public function Logout()
	{
		if ($this->logged_in == true) {
			// $stmt tested and working
			$stmt = "UPDATE http_session
					SET logged_in = 'f', user_id = 0
					WHERE id = $this->native_session_id";
			$result = mysqli_query($this->dbhandle, $stmt);

			$this->logged_in = false;
			$this->user_id = 0;
			return(true);
		} else {
			return(false);
		}
	}//endof Logout()


	public function __get($nm)
	{
		$stmt = "SELECT variable_value 
				FROM session_variable 
				WHERE session_id = $this->native_session_id AND variable_name = '$nm' ";
		$result = mysqli_query($this->dbhandle, $stmt);
		if ($result) {
			$row = mysqli_fetch_array($result);
			return(unserialize($row['variable_value']));
		} else {
			return false;
		}
	}//endof of __get()

	public function __set($nm, $val)
	{
		$strSer = serialize($val);
		$stmt = "INSERT INTO session_variable(session_id, variable_name, variable_value)
				VALUES ($this->native_session_id, '$nm', '$strSer')";
		$result = mysqli_query($this->dbhandle, $stmt);
	}


	private function _session_open_method($save_path, $session_name)
	{
		// do nothing
		return(true);
	}


	public function _session_close_method()
	{
		mysqli_close($this->dbhandle);
		return(true);
	}


	private function _session_read_method($id)
	{	
		$strUserAgent = $_SERVER['HTTP_USER_AGENT'];
		$this->php_session_id = $id;

		$failed = 1;

		// see if this id exists in db
		$stmt = "SELECT id, logged_in, user_id 
				FROM http_session
				WHERE ascii_session_id = '$id' ";
		$result = mysqli_query($this->dbhandle, $stmt);

		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_array($result);
			$this->native_session_id = $row['id'];
			if ($row['logged_in'] == 't') {
				$this->logged_in = true;
				$this->user_id = $row['user_id'];
			} else {
				$this->logged_in = false;
			}
		} else {
			$this->logged_in = false;
			$stmt = "INSERT INTO http_session 
									(ascii_session_id, logged_in, user_id, created, user_agent) 
									VALUES 
									('$id', 'f', 0, now(), '$strUserAgent')";
			$result = mysqli_query($this->dbhandle, $stmt);			
			
			$result = mysqli_query($this->dbhandle, "SELECT id FROM http_session WHERE ascii_session_id = '$id' ");
			$row = mysqli_fetch_array($result);
			$this->native_session_id = $row['id'];			
		}//endif-else

		// just return empty string
		return "";

	}//endof _session_read_method()


	public function _session_write_method($id, $sess_data)
	{
		return(true);
	}


	private function _session_destroy_method($id)
	{
		$result = mysqli_query($this->dbhandle, "DELETE FROM \"http_session\" WHERE ascii_session_id = '$id' ");
		return(true);
	}


	private function _session_gc_method($maxlifetime)
	{
		return(true);
	}


}//endof HTTPSession{}
?>