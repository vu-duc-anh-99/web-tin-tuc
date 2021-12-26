<?php 
include 'header.php'; 

$adminlib = new adminlib();

$sql = "SELECT * FROM category";
$list_category = $adminlib->get_list($sql);

$post_id = intval($_GET["id"]);
$sql = "SELECT * FROM posts WHERE post_id = $post_id";
$post = $adminlib->get_row($sql);


if (isset($_POST['update_action'])) {
	$message = $adminlib->update_post($post_id);
	$error = $message[0];
	$data = $message[1];
}

$title = $post["title"];
$summary = $post["summary"];
$image = $post["image"];
$category_id = $post["category_id"];
$content = $post["content"];
$image = $post["image"];

?>

<?php echo isset($error['note']) ? $error['note'] : ''; ?>
<form method="POST" action="post_update.php?id=<?php echo $post_id ?>" enctype="multipart/form-data">
	Nhập tiêu đề bài viết:<br>
	<textarea name="title" rows="3" cols="50" ><?php echo $title ?></textarea>
	<?php echo isset($error['title']) ? $error['title'] : ''; ?><br>
	<br>
	<select name="category_id">
		<?php  
		echo $adminlib->get_dropdown_category($list_category,$category_id);
		?>	
	</select>
	<br>
	<br>Nhập tóm tắt nội dung:
	<textarea name="summary" id="summary"><?php echo $summary ?></textarea>
	<script>
		
        CKEDITOR.replace('summary', 
        	{ 
        		height: 300,
        		width: 870 
        	}
        );

	</script>
	Hình ảnh cũ: <br>
	<img src="../images/<?php echo $image ?>" width="200px" height="150px">
	<br><br>
	Hình ảnh mới:<br>
	<input name="fileToUpload" type="file">
	<?php echo isset($error['image']) ? $error['image'] : ''; ?>  
	<br><br>
	Nhập nội dung bài viết: <br>
	<textarea name="content" id="content" rows="200" cols="50"><?php echo $content ?></textarea>
	<script>
        CKEDITOR.replace( 'content' );
        CKEDITOR.config.width = 870;
        CKEDITOR.config.height = 700;
    </script>
	<?php echo isset($error['content']) ? $error['content'] : ''; ?>
	<br>
	<button type="submit" name="update_action" >Sửa bài viết</button>
</form>
