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
	$error = "";
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login_submit'])){
		$email = $helper->validation($_POST['login_email']);
		$password = $helper->validation(md5($_POST['login_password']));

		$username = mysqli_real_escape_string($db->link, $email);
		$password = mysqli_real_escape_string($db->link, $password);
		$query = "SELECT * FROM tbl_users WHERE email='$email' AND password='$password' AND role='1'";
		$login = $db->select($query);
		
		if($login) {
			$value = $login->fetch_assoc();
			$row = mysqli_num_rows($login);
			if($row > 0){
				Session::set("login", true);
				Session::set("userId", $value['id']);
				Session::set("userMail", $value['email']);
				Session::set("user", $value['name']);
				Session::set("role", $value['role']);
				header("Location: superAdmin.php");
			} else {

			}
		} else {
			$error = "<span style='color: red; font-size: 18px;'>Username of password not matched!!!</span>";
			//echo "<span style='color: red; font-size: 18px;'>Username of password not matched!!!</span>";
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/main.css">
	
</head>
<body>
	<h2 class="text-center title" style="">Question <span style="color: #e67e22;">Queue</span></h2>
	<div class="login-area">
		<div class="login-form">
			<h1 class="text-center">Login</h1>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control custom-input" id="inputEmail3" name="login_email" placeholder="Email" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control custom-input" id="inputPassword3" name="login_password" placeholder="Password" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn-custom" name="login_submit">Sign in</button><br><br>
						<a href="register.php">Don't have an ID? Register</a><br>
						<?php if($error) echo $error; ?>
					</div>

				</div>

			</form>
		</div>
	</div>
</body>
</html>