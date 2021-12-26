<?php  
include 'class_db.php';
class adminlib extends dblib
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
			header("Location:index.php");

			setcookie("admin", $result['name'], time() + 86400);

			}
			else{
				$error['message'] = "Đăng nhập thất bại";
			}

		}

		$message[0] = $error;
		$message[1] = $data;

		return $message;

	}
	function add_post(){
		//var_dump($_FILES);
		$error = array();
		$data = array();

		$data['title'] = $_POST['title'];
		$data['summary'] = $_POST['summary'];
		$data['category_id'] = intval($_POST['category_id']);
		$data['content'] = $_POST['content'];
		$data['image'] = basename($_FILES["fileToUpload"]["name"]);

		if(empty($data['title'])){
			$error['title'] = "Bạn chưa nhập tiêu đề";
		}

		if(empty($data['category_id'])){
			$error['category_id'] = "Bạn chưa chọn thể loại";
		}

		if(empty($data['content'])){
			$error['content'] = "Bạn chưa nhập nội dụng";
		}

		if(empty($data['image'])){
			$error["image"] = "Chưa chọn hình ảnh";
		}

		
		if ($_FILES["fileToUpload"]["tmp_name"] != "") {
			$target_dir = "../images/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadCheck = 1;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false){
				$uploadCheck = 1;
			}


			if (file_exists($target_file)) {
				$error["image"] = "File đã tồn tại";
				$uploadCheck = 0;
			}

			if ($_FILES["fileToUpload"]["size"] > 5000000) {
				$error["image"] = "Lổi, kích thước file quá lớn";
				$uploadCheck = 0;
			}
		}

		if (!$error) {
			$data["createdate"] = date("Y-m-d H:i:s");

			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			$data['image'] = basename($_FILES["fileToUpload"]["name"]);
			
			$this->insert("posts", $data);
			$error["note"] = "Thêm bài viết thành công";
			header('Location:manage_post.php');
			die();
		}
		else {
			$error["note"] = "Thêm bài viết thất bại";
		}

		$message[0] = $error;
		$message[1] = $data;
		return $message;
	}
	function add_category(){
		//var_dump($_FILES);
		$error = array();
		$data = array();

		$data['name'] = $_POST['category_name'];
		$data['parent_id'] = intval($_POST['category_id']);

		if(empty($data['name'])){
			$error['title'] = "Bạn chưa nhập tên thể loại";
		}

		if (!$error) {	
			$this->insert("category", $data);
			$error["note"] = "Thêm thể loại thành công";
			header('Location:manage_category.php');
			die();
		}
		else {
			$error["note"] = "Thêm thể loại thất bại";
		}

		$message[0] = $error;
		$message[1] = $data;
		return $message;
	}
	function get_dropdown_category($list, $value) {
		
		$info = '<option value="0">Chọn thể loại</option>';
		for ($i = 0; $i < count($list); $i++) {
			
			$selected = $list[$i]["category_id"] == $value ? 'selected' : '';
			
			$info .= '<option value="'.$list[$i]["category_id"].'" '.$selected.' >'.$list[$i]["name"].'</option>';
		}
		
		return $info;
	}
	function update_comment($comment_id){
		$data = array();
		$data['flag'] = 1;
		$this->update("comment", $data, " WHERE comment_id = $comment_id");
	}

	function update_post($post_id){
		//var_dump($_FILES);
		$error = array();
		$data = array();

		$data['title'] = $_POST['title'];
		$data['summary'] = $_POST['summary'];
		$data['category_id'] = intval($_POST['category_id']);
		$data['content'] = $_POST['content'];
		$img = basename($_FILES["fileToUpload"]["name"]);

		if(empty($data['title'])){
			$error['title'] = "Bạn chưa nhập tiêu đề";
		}
		if(empty($data['summary'])){
			$error['summary'] = "Bạn chưa nhập tiêu đề";
		}

		if(empty($data['category_id'])){
			$error['category_id'] = "Bạn chưa chọn thể loại";
		}

		if(empty($data['content'])){
			$error['content'] = "Bạn chưa nhập nội dụng";
		}

		if(!empty($img)){
			$data['image'] = basename($_FILES["fileToUpload"]["name"]);
		}
	
	
		if ($_FILES["fileToUpload"]["tmp_name"] != "") {
			$target_dir = "../images/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadCheck = 1;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false){
				$uploadCheck = 1;
			}


			if (file_exists($target_file)) {
				$error["image"] = "File đã tồn tại";
				$uploadCheck = 0;
			}

			if ($_FILES["fileToUpload"]["size"] > 500000) {
				$error["image"] = "Lổi, kích thước file quá lớn";
				$uploadCheck = 0;
			}

			if ($uploadCheck == 1) {
				if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$error["image"] = "Xảy ra lổi trong khi upload file.";

				}
			}
			
		}
		if (!$error) {
			$this->update("posts", $data, " WHERE post_id = $post_id");
			$error["note"] = "Sửa bài viết thành công";
			header('Location:manage_post.php');
			die();
		}
		else {
			$error["note"] = "Sửa bài viết thất bại";
		}

		$message[0] = $error;
		$message[1] = $data;
		return $message;
	}


}
?>