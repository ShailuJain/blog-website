<div class="row">
<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>Post Title</th>
                <th>Date</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            include_once ('../includes/functions.php');
            $result_set = get_all_comments();
            while($row = mysqli_fetch_assoc($result_set)){
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
//                $post_title = $row['post_title'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];


                //FETCH POST_TITLE FROM COMMENT_POST_ID
                $post_result_set = get_all_posts("post_id = $comment_post_id");
                if($post_result_set = mysqli_fetch_assoc($post_result_set)){
                    $post_title = $post_result_set['post_title'];
                }else{
                    $post_title = "Something Went Wrong!";
                }
                echo<<<COMMENT
<tr>
<td>$comment_id</td>
<td>$comment_author</td>
<td>$comment_content</td>
<td>$comment_email</td>
<td>$comment_status</td>
<td><a href="http://localhost:8080/blog-website/post.php?post_id=$comment_post_id">$post_title</a></td>
<td>$comment_date</td>
<td><a href="comments.php?source=approved&comment_id=$comment_id" class="btn btn-info"><span class="fa fa-thumbs-up"></span></a></i></td>
<td><a href="comments.php?source=unapproved&comment_id=$comment_id" class="btn btn-danger"><span class="fa fa-thumbs-down"></span></a></i></td>
<td><a href="comments.php?source=delete_comment&comment_id=$comment_id" class="btn btn-danger"><span class="fa fa-trash"></span></a></i></td>
</tr>
COMMENT;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>