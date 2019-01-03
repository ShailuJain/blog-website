<?php
if(isset($_POST['publish_post'])){
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_cat_id = $_POST['post_cat_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    $post_date = date('Y-m-d');

    move_uploaded_file($post_image_temp,"../images/$post_image");

    //INSERTING VALUES WITH PREPARED STATEMENT

    include_once ('../includes/connection.php');
    include_once ('includes/admin_functions.php');
    $query = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES(?,?,?,?,?,?,?,?)";

    $prepared_statement = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($prepared_statement, "dsssssss",$post_cat_id,$post_title,$post_author,$post_date,$post_image,$post_content, $post_tags, $post_status);


    mysqli_stmt_execute($prepared_statement);

    checkForQueryError($connection);
    header('Location: posts.php');
}
?>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <legend>Add New Post</legend>

            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input type="text" class="form-control" name="post_title" id="post_title">
            </div>
            <div class="form-group">
                <label for="post_cat_id">Post Category</label>
                <select class="form-control" name="post_cat_id" id="post_cat_id">
                <?php
                include_once ('../includes/functions.php');
                $categories = get_all_categories();
                $count = count($categories);
                $i = 0;
                while($i<$count){
                    $cat_id = $categories[$i]['cat_id'];
                    $cat_title = $categories[$i]['cat_title'];
                    echo"<option value='$cat_id'>$cat_title</option>";
                    $i++;
                }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="post_author">Post Author</label>
                <input type="text" class="form-control" name="post_author" id="post_author">
            </div>
            <div class="form-group">
                <label for="post_status">Post Status</label>
                <select class="form-control" name="post_status" id="post_status">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>
            <div class="form-group">
                <label for="post_image">Post Image</label>
                <input type="file" class="form-control-file" name="post_image" id="post_image">
            </div>
            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input type="text" class="form-control" name="post_tags" id="post_tags">
            </div>

            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea type="text" class="form-control" name="post_content" id="post_content" rows="3" cols="10"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="publish_post" id="publish_post">Publish Post</button>
        </form>
    </div>
</div>