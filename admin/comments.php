<?php
    ob_start();
    $page_title = 'Comments';
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once ('includes/header.php');
?>

  <body id="page-top" class="sidebar-toggled">

  <?php
  include_once ('includes/navigation.php');
  ?>

    <div id="wrapper">

      <!-- Sidebar -->
        <?php
        include_once ('includes/sidebar.php');
        ?>

      <div id="content-wrapper">

        <div class="container-fluid">

            <?php
            include_once ('includes/breadcrumbs.php');
            include_once ('../includes/connection.php');
            if(isset($_GET['source'])){
                $source = $_GET['source'];
            }else{
                $source = '';
            }
            switch($source){
                case 'approved':
                    if(isset($_GET['comment_id'])){
                        $comment_id = $_GET['comment_id'];
                        $query = "UPDATE comments SET comment_status='approved' WHERE comment_id = $comment_id";
                        mysqli_query($connection,$query);
                        if(mysqli_errno($connection)){
                            die(mysqli_error($connection));
                        }
                    }
                    break;
                case 'unapproved':
                    if(isset($_GET['comment_id'])){
                        $comment_id = $_GET['comment_id'];
                        $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id = $comment_id";
                        mysqli_query($connection,$query);
                        if(mysqli_errno($connection)){
                            die(mysqli_error($connection));
                        }
                    }
                    break;
                case 'delete_comment':
                    if(isset($_GET['comment_id'])){
                        $comment_id = $_GET['comment_id'];
                        $query = "DELETE FROM comments WHERE comment_id = $comment_id";
                        mysqli_query($connection,$query);
                        if(mysqli_errno($connection)){
                            die(mysqli_error($connection));
                        }
                    }
                    break;
            }
            include_once ('pages/comments/view-all-comments.php');
            ?>
        </div>
        <!-- /.container-fluid -->

          <?php
          include_once ('includes/footer.php');
          ?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

  <?php
  include_once ('includes/scripts.php')
  ?>

  </body>

</html>
