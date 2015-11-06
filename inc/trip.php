<?php
  require_once('database_mysqli.php');
  
  class Trip extends DatabaseObject {
    
		protected static $tableName='trips';
		protected static $dbFields = array('origin', 'destination', 'travelers', 'hours_per_day', 'efficiency', 'use_toll_roads', 'meal_grade', 'hotel_grade', 'created_by', 'created');
		protected $id;
		protected $origin;
		protected $destination;
		protected $travelers;
		protected $hours_per_day;
		protected $efficiency;
		protected $use_toll_roads;
		protected $meal_grade;
		protected $hotel_grade;
		protected $created_by;
		protected $created;
		
		public function __construct($tripArray) {
			//parent::__construct();
			foreach($tripArray as $key => $field) {
				if($this->has_attribute($key)) {
					$this->$key = $field;
				}
			}
		}
		
		public function get_origin() {
			if(isset($this->origin)) {
				return $this->origin;
			}
			else {
				return '';
			}
		}
		
		public function get_destination() {
			if(isset($this->destination)) {
				return $this->destination;
			}
			else {
				return '';
			}
		}
		
		public function get_travelers() {
			if(isset($this->travelers)) {
				return $this->travelers;
			}
			else {
				return '';
			}
		}
		
		public static function find_by_user($userId) {
			global $database;
			$className = get_called_class();
			return $className::find_by_sql('SELECT * FROM ' . $className::$tableName . ' WHERE created_by=' . $userId);
		}
	
	}

?>