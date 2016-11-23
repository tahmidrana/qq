<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>

    

    <div class="main-content-area">
        <div class="container">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <div class="content-area">
                        <div role="tabpanel">
                            <div class="question">
                                <h3>Questions</h3>
                            </div>
                            <!-- Nav tabs -->

                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation">
                                    <a href="#unanswered" aria-controls="home" role="tab" data-toggle="tab">Unanswered</a>
                                </li>
                                <li role="presentation">
                                    <a href="#mostAnswered" aria-controls="tab" role="tab" data-toggle="tab">Most Answered</a>
                                </li>
                                <li role="presentation">
                                    <a href="#mostVoted" aria-controls="tab" role="tab" data-toggle="tab">Most Voted</a>
                                </li>
                                <li role="presentation">
                                    <a href="#mostViewed" aria-controls="tab" role="tab" data-toggle="tab">Most Viewed</a>
                                </li>
                                <li role="presentation" class="active">
                                    <a href="#newest" aria-controls="tab" role="tab" data-toggle="tab">Newest</a>
                                </li>
                            </ul>
                        
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="newest">                      
                                                           
                                    <!-- single question start -->
                                    <?php
                                        //$query = "SELECT * FROM tbl_question ORDER BY id DESC";
                                        $query = "SELECT tbl_question.id AS q_id, question_title, question_body, vote, view,comment, 
                                                  datetime, tbl_users.name AS us_name, reputation FROM tbl_question
                                                  INNER JOIN tbl_users
                                                  ON tbl_users.id
                                                  WHERE tbl_users.id = tbl_question.user_id
                                                  ORDER BY tbl_question.id DESC LIMIT 20";
                                        $res = $db->select($query);
                                        if($res):
                                            while($post_new = mysqli_fetch_assoc($res)):
                                    ?>
                                    <div class="tab-row">
                                        <div class="row">
                                            <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">
                                                <div class="vote sec text-center">
                                                    <h4><?php echo $post_new['vote']; ?></h4>
                                                    <p>votes</p>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">
                                                <div class="answer sec text-center">
                                                    <h4><?php echo $post_new['comment']; ?></h4>
                                                    <p>answer</p>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1">
                                                <div class="view sec text-center">
                                                    <h4><?php echo $post_new['view']; ?></h4>
                                                    <p>view</p>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-lg-9 col-sm-9 col-xs-9">
                                                <div class="question-section">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <a href="singlePost.php?postid=<?php echo $post_new['q_id']; ?>" class="main-question"><?php echo $post_new['question_title']; ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="tags">
                                                                <a href="html" class="custom-tag">html</a><a href="" class="custom-tag">QQ</a><a href="" class="custom-tag">programming</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="user-details">
                                                                <p style="float: left;"><?php echo $hlp->convertDateToTime($post_new['datetime']); ?></p>
                                                                <a href=""><?php echo $hlp->nameModify($post_new['us_name']); ?></a>
                                                                <p><?php echo $post_new['reputation']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- single question ends -->

                                        <?php endwhile; ?>
                                    <?php endif; ?>



                                    


                                </div>


                                <div role="tabpanel" class="tab-pane" id="mostViewed">
                                    <?php include 'includes/mostViewed.php'; ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="mostVoted">
                                    <?php include 'includes/mostVoted.php'; ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="mostAnswered">
                                    <?php include 'includes/mostAnswered.php'; ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="unanswered">
                                    <?php include 'includes/unanswered.php'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'includes/right_sidebar.php'; ?>
            </div>
        </div>
    </div>


<?php include 'includes/footer.php'; ?>