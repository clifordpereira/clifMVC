<?php

// database connection information file
define("IConnectInfo", "IConnectInfo_" . _ENVIRONMENT_);

/* MOSTLY NO NEED TO CHANGE BELOW CODES */
//ROOT FOLDER
define('_ROOT_DIR_', $_SERVER["DOCUMENT_ROOT"] . "/" . _PROJECT_FOLDER_);
define('_ROOT_URL_', '/' . _PROJECT_FOLDER_);
define('ABSPATH', _ROOT_URL_); // synonym for _ROOT_URL_
//THEME NAME
define('_THEME_DIR_', _ROOT_DIR_ . '/themes' . "/" . _THEME_NAME_);
define('_THEME_URL_', '/' . _PROJECT_FOLDER_ . "/themes/" . _THEME_NAME_);


$nav = _THEME_DIR_ . "/includes/nav.inc.php"; // navigation menus
$header = _THEME_DIR_ . "/includes/header.inc.php"; // sub heading needed for each page
$footer = _THEME_DIR_ . "/includes/footer.inc.php"; // copyright info and so

?>
