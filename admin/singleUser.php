<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>
<?php
	$singleUserid = $_GET['userId'];
	//echo "<h1>$singleUserid</h1>";
	$single_user_row;
	$query_single_user = "SELECT * FROM tbl_users WHERE id='$singleUserid'";
	$single_user_res = $db->select($query_single_user);
	if($single_user_res){
		$single_user_row = $single_user_res->fetch_assoc();
	}
?>


<div class="profile-area">
	<div class="container">
		<div class="profile">

			<div class="profile-details">
				<div class="row">
					<div class="col-md-2">
						<div class="profile-image">
							<img src="<?php echo $single_user_row['prof_pic']; ?>" alt="">
							<p class=""><a href=""><?php echo $single_user_row['name']; ?></a></p>
							<span style="color: green;margin-top: 0;">ameture</span>
						</div>
					</div>
					<div class="col-md-10">
						<div class="profile-name">
							<h1><?php echo $single_user_row['name']; ?></h1>
							<table class="table" style="width: 400px; font-size: 16px;">
								<tr>
									<td>Email: </td>
									<td><?php echo $single_user_row['email']; ?></td>
								</tr>
								<tr>
									<td>Location: </td>
									<td><?php echo $single_user_row['country']; ?></td>
								</tr>
								<tr>
									<td>Member Since: </td>
									<td><?php echo $hlp->dateFormate($single_user_row['registration_date']); ?></td>
								</tr>
								<tr>
									<td>Profile Visits: </td>
									<td>1452</td>
								</tr>
								<tr>
									<td>Status: </td>
									<td><?php if($single_user_row['status']==1){
										echo "Active";
									} else{
										echo "Deactivated";
										} ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php include 'includes/footer.php'; ?>