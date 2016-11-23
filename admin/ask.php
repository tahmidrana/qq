<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>

<?php
	$db = new Database();
	$helper = new Helper();
?>

<?php
	$msg = "";
	$user_id = Session::get("userId");
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_submit'])){
		$post_title = $helper->validation($_POST['post_title']);
		$post_body = $_POST['post_body'];

		$post_title = mysqli_real_escape_string($db->link, $post_title);

		$query = "INSERT INTO tbl_question(question_title, question_body, user_id, datetime) VALUES('$post_title', '$post_body', '$user_id', NOW())";

		$post = $db->insert($query);
		if($post){
			$msg = "Your question added!";
			$update_query = "UPDATE tbl_users SET no_of_ques=no_of_ques+1 WHERE id='$user_id'";
			$db->update($update_query);
		} else {
			$msg = "Oops! Something wrong!";
		}
		

	}
?>

<div class="main-ask-area">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="ask-question-area">
					<form class="form-horizontal" action="" method="post">
						<div class="form-group">
							<label for="post_title" class="col-md-1 control-label">Title</label>
							<div class="col-md-11">
								<input type="text" class="form-control custom-input" id="post_title" name="post_title" placeholder="Title" required>
							</div>
						</div>
						<div class="form-group ">
							<div class="col-md-12">
								<div class="custom-textarea">
									<textarea id="mytextarea" class="form-control custom-input" name="post_body" rows=""></textarea>
								</div>
								
							</div>
						</div>
						<div class="form-group col-md-12">
							<input type="submit" class="btn-custom" name="post_submit" value="Post your question">
						</div>
					</form>
					<br>
					<span style="color: #e67e22; display: block; overflow: hidden; width: 100%;"><?php if($msg) echo "<br>".$msg; ?></span>
				</div>
			</div>
			<div class="col-md-4">
				<div class="rules-area">
					<div class="post-rules">
						<ul>
							<li>Use a title for your question.</li>
							<li>First search the question and if can't then post it here.</li>
							<li>Use a online code compiler and give the link here in case of PHP code. Suh as <a href="http://www.ideone.com">Ideone</a></li>
							<li>Any image size must be less then 1 mb</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'includes/footer.php'; ?>