<?php 

include 'header.php'; 


$adminlib = new adminlib();

$sql = "SELECT * FROM category";
$list_category = $adminlib->get_list($sql);

// $result = $dblib->get_list_category();

$adminlib = new adminlib();
if (isset($_POST['add_action'])) {
	$message = $adminlib->add_post();
	$error = $message[0];
	$data = $message[1];
}
	
?>

<?php echo isset($error['note']) ? $error['note'] : ''; ?>
<form method="POST" action="post_add.php" enctype="multipart/form-data">
	Nhập tiêu đề bài viết:<br>
	<?php echo isset($error['title']) ? $error['title'] : ''; ?><br>
	<textarea name="title" id="title"></textarea>
	<script>
		
        CKEDITOR.replace('title', 
        	{ 
        		height: 150,
        		width: 870 
        	}
        );

	</script>
	<br>Nhập tóm tắt nội dung:
	<textarea name="summary" id="summary"></textarea>
	<script>
		
        CKEDITOR.replace('summary', 
        	{ 
        		height: 300,
        		width: 870 
        	}
        );

	</script>
	
	Chọn thể loại:<br>
	<select name="category_id">
		<?php  
		echo $adminlib->get_dropdown_category($list_category,$data['category_id']);
		?>	
	</select>
	<br>
	Chọn hình ảnh chính:<br>
	<input name="fileToUpload" type="file">
	<?php echo isset($error['image']) ? $error['image'] : ''; ?> 
	<br>
	Nhập nội dung bài viết: <br>
	<textarea name="content"  id="content"></textarea>
	<script>
		CKEDITOR.replace( 'content' );
		CKEDITOR.config.width = 870;
        CKEDITOR.config.height = 700;
	</script>
	<?php echo isset($error['content']) ? $error['content'] : ''; ?>
	<br>
	<button type="submit" name="add_action" >Thêm bài viết</button>
</form>
