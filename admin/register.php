<?php 
	include '../lib/Session.php';
	Session::checkLogin();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Helper.php'; ?>
<?php
	$db = new Database();
	$helper = new Helper();
?>

<?php
	$error = $msg = "";
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register_submit'])){
		//echo '<pre>';
		//var_dump($_POST);
		$reg_name = $helper->validation($_POST['register_name']);
		$reg_email = $helper->validation($_POST['register_email']);
		$reg_pass = $helper->validation(md5($_POST['register_password']));
		$reg_username = $helper->validation($_POST['register_username']);

		$reg_name = mysqli_real_escape_string($db->link, $reg_name);
		$reg_email = mysqli_real_escape_string($db->link, $reg_email);
		$reg_pass = mysqli_real_escape_string($db->link, $reg_pass);
		$reg_username = mysqli_real_escape_string($db->link, $reg_username);


		if($reg_country == '')
			$reg_country = "Not set";
		$query = "INSERT INTO tbl_users(name, email, password, username) VALUES('$reg_name', '$reg_email', '$reg_pass', '$reg_username')";
		$register = $db->insert($query);
		if($register){
			$msg = "Congrats! You are registered successfully.";
		} else {
			$msg = "Oops! Something wrong.";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/main.css">
	
</head>
<body>
	<h2 class="text-center title" style=""><a href="http://localhost/qq" style="text-decoration: none; color: #9D9D9D;">Question <span style="color: #e67e22;">Queue</span></a></h2>
	<div class="login-area">
		<div class="login-form">
			<h1 class="text-center">Register</h1>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Full Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control custom-input" id="name" name="register_name" placeholder="Full Name" required>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="text" class="form-control custom-input" id="email" name="register_email" placeholder="Email" required>
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control custom-input" id="inputEmail3" placeholder="User name">
					</div>
				</div> -->
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-10">
						<input type="text" class="form-control custom-input" id="username" name="register_username" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control custom-input" id="password" name="register_password" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="register_submit" class="btn-custom">Sign in</button><br><br>
						<a href="login.php">Already registered? Log in</a>
						<span style="color: #e67e22"><?php if($msg) echo "<br>".$msg; ?></span>
					</div>

				</div>
			</form>
		</div>
	</div>
</body>
</html>