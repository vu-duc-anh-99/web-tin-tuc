<?php 

include '../db/class_admin.php';

if(!isset($_COOKIE["admin"])) {
    header("Location:login.php");
    die();
} 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quản lý web</title>

    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/style.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="ckeditor/ckeditor.js"></script>
</head>
<body>

    <div class = "container-fluid">
        <div>
         <nav class="navbar navbar-expand-lg bg-secondary navbar-light">
            <a class="nav-link" href="index.php"><h3>Trang chủ</h3></a>
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_COOKIE['admin'])){ ?>
                    <li class="nav-item">
                        <a class = "nav-link" href="admin.php"><?php echo $_COOKIE['admin']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Đăng xuất</a>
                    </li>           
                <?php } ?>
            </ul>
        </nav>
    </div>
    <div class="d-flex" style="background-color: #e3f2fd;">
        <div class="p-2">
           <a href="manage_post.php">Quản lý bài viết</a>
       </div>
       <div class="p-2">
           <a href="manage_user.php">Quản lý tài khoản người dùng</a>
       </div>
       <div class="p-2">
           <a href="manage_category.php">Quản lý chủ đề </a>
       </div>
   </div>

</div>

</body>
</html>