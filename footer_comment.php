<?php 
//	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	include_once 'db/class_home.php';
	$homelib = new homelib();
	if(isset($_GET["id"])){
		$post_id = intval($_GET["id"]);
		$sql = "SELECT name, comment, createdate FROM user u INNER JOIN comment cmt ON u.id = cmt.user_id WHERE post_id = ".$post_id ." AND flag = 1";
		$data = $homelib->get_list($sql);	
	}

	if (isset($_POST['comment_action'])) {
		if(!isset($_COOKIE["user"])) {
			header("Location:login.php");
			die();
		} 
		$user_id = $_COOKIE["user_id"];
		$post_id = $_GET["id"];
		$message = $homelib->comment($user_id);
		$error = $message[0];
		if(isset($error)){
			header("Location:post_detail.php?id=".$post_id);
		}
		
	}
?>

<div>
	
	<div id="addcomment" >
		<form method="POST" action="footer_comment.php?id=<?php echo $post_id ?>">
			<textarea style="resize: none" rows = "3"  class="form-control" placeholder="Nội dung" name = "comment"></textarea><br/>
			<button style="margin-bottom: 30px;" name="comment_action" class="btn btn-primary">Bình luận</button>
		</form>
	</div>
	
	<?php
	 for($i = 0; $i < count($data); $i++){
		$user_name = $data[$i]['name'];
		$comment = $data[$i]['comment'];
		$createdate = $data[$i]['createdate'];
?>
	
	<div class="row comment">
		<div>
		<strong class = "user" ><?php echo $user_name?></strong><small><?php echo $createdate ?></small>
		</div>
	</div> 
	
	<?php echo "<p>".$comment."</p>" ?>
<?php  
	}
	
?>
</div>



