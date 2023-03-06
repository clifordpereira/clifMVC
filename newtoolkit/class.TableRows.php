<?php 
/**
 * 
 */
class TableRows extends RecursiveIteratorIterator
{
	
	function __construct($it)
	{
		parent::__construct($it, self::LEAVES_ONLY);
	}

	function current()
	{
		return "<td style='border:1px solid black;'>" . parent::current() . "</td>";
	}

	function beginChildren()
	{
		echo "<tr>";
	}

	function endChildren()
	{
		echo "<tr>" . "\n";
	}
}// endof class
?>

<!--
<table style="border: solid 1px black;">
	
	<tr><th>Id</th><th>First Name</th><th>Last Name</th><th>FullName </th><th>Email</th><th>Work Permit Sponsor</th><th>Visa Sponsor</th><th>Company</th></tr>

<?php
	/* Sample Implementation
	foreach (new TableRows(new RecursiveArrayIterator($objStatement->fetchAll())) as $key => $value) {
		echo $value;
	}
	*/
?>

</table>
-->

<?php 
// TRYING USING THIS
/*
$resultArray = $objStatement->fetchAll();
$rItIt = new TableRows(new RecursiveArrayIterator($resultArray));
*/
?>