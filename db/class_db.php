<?php
include 'db_connect.php';

class dblib extends dbconnect{
	function get_list($sql){
		$return = array();
		$result = mysqli_query(parent::connect(), $sql);
		if($result){
			while($row = mysqli_fetch_assoc($result)){
				$return[] = $row;
			}
		}

		return $return;		
	}
	
	function get_row($sql){
		
		$value = array();
		$result = mysqli_query(parent::connect(),$sql);

		if ($result){
			$row = mysqli_fetch_assoc($result);
		}

		return $row;
	}



	function insert($table,$data)
	{
		

		$field_list = "";
		$value_list = "";

		foreach ($data as $key => $value) {
			$field_list .= ",$key";
			$value_list .= ",'".$value."'";
		}

		$sql = "INSERT INTO $table (".trim($field_list,",").") VALUES (".trim($value_list, ",").")";
		$stmt = parent::connect()->prepare($sql);

		return $stmt->execute();
	}

	function update($table,$data,$where)
	{
		
		$field_list = "";
		$value_list = "";
		$sql = "";
		foreach ($data as $key => $value) {
			$sql .= "$key = '".$value."',";
		}

		$sql = "UPDATE $table SET " .trim($sql,",").$where;
		$stmt = parent::connect()->prepare($sql);

		return $stmt->execute();
	}

	function delete($sql)
	{
		
		$stmt = mysqli_query(parent::connect(),$sql);
		if ($stmt) {
			header("Location: index.php");
		}
		else{
			echo "Lỗi";
		}

	}

	function find_title_name($category_id){

		$sql = "SELECT name FROM category WHERE category_id = $category_id LIMIT 1";
		$query = mysqli_query(parent::connect(), $sql);
		$result = mysqli_fetch_array($query);
		return $result[0]; 
	}

	function get_number_row($table,$where){
		$sql = "SELECT COUNT(*) FROM $table $where";
		$query = mysqli_query(parent::connect(), $sql);
		$result = mysqli_fetch_array($query);
		return $result[0];
	}

	function createChildMenu($parentID,$link){
		$idMenu = array();
		$nameMenu = array();
		$sql = "SELECT * FROM category WHERE parent_id = ".$parentID; 
		$result = mysqli_query(parent::connect(),$sql);

		while($row = mysqli_fetch_assoc($result)){ 
			array_push($idMenu,$row['category_id']);
			array_push($nameMenu,$row['name']);  
		}
		if(count($idMenu)>0){

			for($i = 0;$i<count($idMenu);$i++){
				echo '<a href="'.$link.'?cat='.$idMenu[$i].'">'.$nameMenu[$i].'</a>';
				$this->createChildMenu($idMenu[$i],$link);
			}

		}
		else{

		}
	}


	function createMenu($link){

		$sql = "SELECT * FROM category";
		$result = mysqli_query(parent::connect(),$sql);
		
		while ($row = mysqli_fetch_assoc($result)) {
			if($row['parent_id']==0){

				echo '<div class ="dropdown">';
				echo'<a href="'.$link.'?cat='.$row["category_id"].'"><button class="dropbtn">'.$row["name"].'</button></a>';
				echo '<div class="dropdown-content">';
				$this->createChildMenu($row['category_id'],$link);
				echo "</div>";
				echo "</div>";

			}
		}

	}	

}