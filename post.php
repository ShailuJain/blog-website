<?php
$page_title = "Blog Post";
?>
<!DOCTYPE html>
<html lang="en">

    <!-- START   HEADER-->
    <?php
    include_once ('includes/header.php');
    ?>
    <!-- END   HEADER-->

  <body>

      <!--START    NAVIGATION-->
      <?php
      include_once ('includes/navigation.php');
      ?>
      <!--END    NAVIGATION-->
    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">
            <?php
            include_once ('includes/connection.php');
            include_once ('includes/functions.php');
            if(isset($_GET['post_id'])){
                $post_id = $_GET['post_id'];
                $query_all_posts = "SELECT * FROM posts WHERE post_id = {$post_id}";
                $all_post_result = mysqli_query($connection,$query_all_posts);

                if ($post = mysqli_fetch_assoc($all_post_result)) {
                    $post_id = $post['post_id'];
                    $post_title = $post['post_title'];
                    $post_author = $post['post_author'];
                    $post_date = $post['post_date'];
                    $post_content = $post['post_content'];
                    $post_tags = $post['post_tags'];
                    $post_image = $post['post_image'];
                    ?>

                    <!-- Title -->
                    <h1 class="mt-4"><?php echo $post_title; ?></h1>

                    <!-- Author -->
                    <p class="lead">
                        by
                        <a href="#"><?php echo $post_author; ?></a>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p>Posted on <?php echo $post_date; ?></p>

                    <hr>

                    <!-- Preview Image -->
                    <img class="img-fluid rounded" src="images/<?php echo $post_image; ?>" alt="">

                    <hr>

                    <!-- Post Content -->
                    <p><?php echo $post_content; ?></p>

                    <hr>

                    <?php
                    if(isset($_POST['post_comment'])){
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        $comment_date = date("Y-m-d");
                        $sql = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_date) VALUES (?,?,?,?,?)";
                        $prepared_stmt = mysqli_prepare($connection,$sql);

                        mysqli_stmt_bind_param($prepared_stmt,"dssss",$post_id,$comment_author,$comment_email,$comment_content,$comment_date);

                        mysqli_stmt_execute($prepared_stmt);
                        if(mysqli_errno($connection)){
                            die("Error in inserting ". mysqli_errno($connection));
                        }

                    }
                    ?>
                    <!-- Comments Form -->
                    <div class="card my-4">
                        <h5 class="card-header">Leave a Comment:</h5>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="comment_author">Author</label>
                                    <input type="text" class="form-control" name="comment_author" id="comment_author">
                                </div>
                                <div class="form-group">
                                    <label for="comment_email">Email</label>
                                    <input type="text" class="form-control" name="comment_email" id="comment_email">
                                </div>
                                <div class="form-group">
                                    <label for="">Comment</label>
                                    <textarea class="form-control" rows="3" name="comment_content" id="comment_content"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="post_comment">Submit</button>
                            </form>
                        </div>
                    </div>

                    <?php
                    $condition = "comment_post_id = $post_id and comment_status='approved'";
                    $comments_result = get_all_comments($condition);
                    while($comment = mysqli_fetch_assoc($comments_result)) {
                        $comment_author = $comment['comment_author'];
                        $comment_date = $comment['comment_date'];
                        $comment_content = $comment['comment_content'];
                        ?>
                        <!-- Single Comment -->
                        <div class="media mb-4">
                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                            <div class="media-body">
                                <h5 class="mt-0"><?php echo $comment_author; ?> <span class="small"><?php echo $comment_date; ?></span></h5>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>

                        <?php
                    }
                }
            }
            ?>
        </div>

          <!--START Sidebar Widgets Column -->
          <?php
          include_once ('includes/sidebar.php');
          ?>
          <!--END Sidebar Widgets Column -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

      <!--START Footer -->
      <?php
      include_once ('includes/footer.php');
      ?>
      <!--END Footer -->

      <!--START CORE SCRIPTS -->
      <?php
      include_once ('includes/core-scripts.php');
      ?>
      <!--END CORE SCRIPTS -->

  </body>

</html>
