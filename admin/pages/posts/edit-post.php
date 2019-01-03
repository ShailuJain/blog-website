<?php
include_once ('../includes/connection.php');
if(isset($_POST['edit_post']) && isset($_GET['post_id'])){
    $edit_post_id = $_POST['post_id'];
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_cat_id = $_POST['post_cat_id'];
    $post_status = $_POST['post_status'];

    $old_image = $_POST['old_image'];

    $post_image = $_FILES['post_image']['name'];
    if($post_image ==""){
        $post_image = $old_image;
    }else{
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        move_uploaded_file($post_image_temp,"../images/$post_image");
    }

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];


    //INSERTING VALUES WITH PREPARED STATEMENT

    $query = "UPDATE posts SET post_cat_id = ?, post_title = ?, post_author = ?, post_image = ?, post_content = ?, post_tags = ?, post_status = ? WHERE post_id = ?";

    $prepared_statement = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($prepared_statement, "dssssssd",$post_cat_id,$post_title,$post_author,$post_image,$post_content, $post_tags, $post_status, $edit_post_id);


    mysqli_stmt_execute($prepared_statement);

    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }
    header('Location: posts.php');
}
?>
<?php
if(isset($_GET['source'])) {
    $edit_post_id = $_GET['post_id'];
    $query = "SELECT * FROM posts WHERE post_id = $edit_post_id";
    $result = mysqli_query($connection, $query);
    if($row = mysqli_fetch_assoc($result)){
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_cat_id = $row['post_cat_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
    ?>
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post" role="form" enctype="multipart/form-data">
                <legend>Edit New Post</legend>
                <input type="hidden" name="post_id" value="<?php echo $edit_post_id; ?>">
                <div class="form-group">
                    <label for="post_title">Post Title</label>
                    <input type="text" class="form-control" name="post_title" id="post_title"
                           value="<?php echo $post_title; ?>">
                </div>
                <div class="form-group">
                    <label for="post_cat_id">Post Category</label>
                    <select class="form-control" name="post_cat_id" id="post_cat_id">
                        <?php
                        include_once('../includes/functions.php');
                        $categories = get_all_categories();
                        $count = count($categories);
                        $i = 0;
                        while ($i < $count) {
                            $cat_id = $categories[$i]['cat_id'];
                            $cat_title = $categories[$i]['cat_title'];
                            $selected = $cat_id == $post_cat_id ? 'selected' : '';
                            echo "<option value='$cat_id' $selected>$cat_title</option>";
                            $i++;
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post_author">Post Author</label>
                    <input type="text" class="form-control" name="post_author" id="post_author"
                           value="<?php echo $post_author; ?>">
                </div>
                <div class="form-group">
                    <label for="post_status">Post Status</label>
                    <select class="form-control" name="post_status" id="post_status">
                        <option value="draft" <?php echo $post_status == 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="published" <?php echo $post_status == 'published' ? 'selected' : '' ?>>
                            Published
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="post_image">Post Image</label>
                    <input type="hidden" name="old_image" id="old_image" value="<?php echo $post_image; ?>">
                    <input type="file" class="form-control-file" name="post_image" id="post_image">
                </div>
                <div class="form-group">
                    <label for="post_tags">Post Tags</label>
                    <input type="text" class="form-control" name="post_tags" id="post_tags"
                           value="<?php echo $post_tags; ?>">
                </div>

                <div class="form-group">
                    <label for="post_content">Post Content</label>
                    <textarea type="text" class="form-control" name="post_content" id="post_content" rows="3"
                              cols="10"><?php echo $post_content; ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary" name="edit_post" id="edit_post">Edit Post</button>
            </form>
        </div>
    </div>
    <?php
    }
}
    ?>