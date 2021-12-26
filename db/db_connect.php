<?php 

class dbconnect{
		
	private $conn;

	public function connect(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "webtintuc";

		if(!$this->conn){
			try{
				$this->conn = mysqli_connect($servername, $username, $password, $dbname);
				mysqli_set_charset($this->conn, 'UTF8');
			}
			catch(Exception $e){
				echo "Lỗi kết nối đến cơ sở dữ liệu";
				die();
			}
		}
		return $this->conn;
		
	}

	public function dis_connect(){
		if($this->conn){
			$this->conn = null;
		}
	}

	
}
	

?>