<?php

//$dblib = new dblib();

$where= "";
$link = "";
if(isset($_GET['cat'])){
	$category_id = intval($_GET["cat"]);
	$where = "WHERE category_id = ". $category_id;
	$link = "cat=".$category_id;
}

if(isset($_POST['search_action'])){
	$data_search = $_POST['search_data'];
	$where = " WHERE title LIKE '%". $data_search. "%'";
	
}


$sql = "SELECT * FROM posts $where ORDER BY createdate DESC LIMIT 4, 10";
$data = $dblib->get_list($sql);


?>

<div class= " container-fluid main_content">
<?php
	for($i = 0; $i < count($data); $i ++) {
		$id = $data[$i]["post_id"];
		$title = $data[$i]["title"];
		$image = $data[$i]["image"];
		$summary = $data[$i]["summary"];
		$category = $dblib->find_title_name($data[$i]["category_id"]); 
		?>
		<div>
			<div>
				<a href="post_detail.php?id=<?php echo $id ?>&<?php echo $title ?>"><h5><?php echo $title ?></h5></a>
			</div>
			<div class="row">
				<div class="col-lg-5" id = "img">
					<img src="images/<?php echo $image ?>" width = "150px" height= "100px">
				</div>
				<div class="col-lg-7" id = "content">
					<p><?php echo $summary ?></p>	
				</div>
			</div>
			<?php 
				if ($i < count($data) - 1){
					echo    '<div class="content_post"></div>';
                
				}
			?>
				
		</div>	
<?php } ?>
</div>

