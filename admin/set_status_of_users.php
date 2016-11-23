<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php
	$db = new Database();
	$action = $_GET['ac'];
	$id = $_GET['update_user_id'];
	$query;
	//echo $action;
	if($action == 'activate'){
		$query = "UPDATE tbl_users SET status='1' WHERE id='$id'";
		//$update = $db->update($query);
	} else if($action == 'deactivate'){
		$query = "UPDATE tbl_users SET status='0' WHERE id='$id'";
		//$update = $db->update($query);
	}

	$update = $db->update($query);
	if($update){
		//echo "Updated!";
	} else {
		//echo "Something wrong!";
	}
	//$query = mysqli_query($conn, "SELECT * FROM tbl_users");
?>

