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
							<span style="color: green;margin-top: 0;"></span>
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

<div class="stats-area">
	<div class="container">
		<div class="stats">
			<div class="row">
				<div class="col-md-6">
					<div class="answers">
						<?php
							$ansList_query = "SELECT * FROM tbl_answer WHERE user_id='$singleUserid'";
							$ansList_res = $db->select($ansList_query);
							$ansList_num_row = '';
							if($ansList_res){
								$ansList_num_row = $ansList_res->num_rows;
							}
							$i = 1;
						?>
						<h1><span style="color: #ccc; margin-right: 10px;"><?php echo $ansList_num_row; ?></span>Answers</h1>
						<ul class="answer-list">
							<?php
								if($ansList_res):
									while ($ansList_row = $ansList_res->fetch_assoc()):
							?>
							<li><span><?php echo $i; ?></span><a class="" href="../singlePost.php?postid=<?php echo $ansList_row['question_id']; ?>" style="display: block; overflow: hidden; padding-left: 10px;"><?php echo $hlp->stringModify($ansList_row['ans_body']); ?></a></li>
								<?php $i++; endwhile;  ?>
							<?php else: ?>
								<li><h3>No Answers yet.</h3></li>
							<?php endif; ?>
							<!-- <li><a class="" href="">more >></a></li> -->
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="answers">
						<?php
							$questionList_query = "SELECT * FROM tbl_question WHERE user_id='$singleUserid'";
							$questionList_res = $db->select($questionList_query);
							$questionList_num_row  = '';
							if($questionList_res){
								$questionList_num_row = $questionList_res->num_rows;
							}
						?>
						<h1><span style="color: #ccc; margin-right: 10px;"><?php echo $questionList_num_row; ?></span>Questions</h1>
						<ul class="answer-list">
							<?php
							if($questionList_num_row > 0):
								while ($questionList_row = $questionList_res->fetch_assoc()):
							?>
							<li><span><?php echo $questionList_row['vote']; ?></span><a class="" href="../singlePost.php?postid=<?php echo $questionList_row['id']; ?>" style="display: block; overflow: hidden;  padding-left: 10px;"><?php echo $questionList_row['question_title']; ?></a></li>
								
								<?php endwhile;  ?>
							<?php else: ?>
								<li><h3>No Questions yet.</h3></li>
							<?php endif; ?>
							<!-- <li><a class="" href="">more >></a></li> -->
						</ul>
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