<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'lib/Session.php'; ?>
<?php include 'helpers/Helper.php'; ?>
<?php Session::issetSession(); ?>
<?php
    $hlp = new Helper();
    $db = new Database();
?>

<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Question Queue</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/prism.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <script src="js/tinymce/tinymce.min.js"></script>
</head>
<body onload="init_all();">
    <div class="header-area">
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">Question <span class="title-design" style="color: #e67e22">Queue</span></a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav navbar-right">
						<?php if(Session::get('login')): ?>
							<li><a href="admin"><?php echo Session::get('user'); ?></a></li>
						<?php else: ?>
							<li><a href="admin/login.php">Log in</a></li>
							<li><a href="admin/register.php">Register</a></li>
						<?php endif; ?>
						<li><a href="#">About</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
	</div>