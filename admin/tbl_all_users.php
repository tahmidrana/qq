<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php
	$db = new Database();
	$sql = "SELECT * FROM tbl_users ORDER BY id DESC";
	$user_res = $db->select($sql);
	$num_users = $user_res->num_rows;
?>



<?php
	if($num_users > 0):
		while ($users = $user_res->fetch_assoc()):
?>
			<tr>
				<td><a href="singleUser.php?userId=<?php echo $users['id']; ?>"><?php echo $users['name']; ?></a></td>
				<td><?php echo $users['no_of_ques']; ?></td>
				<td><?php echo $users['no_of_ans']; ?></td>
				<td><?php if($users['status'] == 0): ?>
						<button class="btn btn-primary btn-custom" style="background: #16a085;" onclick="set_status_of_users(<?php echo $users['id']; ?>, 0)">Activate</button>
					<?php else: ?>
						<Button class="btn btn-custom" style="background: #e74c3c;" onclick="set_status_of_users(<?php echo $users['id']; ?>, 1)">Deactivate</Button>
					<?php endif; ?>
			</tr>
		<?php endwhile; ?>
	<?php else: ?>
		<tr>
			<td colspan="4">No users Yet.</td>
		</tr>
	<?php endif; ?>