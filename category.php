<?php
include "header.php";
$dblib = new dblib();

$where= "";
$link = "";

if(isset($_GET['cat'])){
    $category_id = intval($_GET["cat"]);
    $where = "WHERE category_id = ". $category_id;
    $link = "cat=".$category_id;
}


$total_record = $dblib->get_number_row("posts", $where);

$limit = 10;

$total_page = ceil($total_record / $limit);
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
if($current_page > $total_page){
    $current_page = $total_page;
}
else if ($current_page < 1){
    $current_page = 1;
}
$start = ($current_page - 1) * $limit;

// $sql = "SELECT * FROM posts p JOIN category c ON "
//              ."(p.category_id = c.category_id OR p.category_id = c.parent_id) ".$where
//              ." GROUP BY p.post_id"
//              ." ORDER BY createdate DESC"; 
$sql = "SELECT * FROM posts $where ORDER BY createdate DESC";       
$data = $dblib->get_list($sql);


?>

<div class= "container">
    <div class="col-lg-8 main-border">

        <?php 
            if($data){
                $category = $dblib->find_title_name($data[0]["category_id"]);  
                echo "<h2>".$category."</h2>";
        ?>
        <?php
        
        for($i = 0; $i < count($data); $i ++) {
            $id = $data[$i]["post_id"];
            $title = $data[$i]["title"];
            $image = $data[$i]["image"];
            $summary = $data[$i]["summary"];
             
            ?>
            
                <div class="row">
                    <div class="col-lg-4" id = "img">
                        <img src="images/<?php echo $image ?>" width = "100%" height= "172px">
                    </div>
                    <div class="col-lg-8">
                        <div>
                            <a href="post_detail.php?id=<?php echo $id ?>&<?php echo $title ?>"><h5><?php echo $title ?></h5></a>
                        </div>
                        <p><?php echo $summary ?></p>   
                    </div>
                </div>
                <div class="content_post">
                    
                </div>
                
     
        <?php }}
            else{
                echo "Kh??ng c?? b??i vi???t n??o";
            }
         ?>
    </div>
    <div class="col-lg-4">

    </div>
    <ul class="pagination">
        <?php 
        if($current_page >1 && $total_page >1){
            echo '<li class = "page-item"><a class = "page-link" href = "index.php?page='.($current_page - 1).'">Tr?????c</a></li>';
        } 
        for($i = 1; $i <= $total_page; $i++){
            echo '<li class = "page-item"><a class = "page-link" href = "index.php?'.$link.'&page='.$i.'">'.$i.'</a></li>';
        }
        ?>
    </ul>
</div>


