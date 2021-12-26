<?php

include("header.php");

$adminlib = new adminlib();

$where= "";
$link = "";
$category_id;
if(isset($_GET['cat'])){
	$category_id = intval($_GET["cat"]);
	$where = "WHERE category_id = ". $category_id;
	$link = "cat=".$category_id;
}

if(isset($_POST['search_action'])){
	$data_search = $_POST['search_data'];
	$where = " WHERE title LIKE '%". $data_search. "%'";
	
}


$total_record = $adminlib->get_number_row("posts", $where);

$limit = 5;

$total_page = ceil($total_record / $limit);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
if($current_page > $total_page){
	$current_page = $total_page;
}
else if ($current_page < 1){
	$current_page = 1;
}
$start = ($current_page - 1) * $limit;

$sql = "SELECT * FROM posts $where ORDER BY createdate DESC LIMIT $start, $limit";
$data = $adminlib->get_list($sql);



$sql = "SELECT * FROM category";
$data_category = $adminlib->get_list($sql);

?>


<div class="container-fluid">
	<div class="row">
		<div class="col-lg-1"></div>
		<div class = "col-lg-10 d-flex">
			<div class="admin-searchbar ml-auto">
				<form action="manage_post.php" method="POST">
					<div class="inner-form">
						<div class="input-field second-wrap">
							<input name ="search_data" id= "search" type="text" placeholder="Tìm kiếm " />
						</div>
						<div class="input-field third-wrap">

							<button name="search_action" class="btn-search" type="submit">
								<svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
									<path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
								</svg>
							</button>
						</div>
					</div>
				</form>
			</div> 
		</div>	
	</div>
	
	<div class="p-2">
		<a href="post_add.php" class="btn btn-primary">Thêm bài viết</a>
	</div>
	<form action="manage_post.php" method="GET">
		<select name="cat">
        <?php  
            echo $adminlib->get_dropdown_category($data_category,$category_id);
        ?>  
    	</select>
    	<button>Lọc theo thể loại</button>	
	</form>	
	
	<div id="sidebar-clear">					
	</div>	
</div>
<div class="row">
	<div>
		<table>
			<colgroup>
				<col style="width: 5%;">
				<col style="width: 10%;">
				<col style="width: 10%;">
				<col style="width: 1%;">
				<col style="width: 8%;">
				<col style="width: 5%;">
			</colgroup>
			<tr>
				<th>Thể loại</th>
				<th>Tiêu đề</th>
				<th>Tóm tắt nội dung</th>
				<th>Hình ảnh</th>
				
				<th>Ngày tạo</th>
				<th>Thao tác</th>
			</tr>
			<?php
			for($i = 0; $i < count($data); $i ++) {
				$id = $data[$i]["post_id"];
				$title = $data[$i]["title"];
				$summary =  $data[$i]["summary"];
				$image = $data[$i]["image"];
				$content = substr($data[$i]["content"], 0, 200);
				$createdate = $data[$i]["createdate"];
				$category = $adminlib->find_title_name($data[$i]["category_id"]); 
				?>
				<tr>
					<td style="text-align: center;"><?php echo $category ?></td>
					<td><?php echo $title ?></td>
					<td><?php echo $summary ?></td>
					<td><img src="../images/<?php echo $image ?>" width="120px" height="100px" ></td>
					
					<td style="text-align: center;"><?php echo $createdate ?></td>
					<td style="text-align: center;"><a href="post_update.php?id=<?php echo $id;?>">Sửa</a>|
						<a href="post_remove.php?id=<?php echo $id;?>" onclick = "if (!(confirm('Bạn có chắc muốn xóa bài viết này?'))) return false">Xóa</a>|
						<a href="manage_comment.php?id=<?php echo $id;?>">Quản lý bình luận</a>
					</td>
				</tr>
			<?php } ?>
		</table>
	</div>
</div>
</div>
<ul class="pagination">
	<?php 
	if($current_page >1 && $total_page >1){
		echo '<li class = "page-item"><a class = "page-link" href = "manage_post.php?page='.($current_page - 1).'">Trước</a></li>';
	} 
	for($i = 1; $i <= $total_page; $i++){
		echo '<li class = "page-item"><a class = "page-link" href = "manage_post.php?'.$link.'&page='.$i.'">'.$i.'</a></li>';
	}
	?>
</ul>
