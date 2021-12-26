<?php
include '../db/class_admin.php';

$adminlib = new adminlib();
if(isset($_POST['login_action'])){
	$message = $adminlib->login();
	$error = $message[0];
	$data = $message[1];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Đăng nhập</title>

	<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="../css/style.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Đăng nhập</h5>
            <form class="form-signin" method="POST" action="login.php">
            	<label for="inputEmail">Email</label>
              <div class="form-label-group">
                <input type="email" onfocus="this.value=''" class="form-control" placeholder="Email" name="email" required autofocus>
              </div>

              <label for="inputPassword">Mật khẩu</label>
              <div class="form-label-group">
                <input type="password"  onfocus="this.value=''" class="form-control" placeholder="Password" name="password" required>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Lưu mật khẩu</label>
              </div>
              <!-- <?php echo isset($error['message'])? $error['message'] : "";  ?> -->
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="login_action">Đăng nhập</button>
              <hr class="my-4">
              <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>