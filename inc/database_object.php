<?php
  //if it will need DB...make sure to include it
  require_once('database_mysqli.php');
  
  class DatabaseObject {
  
    protected static $tableName;
	
	//common database methods
	
	public static function find_all() {
	  global $database;
	  $className = get_called_class();
	  return $className::find_by_sql('SELECT * FROM ' . $className::$tableName);
	}
	
	public static function find_by_id($id = 0) {
	  global $database;
	  $className = get_called_class();
	  $sql = 'SELECT * FROM ' . $className::$tableName . ' WHERE id=' . $database->escape_value($id) . ' Limit 1';
	  $resultArray = $className::find_by_sql($sql);
	  return !empty($resultArray) ? array_shift($resultArray) : false;
	}
	
	public static function find_by_sql($sql = '') {
	  global $database;
	  $resultSet = $database->query($sql);
	  $objectArray = array();
	  while($row = $database->fetch_array($resultSet)) {
	    $objectArray[] = static::instantiate($row);
	  }
	  return $objectArray;
	}
	
	public static function count_all() {
	  global $database;
	  $className = get_called_class();
	  $sql = "SELECT COUNT(*) FROM " . $className::$tableName;
	  $resultSet = $database->query($sql);
	  $row = $database->fetch_array($resultSet);
	  return array_shift($row);
	}
	
	public function attributes() {
		$className = get_called_class();
		$attributes = array();
		foreach($className::$dbFields as $field) {
		  if(property_exists($this, $field)) {
		    $attributes[$field] = $this->$field;
		  }
		}
		return $attributes;
		//return get_object_vars($this);
	}
	
	protected function escaped_attributes() {
		global $database;
		$escapedAttributes = array();
		foreach($this->attributes() as $key => $value) {
		  $escapedAttributes[$key] = $database->escape_value($value);
		}
		return $escapedAttributes;
	}
	
	protected function has_attribute($attribute) {
	  //get_object_vars returns assoc array with all attr
	  //including private as the keys and current values as values
	  $objectVars = $this->attributes();
	  //array_key_exits returns true/false
	  return array_key_exists($attribute, $objectVars);
	}
	
	protected function instantiate($record) {
	  //make sure to check record exists and is an array
	  $className = get_called_class();
	  $object = new $className;
	  foreach($record as $attribute=>$value) {
	    if($object->has_attribute($attribute)) {
		  $object->$attribute = $value;
		}
	  }
	  return $object;
	}
	
		protected function create() {
	  global $database;
	  $className = get_called_class();
	  //don't forget sql syntax and good habits
	  //escape all values to prevent injection
	  $attributes = $this->escaped_attributes();
	  $sql = "INSERT INTO " . $className::$tableName . " (";
	  $sql .= join(", ", array_keys($attributes));
	  $sql .= ") VALUES ('";
	  $sql .= join("', '", array_values($attributes));
	  $sql .= "')";
	  
	  if($database->query($sql)) {
	    $this->id = $database->insert_id();
		return true;
	  }
	  else {
	    return false;
	  }
	}
	
	protected function update() {
	  global $database;
	  $className = get_called_class();
	  //don't forget sql syntax and good habits
	  //UPDATE table SET key='value', key='value' WHERE condition
	  //escape all values to prevent injection
	  $attributes = $this->escaped_attributes();
	  $attributePairs = array();
	  foreach($attributes as $key => $value) {
	    $attributePairs[] = "{$key}='{$value}'";
	  }
	  $sql = "UPDATE " . $className::$tableName . " SET ";
	  $sql .= join(", ", $attributePairs);
	  $sql .= " WHERE id=" . $database->escape_value($this->id);
	  
	  $database->query($sql);
	  if($database->affected_rows() == 1)  {
		return true;
	  }
	  else {
	    return false;
	  }
	  
	}
	
	public function save() {
	  if(isset($this->id)) {
	    return $this->update();
	  }
	  else {
	    return $this->create();
	  }
	}
	
	public function delete() {
	  global $database;
	  $className = get_called_class();
	  //use limit 1 for extra insurance
	  $sql = "DELETE FROM " . $className::$tableName;
	  $sql .= " WHERE id=" . $database->escape_value($this->id);
	  $sql .= " LIMIT 1";
	  
	  $database->query($sql);
	  if($database->affected_rows() == 1)  {
		return true;
	  }
	  else {
	    return false;
	  }
	  
	}
  
  }

?>