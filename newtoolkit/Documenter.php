<?php 
/** <br>
* Class for documentation purposes <br>
* @author: Cliford Pereira <br>
*/
class Documenter extends ReflectionClass
{
	
	function __construct($name)
	{
		parent::__construct($name);
		$this->createDataMembersArray();
		$this->createMethodsArray();
	}//endof __construct()

	// SIGNATURE OF CLASS
	public function getFullDescription()
	{
		$description = "";

		if ($this->isFinal()) {
			$description .= "final ";
		}

		if ($this->isAbstract()) {
			$description .= "abstract ";
		}

		if ($this->isInterface()) {
			$description .= "interface ";
		}

		$description .= $this->name . " ";

		if ($this->getParentClass()) {
			$parentName = $this->getParentClass()->getName();			
			$description .= "extends $parentName ";
		}

		$interfaces = $this->getInterfaces();
		$num_interfaces = count($interfaces);

		if ($num_interfaces > 0) {
			$description .= "implements ";

			$counter = 0;
			foreach ($interfaces as $currentInterface) {
				$description .= $currentInterface->getName();
				$counter++;
				if ($counter != $num_interfaces) {
					$description .= ", ";
				}
			}//endof foreach ()

		}//endof if ()

		return $description;

	}//endof getFullDescription()


	// DATAMEMBERS ARRAY
	private function createDataMembersArray()
	{
		$properties = $this->getProperties();

		//ReflectionProperty array returned
		foreach ($properties as $currentProperty) {
			$currentPropertyName = $currentProperty->getName();

			if ($currentProperty->isPublic()) {
				$this->publicproperties[$currentPropertyName] = $currentProperty;
			}

			if ($currentProperty->isProtected()) {
				$this->protectedproperties[$currentPropertyName] = $currentProperty;
			}

			if ($currentProperty->isPrivate()) {
				$this->privateproperties[$currentPropertyName] = $currentProperty;
			}

		}//endof foreach ()

	}//endof createDataMembersArray()


	// METHODS ARRAY
	private function createMethodsArray()
	{
		$methods = $this->getMethods();

		//ReflectionMethod array returned
		foreach ($methods as $currentMethod) {
			$currentMethodName = $currentMethod->getName();

			if ($currentMethod->isPublic()) {
				$this->publicmethods[$currentMethodName] = $currentMethod;
			}

			if ($currentMethod->isProtected()) {
				$this->protectedmethods[$currentMethodName] = $currentMethod;
			}

			if ($currentMethod->isPrivate()) {
				$this->privatemethods[$currentMethodName] = $currentMethod;
			}

		}//endof foreach ()

	}//endof createMethodsArrays()


	// ACCESS MODIFIERS
	// public function getModifiers($r) // $r as parameter is throwing exception
	public function getModifiers()
	{
		if ($r instanceof ReflectionMethod || $r instanceof ReflectionProperty) {
			$arR = Reflection::getModifierNames($r->getModifiers());
			$description = implode(" ", $arR);
		} else {
			throw new Exception("Must be ReflectionMethod or ReflectionProperty", 1);			
		}
		return $description;
	}//endof getModifiers()


	// CODES ADDED BY CLIFORD

	// PRINT PROPERTIES
	public function printProperties()
	{
		if (isset($this->privateproperties)) {
			foreach ($this->privateproperties as $privateproperty) {
				echo "$privateproperty <br>";
			}
			echo "<br>";
		}

		if (isset($this->protectedproperties)) {
			foreach ($this->protectedproperties as $protectedproperty) {
				echo "$protectedproperty <br>";
			}
			echo "<br>";
		}

		if (isset($this->publicproperties)) {
			foreach ($this->publicproperties as $publicproperty) {
				echo "$publicproperty <br>";
			}
			echo "<br>";
		}

	}//endof printProperties()


	// PRINT METHODS
	public function printMethods()
	{
		if (isset($this->privatemethods )) {
			foreach ($this->privatemethods as $privatemethod) {
				echo "$privatemethod <br>";
			}
			echo "<br>";
		}

		if (isset($this->protectedmethods)) {
			foreach ($this->protectedmethods as $protectedmethod) {
				echo "$protectedmethod <br>";
			}
			echo "<br>";
		}

		if (isset($this->publicmethods)) {
			foreach ($this->publicmethods as $publicmethod) {
				echo "$publicmethod <br>";
			}
			echo "<br>";
		}
	}//endof printMethods()

	public function getClassType()
	{
		if ($this->isInterface()) {
			return "Interface";
		} elseif ($this->isTrait()) {
			return "Trait";
		} else {
			return "Class";
		}
	}//endof getClassType()

}//endof Documenter{}
?>