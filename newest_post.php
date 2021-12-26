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
    $summary = $data_hightlight["summary"];
    $category = $dblib->find_title_name($data_hightlight["category_id"]); 


    ?>

    <div>
        <div >
            <div class="row ">
                <div class="col-lg-8">
                    <div class="main_content_highlight">
                        <div id= "img_highlight">
                            <img src="images/<?php echo $image ?>" width = "100%" height= "100%">
                        </div>

                    </div>  
                </div>
                <div class="col-lg-4">
                    <div> 
                        <a href="post_detail.php?id=<?php echo $id ?>&<?php echo $title ?>"><h4><?php echo $title ?></h4></a>
                    </div>
                    <p><?php echo $summary ?></p> 
                </div>
            </div> 
            <hr> 
        </div>
    </div>
    

    <?php 
} 
else {
    echo "Không có bài viết nào";
}
?>