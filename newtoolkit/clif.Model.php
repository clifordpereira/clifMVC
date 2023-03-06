<?php 
/**
* Abstract-like Model 
* cannot be made abstract because of the need for calling it's methods statically
*/
class Model extends DataBoundObject
{
  protected $objChild;

  // defining empty functions. to be implemented in child classes
	protected function DefineTableName() {}
	protected function DefineRelationMap() {}


  ///////////// <PRIVATE METHODS ///////////////
  // meant to be used in this class only

  // 
  private function setChild()
  {
    $child_name = $this->DefineChildName();
    $this->objChild = new $child_name($this->objPDO);
  }

  ///////////// PRIVATE METHODS> ///////////////



  ///////////// <PUBLIC METHODS ///////////////
  //  MEANT TO BE USED BY CONTROLLER

  public function hasChildren()
  {
    if (!empty($this->DefineChildName())) {
      return true;
    }
  }

  // partially passed
  public function getChildren($parent_column, $parent_id)
  {
    $this->setChild();

    $child_table = $this->objChild->strTableName . "_view";

    $sql = "SELECT * FROM $child_table WHERE $parent_column = $parent_id";
    $stmt = $this->objPDO->query($sql); 

    $thisClassName = get_class($this->objChild);
    $list = array();
    while ($row = $stmt->fetchObject($thisClassName, array($this->objPDO))) {
      $list[] = $row;
    }

    return $list;
  }//endof getChildren()

  ///////////// PUBLIC METHODS> ///////////////



  ///////////// <STATIC FUCNTIONS ///////////////
  // used/ called in controller statically

  # when integrating with adminlte how should this be changed 
  public static function all($tablename) {
    $objPDO = UniversalConnect::doConnect();
    $stmt = $objPDO->query("SELECT * FROM $tablename ORDER BY id DESC");

    $list = array();
    while ($row = $stmt->fetchObject()) {
      $list[] = $row;
    }
    return $list;
  }//endof all()


  public static function find($tablename, $id) {
    $objPDO = UniversalConnect::doConnect();
    $stmt = $objPDO->query("SELECT * FROM $tablename WHERE id = $id");

    $row = $stmt->fetchObject();
    
    return $row;
  }//endof all()

  ///////////// STATIC FUCNTIONS> ///////////////


}//endof Model{}
?>