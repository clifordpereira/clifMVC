<?php 
/**
* 
*/
abstract class Controller
{
  	protected $objModel;
  	protected $objPDO;

  	public function __construct()
  	{
  		$this->DefineModelName(); // implemented in child controller
  		$this->objPDO = UniversalConnect::doConnect();
  		$this->setModel();
  	}


  	////////////// <PRIVATE METHODS //////////////

  	// 
	protected function DefineModelName()
    {
    	$thisclassname = get_class($this);
		$n = strrpos($thisclassname, "Controller"); // strRpos for last occurence of controller 
		$tmpStr = substr($thisclassname, 0, $n);
		return $this->remove_last_s($tmpStr);
    }	

  	// SET THE MODEL FOR THIS CONTROLLER
    private function setModel()
    {
      $modelname = $this->DefineModelName();
      $this->objModel = new $modelname($this->objPDO);
    }

    // CLEAN ARRAY
	private function clean_array($array)
	{
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$cleanedArray[$key] = $this->clean_array($value);
			} else {
				$cleanedArray[$key] = $this->clean_input($value);
			}
		}
		return $cleanedArray;
	}

	// CLEAN INPUT DATA
	private function clean_input($data)
	{
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	// <remove_last_s
	protected function remove_last_s($string)
	{
		if (substr($string, (strlen($string) - 1)) == 's') {
			return substr($string, 0, (strlen($string) - 1));
		} else {
			return $string;
		}
	}//endof remove_last_s()
	// remove_last_s>

    ////////////// PRIVATE METHODS> //////////////



	///////////// <PROTECTED METHODS ////////////////
	// Meant to be called in child controller only

	// RETURN THE ONLY ARGUMENT FROM THE URL
	protected function getArgument()
	{
		$argument = empty($GLOBALS['argument'])? null : $GLOBALS['argument'];
		return $this->clean_input($argument);
	}

	// RETURN AN ARRAY OF ARGUMENTS
	protected function getArguments()
	{
		# code...
	}

	// get the model associated with the id from url
    protected function loadModel()
    {
      $id = $this->getArgument();
      $model = $this->DefineModelName();
      return new $model($this->objPDO, $id);
    }

    // get the child model associated with the id from the url
    // mostly used to delete the child
    protected function loadChildModel()
    {
      $id = $this->getArgument();
      $childname = $this->objModel->DefineChildName();
      return new $childname($this->objPDO, $id);
    }

	// load corresponding model (and its child if any) from the database 
	protected function loadModelFromDB($parent_column = null)
	{
		$id = $this->getArgument();

		$return_models = array();

		if (!empty($parent_column) && $this->objModel->hasChildren()) {
		  $children = $this->objModel->getChildren($parent_column, $id); // for obtaining sales
		  $return_models['children'] = $children;
		}

		// for loading model
		$parentname = $this->DefineModelName();
		$tableview = $this->objModel->DefineTableName() . "_view"; 
		$parent = $parentname::find($tableview, $id); // for obtaining salesinvoice  

		$return_models['parent'] = $parent;

		return $return_models; 
	}//endof loadModelInView()


    // delete the associated model
    protected function delete()
    {
      $obj = $this->loadModel();
      $obj->MarkForDeletion();
      $this->redirectback();
      echo $this->success_message("success", "Successfully deleted");
    }

    // delete the associated child model
    protected function deletechild()
    {
      $obj = $this->loadChildModel();
      $obj->MarkForDeletion();
      $this->redirectback();
      echo $this->success_message("success", "Successfully deleted");
    }

	// RETURN CLEANED ARRAY OF POSTED VARIABLES
	protected function getPostedVariabes()
	{
		return $this->clean_array($_POST);
	}


	// passed
	protected function redirectback()
	{
		echo '<script type="text/javascript">';
		echo 'history.back()';
		echo '</script>';
	}

	// not tested
	protected function success_message($alert_type, $message)
	{	
		$success_message = '<div class="alert alert-' . $alert_type . '">';
		$success_message .= '<strong>' . $message . '</strong>';
		$success_message .= '</div>';
		return $success_message;
	}

	// not used yet
	protected function MysqltoIndianDate($date)
	{
		$temp_date = $date;
		$temp_array = explode("-", $temp_date);
		$temp_array = array_reverse($temp_array);
		$return_date = implode("/", $temp_array);

		return $return_date;
	}

	// not tested
	protected function redirectto($url)
	{
		echo '<script type="text/javascript">';
		echo   ' location.href = "$url" ';
		echo '</script>';
	}

	///////////// <PROTECTED METHODS ////////////////


}//endof Controller{}
?>