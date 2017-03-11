<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>
<?php
	if(Session::get('role') == 0){
		header("Location: index.php");
	}
?>


<div class="profile-area">
	<div class="container">
		<div class="profile">
			<div class="profile-menu">
				<ul>
					<li><a class="active-menu" href="index.php">Profile</a></li>
					<li><a href="edit-profile.php">Edit profile</a></li>
				</ul>
			</div>

			<div class="profile-details">
				<div class="row">
					<div class="col-md-2">
						<div class="profile-image">
							<img src="<?php echo $get_user_row['prof_pic']; ?>" alt="">
							<p class=""><a href=""><?php echo $get_user_row['name']; ?></a></p>
							<span style="color: green;margin-top: 0;"></span>
						</div>
					</div>
					<div class="col-md-10">
						<div class="profile-name">
							<h1><?php echo $get_user_row['name']; ?></h1>
							<table class="table" style="width: 400px; font-size: 16px;">
								<tr>
									<td>Email: </td>
									<td><?php echo $get_user_row['email']; ?></td>
								</tr>
								<tr>
									<td>Location: </td>
									<td><?php echo $get_user_row['country']; ?></td>
								</tr>
								<tr>
									<td>Member Since: </td>
									<td><?php echo $hlp->dateFormate($get_user_row['registration_date']); ?></td>
								</tr>
								<tr>
									<td>Profile Visits: </td>
									<td>1452</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="stats-area">
	<div class="container">
		<div class="stats">
			<div class="row">
				<div class="col-md-12">
					<div class="answers">
						<?php
							$sql = "SELECT * FROM tbl_users ORDER BY id DESC";
							$user_res = $db->select($sql);
							$num_users = $user_res->num_rows;
						?>
						<h1><span style="color: #ccc; margin-right: 10px;"><?php echo $num_users; ?></span>Users</h1>
						<table class="custom-table">
							<tr>
								<th>Name</th>
								<th>Question</th>
								<th>Answer</th>
								<th>Action</th>
							</tr>

							<tbody id="tbl_all_users">
								
							</tbody>
							

							
						</table>
					</div>
				</div>
				
			
			</div>
			<!-- <div class="row">
				<div class="col-md-6">
					<div class="answers">
						<h1><span style="color: #ccc; margin-right: 10px;">52</span>Tags</h1>
						<div class="row">
							<div class="col-md-3">
								<a href="" class="custom-tag">html</a>
								<a href="" class="custom-tag">css</a>
								<a href="" class="custom-tag">html</a>
								<a href="" class="custom-tag">html</a>
								<a href="" class="custom-tag">html</a>	
							</div>					
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="answers">
						<h1><span style="color: #ccc; margin-right: 10px;">52</span>Badges</h1>
						<div class="row">
							<div class="col-md-3">
								<a href="" class="custom-tag">html</a>
								<a href="" class="custom-tag">css</a>
								<a href="" class="custom-tag">html</a>
								<a href="" class="custom-tag">html</a>
								<a href="" class="custom-tag">html</a>	
							</div>					
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</div>


<?php include 'includes/footer.php'; ?>