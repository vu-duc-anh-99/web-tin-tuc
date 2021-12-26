<?php  
	include 'header.php';
	$dblib = new dblib();
	$where = "";
	if(isset($_GET["id"])){
		$post_id = intval($_GET["id"]);
		$where = "WHERE post_id = $post_id";
		$sql = "SELECT * FROM posts $where";
		$data_post = $dblib->get_row($sql);

		$title = $data_post['title'];
		$content = $data_post['content'];
		$image = $data_post['image'];
		$view['view'] = $data_post['view'] + 1;
		$category_id = $data_post['category_id'];
		$category_name = $dblib->find_title_name($category_id);
		$createdate = $data_post['createdate'];
		$dblib->update("posts", $view, $where);
	}
?>

<div class="container">
	<div class = "row">
		<div class="col-lg-9 main-border">
			<div class="main_content">
				<div class="header-post-detail">
					<a href="index.php?cat=<?php echo $category_id?>"><?php echo $category_name; ?></a>
					<div class="date">
						<?php echo $createdate ?>
					</div>
				</div>
				<div>
					<h2><?php echo $title ?></h2>
				</div>
				<div>
					<p>
						<?php echo $data_post['content']; ?>
					</p>
				</div>
				<div>
					<?php  
					include_once("footer_comment.php");
					?>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<?php  
			include("right_side.php");
			?>
		</div>
	</div>
</div>
</div>
	
	
	
	


