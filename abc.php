<?php

$dblib = new dblib();

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

$total_record = $dblib->get_number_row("posts", $where);

$limit = 4;

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
$data = $dblib->get_list($sql);

$sql = "SELECT * FROM posts ORDER BY createdate DESC LIMIT 1";
$data_hightlight = $dblib->get_row($sql);
$id = $data_hightlight["post_id"];
$title = $data_hightlight["title"];
$image = $data_hightlight["image"];
$content = substr($data_hightlight["content"], 0, 300). "...";
$category = implode("",($dblib->find_title($data_hightlight["category_id"]))); 

$sql = "SELECT * FROM posts ORDER BY view DESC LIMIT 10";
$data_title = $dblib->get_list($sql);

?>