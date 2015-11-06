<?php
  require_once($_SERVER['DOCUMENT_ROOT'].DS.'config' . DS . 'data.php');

  class MySQLDatabase {
    
	public $lastQuery;
	private $connection;
	private $magicQuotesActive;
	private $realEscapeStringExists;
	
	function __construct() {
	  $this->open_connection();
	  $this->magicQuotesActive = get_magic_quotes_gpc();
	  //$this->realEscapeStringExists = function_exists('mysql_real_escape_string'); //php greater than 4.3
	  $this->realEscapeStringExists = method_exists('mysqli', 'real_escape_string'); //php greater than 4.3
	}
	public function open_connection() {
	  /*$this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	  if(!$this->connection) {
		die('Database connection failed: ' . mysql_error());
	  }
	  else {
		$dbSelect = mysql_select_db(DB_NAME, $this->connection);
		if(!$dbSelect) {
		  die('Database selection failed: ' . mysql_error());
	    }
	  }*/
	  $this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	  if(!$this->connection) {
		die('Database connection failed: ' . $this->connection->error());
	  }
	  /*else {
		$dbSelect = mysql_select_db(DB_NAME, $this->connection);
		if(!$dbSelect) {
		  die('Database selection failed: ' . mysql_error());
	    }
	  }*/
	}
	public function close_connection() {
	  /*if(isset($this->connection)){
	    unset($this->connection);
	  }*/
	  
	  if(isset($this->connection)){
	    $this->connection->close();
	  }
	  
	}
	
	public function query($sql) {
	  /*$this->lastQuery = $sql;
	  $result = mysql_query($sql, $this->connection);
	  $this->confirm_query($result);
	  return $result;*/
	  $this->lastQuery = $sql;
	  $result = $this->connection->query($sql);
	  $this->confirm_query($result);
	  return $result;
	}
	
	public function escape_value($value) {
	  /*if($this->realEscapeStringExists) {
	    //undo magic quotes and use real escape
		if($this->magicQuotesActive) {
		  $value = stripslashes($value);
		}
		$value = mysql_real_escape_string($value);
	  }
	  else { //before 4.3
	    //if mgic quotes is not on then add slashes
	    if(!$this->magicQuotesActive) {
		  $value = addslashes($value);
		}
	  }
	  return $value;*/
	  if($this->realEscapeStringExists) {
	    //undo magic quotes and use real escape
		if($this->magicQuotesActive) {
		  $value = stripslashes($value);
		}
		$value = $this->connection->real_escape_string($value);
	  }
	  else { //before 4.3
	    //if mgic quotes is not on then add slashes
	    if(!$this->magicQuotesActive) {
		  $value = addslashes($value);
		}
	  }
	  return $value;
	}
	
	//DB-neutral functions
	public function fetch_array($resultSet) {
	  //return mysql_fetch_array($resultSet);
	  return $resultSet->fetch_array(MYSQLI_NUM);
	}
	
	public function num_rows($resultSet) {
	  //return mysql_num_rows($resultSet);
	  return $this->connection->affect_rows($resultSet);
	}
	
	public function insert_id() {
	  //get last id inserted over connection
	  return mysql_insert_id($this->connection);
	}
	
	public function affected_rows() {
	  return mysql_affected_rows($this->connection);
	}
	
	private function confirm_query($result) {
		/*if(!$result) {
		$output = '<p>Database query failed: ' . mysql_error() . '</p>';
		$output .= '<p>Last query: ' . $this->lastQuery . '</p>';
		die($output);
	  }*/
	  if(!$result) {
		$output = '<p>Database query failed: ' . $this->connection->error . '</p>';
		$output .= '<p>Last query: ' . $this->lastQuery . '</p>';
		die($output);
	  }
	  
	}
  
  }
  
  $database = new MySQLDatabase();
  
?>