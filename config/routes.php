<?php
  // routes registered here are only allowed to be accessed through url by corresponding user
  $routes = array(
    'pages' => array('index', 'home', 'error', 'unauthorised'),
    'posts' => array('index', 'show'),
    'users' => array('index', 'show', 'register', 'listall')
  );


  $admin_routes = array(
    'pages' => array('index', 'home', 'error', 'unauthorised'),
    'posts' => array('index', 'show'),
    'users' => array('index', 'show', 'register', 'listall')
  );


  $site_admin_routes = array(
    'pages' => array('index', 'home', 'error', 'unauthorised'),
    'posts' => array('index', 'show'),
    'users' => array('index', 'show', 'register', 'listall')
  );

?>

<?php 
//MENUS

  // TOP NAVIGATION BAR
  $navbar_menus = array();
  $navbar_menus['Posts'] = _ROOT_URL_ . "/index.php/posts";
  $navbar_menus['Users'] = _ROOT_URL_ . "/index.php/users";
  $navbar_menus['Pages'] = _ROOT_URL_ . "/index.php/pages";

  // SIDE-BAR NAVIGATION
  $sidebar_menus = array();
  $sidebar_menus['Dashboard'] = "pages/dashboard";
  $sidebar_menus['Invoice'] = array();
    // SUB SIDE-BAR
    $sidebar_menus['Invoice']['Print Invoice'] = "invoices/print";
    $sidebar_menus['Invoice']['Edit Invoice'] = "invoices/edit";
    $sidebar_menus['Invoice']['Edit Item'] = "items/edit";
  $sidebar_menus['Products'] = "products";
  $sidebar_menus['Customers'] = "customers";
  $sidebar_menus['Reports'] = "reports";
  $sidebar_menus['Settings'] = "settings";

?>