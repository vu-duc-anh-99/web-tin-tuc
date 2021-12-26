<?php  
include 'class_db.php';

class homelib extends dblib
{
	function login(){
		$error = array();
		$data = array();

		$data['email'] = isset($_POST['email']) ? $_POST['email'] : "";
		$data['password'] = isset($_POST['password']) ? $_POST['password'] : "";

		if(empty($data['email'])){
			$error['email'] = "Bạn chưa nhập email";
		}

		if(empty($data['password'])){
			$error['password'] = "Bạn chưa nhập password";
		}

		if(!$error){
			$email = $data['email'];
			$password = $data['password'];
			$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password' ";

			$result = parent::get_row($sql);
			
			
			if($result > 0){
				header('Location:index.php');

				setcookie("user", $result['name'], time() + 86400);
				setcookie("user_id", $result['id'], time() + 86400);

			}
			else{
				$error['message'] = "Đăng nhập thất bại";
			}

		}

		$message[0] = $error;
		$message[1] = $data;

		return $message;

	}


	function register(){
		$error = array();
		$data = array();

		$data['name'] = $_POST['name'];
		$data['email'] = $_POST['email'];
		$data['password'] = $_POST['password'];

		if(empty($data['name'])){
			$error['name'] = "Bạn chưa nhập tên";
		}

		if(empty($data['email'])){
			$error['email'] = "Bạn chưa nhập email";
		}

		if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
			$error['email'] = "Email không đúng định dạng";
		}

		if(empty($data['password'])){
			$error['password'] = "Bạn chưa nhập mật khẩu";
		}

		if(!$error){
			parent::insert("user",$data);
			$error['message'] = "Đăng ký thành công";
		}
		else{
			$error['message'] = "Đăng ký thất bại";
		}

		$message[0] = $error;
		$message[1] = $data;
		return $message;

	}

	function comment($user_id){
		$error = array();
		$data = array();

		$data["comment"] = trim($_POST['comment']);
		$data["post_id"] = $_GET['id'];
		$data["user_id"] = $user_id;
		$data['flag'] = 1;
		
		if(empty($data['comment']) || $data['comment'] == ""){
			$error['comment'] = "Bạn chưa nhập bình luận";
		}
		if(!$error){
			$data["createdate"] = date("Y-m-d H:i:s");
			parent::insert("comment",$data);
			header("Location:post_detail.php?id=".$data["post_id"]);	
		}

		$message[0] = $error;
		return $message;
	}


	
	
}


?>