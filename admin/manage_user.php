<?php

include("header.php");

$adminlib = new adminlib();

$where = "";
$sql = "SELECT * FROM user $where";
$data = $adminlib->get_list($sql);
    
?>
<div class="container">
    <div class="row">
        <div class="col-6 mx-auto">
            <table>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Thao tác</th>
            </tr>
            <?php
            for($i = 0; $i < count($data); $i ++) {
                $id = $data[$i]["id"];
                $name = $data[$i]["name"];
                $email = $data[$i]["email"];
                ?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $name ?></td>
                    <td><?php echo $email ?></td>
                    <td>
                        <a href="user_remove.php?id=<?php echo $id;?>" onclick = "if (!(confirm('Bạn có chắc muốn xóa người dùng này?'))) return false">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        </div>
        
    </div>
</div>
</div>
