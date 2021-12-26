
<?php 

$where= "";
if(isset($_GET['cat'])){
    $category_id = intval($_GET["cat"]);
    $where = "WHERE category_id = ". $category_id;
    $link = "cat=".$category_id;
}

$sql = "SELECT * FROM posts $where ORDER BY createdate DESC LIMIT 1 ";
$data_hightlight = $dblib->get_row($sql);

$sql = "SELECT * FROM posts $where ORDER BY view DESC LIMIT 10";
$data_title = $dblib->get_list($sql);

?>

<div><h4>Tin tức sự kiện</h4></div>
<ul class="navbar-nav ml-auto">
    <?php  
    for($i = 0 ;$i <count($data_title); $i++){
        $title = $data_title[$i]["title"];  
        ?>
        <li class="item-most-view">
            <a href="admin.php" id = "title-most-view"><?php echo $title ?></a>
        </li>
    <?php } ?>          

</ul>