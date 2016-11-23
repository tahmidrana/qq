<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>
<?php
    $msg = $error = "";
    $post_id = $_GET['postid'];
    $user_id = Session::get("userId");
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer_submit']) && !empty($_POST['answer_body'])){
        if(!Session::get("login")){
            $error = "You must be logged in to answer.";
        } else {
            
            if(isset($_POST['answer_body'])){
                $ans_body = $_POST['answer_body'];
                $add_ans = "INSERT INTO tbl_answer(user_id, question_id, ans_body) VALUES('$user_id', '$post_id', '$ans_body')";
                $add_ans = $db->insert($add_ans);
                
                $inc_comment = "UPDATE tbl_question SET comment = comment+1 WHERE id='$post_id'";
                $db->update($inc_comment);

                $db->update("UPDATE tbl_users SET no_of_ans = no_of_ans+1 WHERE id='$user_id'");
                if ($add_ans) {
                    $msg = "Success";
                } else {
                    $error = "Something wrong!";
                }
            } else {
                $error = "Add some appropriate ans";
            }
        }
    }
    $inc_view = "UPDATE tbl_question SET view = view+1 WHERE id='$post_id'";
    $db->update($inc_view);
?>
<?php
                                
    $query = "SELECT * FROM tbl_question WHERE id='$post_id'";
    $res = $db->select($query);
    if($res):
        $single_post = mysqli_fetch_assoc($res);
    
?>

    

    <div class="main-content-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <div class="content-area">
                        
                        <div role="tabpanel">
                            
                            <div class="" >
                                <h3 style="font-size: 26px; color: #7f8c8d;">Q. <?php echo $single_post['question_title']; ?></h3>
                                <hr>
                            </div>
                            <div class="question-body">
                                <div class="question-body-left">
                                    <a href="" data-toggle="tooltip" data-placement="top" title="Like the post"><i class="fa fa-thumbs-o-up"></i></a><br>
                                    <p data-toggle="tooltip" data-placement="top" title="People liked the post"><?php echo $single_post['vote']; ?></p>
                                    <a href="" data-toggle="tooltip" data-placement="top" title="Unlike the post"><i class="fa fa-thumbs-o-down"></i></a>
                                    
                                </div>
                                <div class="question-body-main">
                                    <p><?php echo $single_post['question_body']; ?></p>
                                </div>
                            </div>
                            
                            <!-- start of answer area -->
                            <div class="answer-area"> 
                                <h1 style="color: #7f8c8d;">Answers</h1>
                                <hr>
                                <?php
                                    $all_answers = "SELECT tbl_answer.id AS answer_id, user_id, question_id, ans_body, datetime, tbl_users.name AS us_name FROM tbl_answer
                                        INNER JOIN tbl_users
                                        ON tbl_users.id
                                        WHERE tbl_users.id = tbl_answer.user_id AND tbl_answer.question_id='$post_id'
                                        ORDER BY tbl_answer.id DESC";
                                    $all_answers = $db->select($all_answers);
                                    if($all_answers):
                                        while ($answers = mysqli_fetch_assoc($all_answers)):
                                ?>
                                            <div class="all-answers-body-main">
                                                <div class="question-body-left">
                                                    <a href="" data-toggle="tooltip" data-placement="top" title="Like the post"><i class="fa fa-thumbs-o-up"></i></a><br>
                                                    <p data-toggle="tooltip" data-placement="top" title="People liked the post">54</p>
                                                    <a href="" data-toggle="tooltip" data-placement="top" title="Unlike the post"><i class="fa fa-thumbs-o-down"></i></a>
                                                </div>
                                                <div class="all-answeres">
                                                    <div class="answers-all">
                                                        <p><?php echo $answers['ans_body']; ?></p>
                                                        <div class="user-area">
                                                            <p>answered at <span style="color: #E87C71"><?php echo $hlp->dateFormate($answers['datetime']); ?></span> by <a href="admin/" style="color: #E87C71"><?php echo $answers['us_name']; ?></a></p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                <div class="comment-form hidden" id="">
                                                    <form class="form-horizontal" action="" method="post" style="width: 84%;float: right; margin-top: 10px;">
                                                        <div class="form-group ">
                                                            <div class="col-md-12">
                                                                <div class="custom-textarea">
                                                                    <textarea id="" class="form-control custom-input wmd-panel" name="comment_body" rows="" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <input type="submit" class="btn-custom" name="comment_submit" value="comment">
                                                        </div>
                                                        
                                                    </form>
                                                </div>
                                                <br><br>
                                            </div>
                                        <?php endwhile; ?>
                                                    
                                    <?php else: echo "<h3>No Answers yet.</h3>";?>
                                    <?php endif; ?>
                                            
                                            <hr>
                                            <div class="post-answer">
                                                <h1 style="color: #7f8c8d;">Your Answer</h1>
                                                <form class="form-horizontal" action="" method="post">
                                                    <div class="form-group ">
                                                        <div class="col-md-12">
                                                            <div class="custom-textarea">
                                                                <textarea id="mytextarea" class="form-control custom-input" name="answer_body" rows="" ></textarea>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input type="submit" class="btn-custom" name="answer_submit" value="Post your answer">
                                                    </div>
                                                </form>
                                                <br><br><br>
                                                <?php 
                                                    if(!empty($error)):
                                                ?>
                                                    <div class="alert alert-dismissible alert-danger">
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                        <strong>Oh snap!</strong> <?php echo $error; ?>
                                                    </div>
                                                    <?php elseif(!empty($msg)): ?>
                                                    <div class="alert alert-dismissible alert-success">
                                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                        <strong>Success!</strong> <a href="#" class="alert-link">Successfully added your answer</a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                            </div> <!-- end of answer area -->
                        </div>
                        
                        
                        
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="sidebar-area">
                        <div class="row">
                            <div class="total-user-details">
                                <h2>Question Details</h2>
                                <table>
                                    <tr>
                                        <td><h3>Asked </h3></td>
                                        <td><h3><?php echo ' : '.$hlp->convertDateToTime($single_post['datetime']); ?></h3></td>
                                    </tr>
                                    <tr>
                                        <td><h3>Total View </h3></td>
                                        <td><h3><?php echo ' : '.$single_post['view']; ?></h3></td>
                                    </tr>
                                    <tr>
                                        <td><h3>Total Answer </h3></td>
                                        <td><h3><?php echo ' : '.$single_post['comment']; ?></h3></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php else: ?>
                            <h1 style="color: #7f8c8d;">Error!! The Post is removed.</h1>
                        <?php endif; ?>
                        <div class="row">
                            <div class="all-tags">
                                <h2>All tags</h2>
                                <a href="" class="custom-tag">html</a>
                                <a href="" class="custom-tag">css</a>
                                <a href="" class="custom-tag">php</a>
                                <a href="" class="custom-tag">mysql</a>
                                <a href="" class="custom-tag">javascript</a>
                                <a href="" class="custom-tag">html5</a>
                                <a href="" class="custom-tag">mysql</a>
                                <a href="" class="custom-tag">javascript</a>

                                <a href="" class="custom-tag">mysql</a>
                                <a href="" class="custom-tag">javascript</a>

                                <a href="" class="custom-tag">mysql</a>
                                <a href="" class="custom-tag">javascript</a>

                                <a href="" class="custom-tag">mysql</a>
                                <a href="" class="custom-tag">javascript</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include 'includes/footer.php'; ?>