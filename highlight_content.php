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

if($data_hightlight){
    $id = $data_hightlight["post_id"];
    $title = $data_hightlight["title"];
    $image = $data_hightlight["image"];
    $content = substr($data_hightlight["content"], 0, 300). "...";
    $category = implode("",($dblib->find_title($data_hightlight["category_id"]))); 


?>

<div class="border-highlight">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 border-highlight">
                <div> 
                    <a href="post_detail.php?id=<?php echo $id ?>&<?php echo $title ?>"><h4><?php echo $title ?></h4></a>
                </div>
                <div class="main_content_highlight">
                    <div id= "img_highlight">
                        <img src="images/<?php echo $image ?>" width = "120%" height= "100%">
                    </div>
                    <div id = "content-highlight">
                        <?php echo $content. "..." ?>   
                    </div>
                </div>  
            </div>
            <div class="col-lg-4">
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
            </div>
        </div>  
    </div>
</div>
<hr>

<?php 
} 
else {
    echo "Không có bài viết nào";
}
?>