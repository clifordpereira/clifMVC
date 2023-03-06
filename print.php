<?php

// <CLIENT PROGRAMMER CHANGE THIS FILE CONTENTS
require_once('config/config.php'); // general configuration for each sites
require_once('config/settings.php'); // rarely needs to edit this file
require_once('config/routes.php'); // access privileged routes for each type of user
// CLIENT PROGRAMMER CHANGE THIS>

require_once('core.php'); // don't worry about this file. it is the engine for this mvc

require_once(_THEME_DIR_ . "/invoice_template.tpl.php");
?>