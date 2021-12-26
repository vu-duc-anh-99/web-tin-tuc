<?php 

$where= "";

$sql = "SELECT * FROM category LIMIT 7";
$data = $dblib->get_list($sql);



?>
  <?php  
    for($i = 0 ;$i <count($data); $i++){
    ?>
    <ul class="navbar-nav ml-auto">
    <?php
        $category_id = $data[$i]["category_id"];
        $category = $data[$i]["name"];
       
        $sql = "SELECT * FROM category WHERE parent_id = ".$category_id;
        $data_category = $dblib->get_list($sql);
    ?>
    <div><nav class="navbar navbar-expand-sm">
        <li>
            <a class="nav-link" href="#"><h4><?php echo $category ?></h4></a>
        </li>
        <?php
            for($c = 0;$c<count($data_category);$c++){
                $sub_category = $data_category[$c]["name"];
        ?>    
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $sub_category  ?></a>
                </li>
            </ul>
        <?php } ?>
        </nav></div>
        </ul>
        <?php  
             $sql = "SELECT * FROM posts p JOIN category c ON"
             ." p.category_id = c.category_id"
             ." WHERE c.parent_id = " .$category_id."  OR c.category_id = ".$category_id. 
             " GROUP BY p.post_id "; 
          
           
            $data_post = $dblib->get_list($sql);
            if($data_post){
            // for($p = 0;$p<count($data_post);$p++){
            //     $post_id = $data_post[$p]['post_id'];
            //     $img = $data_post[$p]['image'];
            //     $title = $data_post[$p]['title'];
            //     $content = $data_post[$p]['content'];
            // }
        ?>
        <div class="row">
            <div class="col-lg-8 row ">
            <div class="col-lg-6">
                <img src="images/<?php echo $data_post[0]['image'] ?>" width = "220px" height= "150px">
            </div>
            <div class="col-lg-6 main-border" >
                <div> 
                    <a href="post_detail.php?id=<?php echo $data_post[0]['post_id'] ?>&<?php echo $data_post[0]['title'] ?>"><h5><?php echo $data_post[0]['title'] ?></h5></a>
                </div>
                <p><?php echo $data_post[0]['summary']; ?></p>
            </div>
            </div>
            <?php if($data_post[1]) {?>
            <div class="col-lg-4">
               <div> 
                    <a href="post_detail.php?id=<?php echo $data_post[1]['post_id'] ?>&<?php echo $data_post[1]['title'] ?>"><h5><?php echo $data_post[1]['title'] ?></h5></a>
                </div>
                <p><?php echo $data_post[1]['summary']; ?></p>
            </div>
            <?php } ?>  
        </div>
        <?php } ?>    
            <?php 
                if ($i < count($data) - 1){
                    echo "<hr>";
                }
            ?>
    <?php } ?> 
