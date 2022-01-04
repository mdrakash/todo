<?php
	
	class db_config{
		public $host = "localhost";
		public $user = "root";
		public $pass = "";
		public $db_name = "myTodo";
		public $con;

		public function __construct(){
			$this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->db_name);
		}

		public function insert($sql){
			$this->con->query($sql);
			return [
				'response' =>'success',
				'last_id'  => $this->con->insert_id
			];
			
		}

		public function delete($sql){
			$this->con->query($sql);
		}

		public function view($sql){
			$view = $this->con->query($sql);
			return $view;
		}

		public static function DBConnect(){
			$db_config = new db_config;
			return $db_config;
		}
	}

?>

