<?php

include("header.php");

$adminlib = new adminlib();


if(isset($_POST['add_category'])){
    $message = $adminlib->add_category();
    $error = $message[0];
   
}
$where = "";
$total_record = $adminlib->get_number_row("category", $where);

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

$sql = "SELECT * FROM category LIMIT $start, $limit";
$data = $adminlib->get_list($sql);


?>
<div class="container">
    <div class="row" style="margin-bottom: 10px; ">
      <div class="mx-auto">
        Thêm thể loại mới:
        <form action="manage_category.php" method="POST">
            <input type="text" name="category_name" placeholder="Tên ">
            thuộc thể loại
           
            <select name="category_id">
                <?php  
                    echo $adminlib->get_dropdown_category($data,0);
                ?>  
            </select>
            <button type="submit" name="add_category">Thêm</button>
        </form>
    </div>
    </div>
    <div class="row">
        <div class="mx-auto">
            <table class="table table-responsive">
            <tr>
                <th>ID</th>
                <th>Tên thể loại</th>
                <th>Thao tác</th>
            </tr>
            <?php
            for($i = 0; $i < count($data); $i ++) {
                $id = $data[$i]["category_id"];
                $name = $data[$i]["name"];
                
                ?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $name ?></td>
                    
                    <td>
                        <a href="category_remove.php?id=<?php echo $id;?>" onclick = "if (!(confirm('Bạn có chắc muốn xóa thể loại này?'))) return false">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        </div>
        
    </div>
    <?php echo isset($error['note']) ? $error['note'] : ''; ?>
    <div class="row">
        <div class="mx-auto">
    <ul class="pagination">
    <?php 
    if($current_page >1 && $total_page >1){
        echo '<li class = "page-item"><a class = "page-link" href = "manage_category.php?page='.($current_page - 1).'">Trước</a></li>';
    } 
    for($i = 1; $i <= $total_page; $i++){
        echo '<li class = "page-item"><a class = "page-link" href = "manage_category.php?'.'&page='.$i.'">'.$i.'</a></li>';
    }
    ?>
</ul>
</div>
</div>
</div>

