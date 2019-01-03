<?php

include_once ('admin_connection.php');
include_once ('admin_functions.php');
if(isset($_POST['edit_category'])){
    $cat_title = $_POST['cat_title'];
    $cat_id = $_POST['cat_id'];
    $query = "UPDATE categories SET cat_title='$cat_title' WHERE cat_id=$cat_id";

    mysqli_query($connection, $query);
    checkForQueryError($connection);
    header('Location: ../categories.php');
}