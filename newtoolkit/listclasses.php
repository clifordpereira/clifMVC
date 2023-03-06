<?php 
// lists  all classes and interfaces declared for API documentation
require_once('Documenter.php');
require_once('./utilities/CP_ClassTree.php');

// getting class from url
$classname = @$_GET['class'];
if (!isset($classname)) {
	$classname = current(get_declared_classes());
}

echo '<h1 style="background-color:#fff;" align="center">CLASS API</h1>';

// INDUVIDUAL CLASS API
try {
	$class = new Documenter($classname);

	// PRINT CLASS HEADER
	echo "<p> PHP version: <b>" . phpversion() . "</b><br />";
	echo "Date: " . date("d/m/Y") . "<br />";
	echo "<h2>Name: " . $class->getName() . "</h2> \n";
	echo "<h3> Type: " . $class->getClassType() . "</h3>\n";
	echo $class->getDocComment() . "</p> \n";
	echo "<span class=\"fulldescription\">" . $class->getFullDescription() . "</span><br><br> \n";

	// PRINT PROPERTIES AND METHODS
	$class->printProperties();
	$class->printMethods();

} catch (Exception $e) {
	echo $e->getMessage();
}

echo "<hr>";



/**
* DISPLAY INTERFACES CLASSES AND TRAITS INDIVIDUALLY
*/

echo '<center><h3 style="background-color:#fff;">List of All Declared Classes & Interfaces</h3></center>';

$thisfile = $_SERVER['PHP_SELF'];

// DISPLAY INTERFACES
echo "INTERFACES <br>";
$arDeclared_interfaces = get_declared_interfaces();
natcasesort($arDeclared_interfaces);

CP_ClassTree::print_class_tree($arDeclared_interfaces);
echo "<br>";


// DISPLAY CLASSES
echo "CLASSES <br>";
$arDeclared_classes = get_declared_classes();
natcasesort($arDeclared_classes);

CP_ClassTree::print_class_tree($arDeclared_classes);
echo "<br>";

// DISPLAY TRAITS
echo "TRAITS <br>";
$arDeclared_traits = get_declared_traits();
natcasesort($arDeclared_traits);

CP_ClassTree::print_class_tree($arDeclared_traits);

?>
