<?php $title = "Al Saj Hotel"; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <?php echo '<link href="' . _ROOT_URL_ . '/css/bootstrap.min.css" rel="stylesheet">'; ?>
    <!-- jquery ui -->
    <?php echo '<link href="' . _ROOT_URL_ . '/css/jquery-ui.css" rel="stylesheet">'; ?>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->  

    <!-- put for datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
  </head>
  <body>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php echo '<script src="' . _ROOT_URL_ . '/js/jquery-3.4.1.min.js"></script>'; ?>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php echo '<script src="' . _ROOT_URL_ . '/js/jquery-ui.js"></script>'; ?>
    
    <div class="container"> 
      <div class="jumbotron" id="siteheader">
        <h1><?php echo "<i> " . _SITE_NAME_ . "</i>"; ?></h1>
        <!-- <img src="images/banner.jpg"> -->
      </div>

      <?php require_once($nav); ?>

      <?php require_once($page); ?>
    </div>

    <!-- Bootstrap -->
    <?php echo '<script src="' . _ROOT_URL_ . '/js/bootstrap.min.js"></script>'; ?>
  </body>
</html>