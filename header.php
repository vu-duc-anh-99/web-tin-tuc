<?php  

include("db/class_home.php");
$dblib = new dblib();
$sql = "SELECT * FROM category";
$data = $dblib->get_list($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Web tin tức</title>

	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="css/style.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<header>
		<div class="container">
			<nav class="navbar navbar-expand-sm">
				<a class="nav-link" href="index.php">
					<img src="images/logo.png" width="400px" height="100px">
				</a>
				
				<div class="searchbar ml-auto">
					<form action="search_action.php" method="POST">
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
				<ul class="navbar-nav">
					<?php if(isset($_COOKIE['user'])){ ?>
						<li class="nav-item">
							<a class = "nav-link" href="#"><?php echo $_COOKIE['user']; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">Đăng xuất</a>
						</li>			
					<?php } else{ ?>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Đăng nhập</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="register.php">Đăng ký</a>
						</li>
					<?php } ?>
				</ul>

			</nav>
			
		</div>	
		<div id="sidebar">
			
			<?php $dblib->createMenu("category.php"); ?>
			
			<div id="sidebar-clear">
			</div>
		</div>	
	</header>
</body>
</html>