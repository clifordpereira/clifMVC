<?php
//<NO CHANGE ON BELOW CODES
require_once('config/' . IConnectInfo . '.php'); // database connection info file. IConnectInfo is defined in settings.php
require_once('newtoolkit/UniversalConnect.php');
require_once('newtoolkit/databoundobject.php');
require_once('newtoolkit/clif.Model.php');
require_once('newtoolkit/clif.Controller.php');
 

// <GET CONTROLLER & ACTION from url
if (!empty($_SERVER['PATH_INFO'])) {
	$path_array = explode('/', substr($_SERVER['PATH_INFO'], 1));
	$controller = !empty($path_array[0]) ? $path_array[0] : "pages";
	$action = !empty($path_array[1]) ? $path_array[1] : "index";
	$GLOBALS['argument'] = !empty($path_array[2]) ? $path_array[2] : "";
} else {
	$controller = "pages";
	// $action = "index"; // change to this later
	$action = "home";
}
// GET CONTROLLER & ACTION>


// <GET PAGE using the got controller and action
// only permitted routes for the corresponding user/ admin are allowed
// routes array is in routes.php
function route($routes, $controller, $action)
{
	if (array_key_exists($controller, $routes)) {
		if (in_array($action, $routes[$controller])) {
			get_page($controller, $action);
		} else {
			get_page('pages', 'error');
		}
	} else {
		get_page('pages', 'error');
	}
}//endof route()

// DISPATCHER
function get_page($controller, $action) {
	require_once('controllers/' . $controller . '_controller.php');

	$name = ucfirst($controller) . "Controller";

	$controller = new $name();

	call_user_func(array($controller, $action));
}//endof get_page()
// GET PAGE>


// <AUTOLOAD
/*
__autoload($class) {
	require_once('models/' . $class . 'php');
}
*/
// AUTOLOAD>



?>