<?php
  require_once(LIB_PATH . DS . 'database.php');
  
  class User extends DatabaseObject {
    
	protected static $tableName='users';
	protected static $dbFields = array('id', 'username', 'password', 'firstName', 'lastName');
	public $id;
	public $username;
	public $password;
	public $firstName;
	public $lastName;
	
	public function full_name() {
	  if(isset($this->firstName) && isset($this->lastName)) {
	    return $this->firstName . ' ' . $this->lastName;
	  }
	  else {
	    return '';
	  }
	}
	
	public static function authenticate($username='', $password='') {
	  global $database;
	  $username = $database->escape_value($username);
	  $password = $database->escape_value($password);
	  
	  $sql = 'SELECT * FROM users ';
	  $sql .= 'WHERE username = \'' . $username . '\' ';
	  $sql .= 'AND password = \'' . $password . '\' ';
	  $sql .= 'LIMIT 1';
	  $resultArray = self::find_by_sql($sql);
	  return !empty($resultArray) ? array_shift($resultArray) : false;
	}
	
  }

?>