<?php


$where= "";
$link = "";
if(isset($_GET['cat'])){
    //include "category_sidebar.php";
    $category_id = intval($_GET["cat"]);
    $where = "WHERE category_id = ". $category_id;
    $link = "cat=".$category_id;
}

if(isset($_POST['search_action'])){
    $data_search = $_POST['search_data'];
    $where = " WHERE title LIKE '%". $data_search. "%'";   
}


$sql = "SELECT * FROM posts $where ORDER BY createdate DESC LIMIT 1, 3";
$data = $dblib->get_list($sql);

?>

<div>
    <div class="container-fluid">
        <div class="row">
            <?php  
            for($i = 0; $i < count($data); $i ++) {
                $id = $data[$i]["post_id"];
                $title = $data[$i]["title"];
                $image = $data[$i]["image"];
                $category = $dblib->find_title_name($data[$i]["category_id"]); 
                ?>
                <div class="col-lg-4">
                    <div id = "img">
                        <img src="images/<?php echo $image ?>" width = "100%" height= "170px">
                    </div> 
                    <div>
                        <a href="post_detail.php?id=<?php echo $id ?>&<?php echo $title ?>"><h6><?php echo $title ?></h6></a>
                    </div> 
                           
                </div>  
            <?php } ?>
        </div>
    </div>
</div>


