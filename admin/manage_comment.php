<?php
include("header.php");

$adminlib = new adminlib();

$where = "";
$post_id; 
if(isset($_POST['search_action'])){
    $data_search = $_POST['search_data'];
    $where = " WHERE name LIKE '%". $data_search. "%'";
}
if(isset($_POST['update'])){
    $comment_id = $_GET['comment_id'];
    $adminlib->update_comment($comment_id);
}
if(isset($_GET['id'])){
    $post_id = $_GET['id'];
    $where = " WHERE post_id = $post_id";
}
$sql = "SELECT * FROM comment $where";
$data = $adminlib->get_list($sql);

$sql = "SELECT * FROM posts WHERE post_id = ".$post_id;
$data_post = $adminlib-> get_row($sql);


$join = "INNER JOIN comment ON user.id = comment.user_id ".$where;
$sql = "SELECT name,email FROM user $join";
$data_user = $adminlib->get_list($sql);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class = "col-lg-10 d-flex">
            <div class="admin-searchbar ml-auto">
                <form action="manage_post.php" method="POST">
                    <div class="inner-form">
                        <div class="input-field second-wrap">
                            <input name ="search_data" id= "search" type="text" placeholder="Tìm kiếm " />
                        </div>
                        <div class="input-field third-wrap">

                            <button name="search_action" class="btn-search" type="submit">
                                <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>  
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <img src="../images/<?php echo $data_post['image'] ?>" width = "50%" height= "170px">
        <div>
            <h4><?php echo $data_post['title'] ?></h4>
        </div>
    </div>
    <div class="col-lg-8">
        <table>
            <tr>
                <th>Email</th>
                <th>Tên</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
            <?php
            for($i = 0; $i < count($data); $i ++) {
                $comment_id = $data[$i]["comment_id"];
                $user_name = $data_user[$i]["name"];
                $user_email = $data_user[$i]["email"];
                $flag = $data[$i]["flag"];
                $comment = $data[$i]["comment"];
                $createdate = $data[$i]["createdate"];
                ?>
                <tr>
                    <td><?php echo $user_email ?></td>
                    <td><?php echo $user_name ?></td>
                    <td><?php echo $comment ?></td>
                    <td><?php echo $createdate ?></td>
                    <td>
                        <?php 
                            if($flag == 0 ){
                                echo "Đang chờ";
                            }
                            elseif ($flag == 1) {
                                echo "Đã duyệt";
                            }
                        ?>
                    </td>
                    <td>
                        <a href="comment_update.php?comment_id=<?php echo $comment_id;?>&id=<?php echo $post_id;?>" 
                            onclick = "if (!(confirm('Bạn có chắc muốn duyệt bình luận này?'))) return false"><button name="update">Duyệt</button></a> |
                        <a href="comment_remove.php?comment_id=<?php echo $comment_id;?>&post_id=<?php echo $post_id;?>" 
                            onclick = "if (!(confirm('Bạn có chắc muốn xóa bình luận này?'))) return false"><button>Xóa</button></a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>     
</div>
    

