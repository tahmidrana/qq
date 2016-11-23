<?php
    $user_count = "SELECT * FROM tbl_users";
    $user_count_res = $db->select($user_count);

    $question_count = "SELECT * FROM tbl_question";
    $question_count_res = $db->select($question_count);

    $question_ans = "SELECT * FROM tbl_answer";
    $question_ans_res = $db->select($question_ans);

?>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    <div class="sidebar-area">
        <div class="row">
            <div class="total-user-details">
                <h2>User Details</h2>
                <table class="">
                    <tr>
                        <td><h3>Active User </h3></td>
                        <td><h3><?php echo ' : '.$user_count_res->num_rows; ?></h3></td>
                    </tr>
                    <tr>
                        <td><h3>Total Question </h3></td>
                        <td><h3><?php echo ' : '.$question_count_res->num_rows; ?></h3></td>
                    </tr>
                    <tr>
                        <td><h3>Total Answer </h3></td>
                        <td><h3><?php echo ' : '.$question_ans_res->num_rows; ?></h3></td>
                    </tr>
                </table>
            </div>
        </div>
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