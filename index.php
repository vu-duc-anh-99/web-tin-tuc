<?php  
include 'header.php';
?>
<div class="container">
  <div class="row">

    <div class="col-lg-9 main-border">
      <div>
        <?php
         
          include 'newest_post.php';
          include 'new_three_posts.php';
        ?>
      </div>
    </div>
    <div class="col-lg-3">
      <?php  
      include 'right_side.php';
      ?>
    </div>
  </div>
  <hr>
 
  <div class="row">
    <div class="col-lg-4">
     <?php  
     include 'left_new_posts.php';
     ?>
   </div>
   <div class="col-lg-8 main_content_right_side">
    <?php  
    include 'right_new_posts.php';
    ?>
  </div>
</div>
<hr>
</div>

 

