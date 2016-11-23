<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>

<?php
	$msg = "";
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update_submit'])){
		$update_name = $hlp->validation($_POST['update_name']);
		$update_location = $hlp->validation($_POST['update_location']);
		$update_username = $hlp->validation($_POST['update_username']);
		$update_dob = $hlp->validation($_POST['update_dob']);
		$update_about = $hlp->validation($_POST['update_about']);

		$update_name = mysqli_real_escape_string($db->link, $update_name);
		$update_location = mysqli_real_escape_string($db->link, $update_location);
		$update_username = mysqli_real_escape_string($db->link, $update_username);
		$update_dob = mysqli_real_escape_string($db->link, $update_dob);
		$update_about = mysqli_real_escape_string($db->link, $update_about);

		$update_query = "UPDATE tbl_users SET name='$update_name', country='$update_location', username='$update_username', about='$update_about', dob='$update_dob' WHERE id='$userId'";
		$update_res = $db->update($update_query);
		if($update_res){
			$msg = "Successfully Updated your informations.";
		} else {
			$msg = "Oops! Something wrong.";
		}
	}
?>

<?php
	$success = "";
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update_profPic_submit'])){
		$errors = array();
		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['update_profPic']['name'];
		$file_size = $_FILES['update_profPic']['size'];
		$file_temp = $_FILES['update_profPic']['tmp_name'];
		$file_type = $_FILES['update_profPic']['type'];
		$file_ext  = strtolower(end(explode('.',$file_name)));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploader_image = "uploads/".$unique_image;
		//$folder    = "uploads/";

		if(in_array($file_ext,$permited)=== false){
			$errors[]="extension not allowed, please choose a JPEG, PNG or GIF file.";
      	}
      
		if($file_size > 1000000){
			$errors[]='File size must be less than 1 MB';
		}
		
		if(empty($errors)==true){
			move_uploaded_file($file_temp, $uploader_image);
			$query = "UPDATE tbl_users SET prof_pic = '$uploader_image' WHERE id='$userId'";
			$inserted_row = $db->insert($query);
			if($inserted_row){
				'Uploaded Successfully!';
			} else{
				$success = 'Upload unsucced!';
		}
		}else{
			foreach ($errors as $error) {
				echo "<p>".$error."</p>";
			}
		}
	}
?>

<div class="profile-area">
	<div class="container">
		<div class="profile">
			<div class="profile-menu">
				<ul>
					<li><a href="index.php">Profile</a></li>
					<li><a class="active-menu" href="edit-profile.php">Edit profile</a></li>
					<li><a href="settings"></a></li>
				</ul>
			</div>

			<div class="profile-details">
				<div class="row">
					<div class="col-md-2">
						<div class="profile-image">
							<img src="<?php echo $get_user_row['prof_pic']; ?>" alt="">
							<p class=""><a href=""><?php echo $get_user_row['name']; ?></a></p>
							<!-- <span style="color: green;margin-top: 0;">ameture</span> -->
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<div class="col-sm-12">
										<input type="file" class="form-control custom-input" id="update_profPic" name="update_profPic" placeholder="Profile Pic">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<button type="submit" class="btn-custom" name="update_profPic_submit">Update Profile Pic</button><br><br>
									</div><br>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-10">
						<div class="profile-name">
							<h1>Edit Profile</h1>
							<form class="form-horizontal" action="" method="post">
								<div class="form-group">
									<label for="update_name" class="col-sm-2 control-label custom-label">Name</label>
									<div class="col-sm-8">
										<input type="text" value="<?php echo $get_user_row['name']; ?>" class="form-control custom-input" id="update_name" name="update_name" placeholder="Email">
									</div>
								</div>
								
								<div class="form-group">
									<label for="update_username" class="col-sm-2 control-label custom-label">Username</label>
									<div class="col-sm-8">
										<input type="text" value="<?php echo $get_user_row['username']; ?>" class="form-control custom-input" id="update_username" name="update_username" placeholder="Username">
									</div>
								</div>
								<div class="form-group">
									<label for="update_location" class="col-sm-2 control-label custom-label">Location</label>
									<div class="col-sm-8">
										<input type="text" value="<?php echo $get_user_row['country']; ?>" class="form-control custom-input" id="update_location" name="update_location" placeholder="Username">
									</div>
								</div>
								<div class="form-group">
									<label for="update_dob" class="col-sm-2 control-label custom-label">Date of Birth</label>
									<div class="col-sm-8">
										<input type="text" value="<?php echo $get_user_row['dob']; ?>" class="form-control custom-input" id="update_dob" name="update_dob" placeholder="15/2/2016">
									</div>
								</div>
								
								<div class="form-group">
									<label for="update_about" class="col-sm-2 control-label custom-label">About</label>
									<div class="col-sm-8">
										<textarea name="update_about" id="update_about" class="form-control custom-textarea" rows="6"><?php echo $get_user_row['about']; ?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn-custom" name="update_submit">Update</button><br><br>
									</div><br>
									
								</div>
								<?php if(!empty($msg)): ?>
									<div class="alert alert-success" role="alert"><?php echo $msg; ?></div>
								<?php endif; ?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php include 'includes/footer.php'; ?>