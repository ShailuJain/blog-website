<?php
include_once ('connection.php');

function get_all_posts($condition = 1){
    global $connection;
    $sql = "SELECT * FROM posts WHERE $condition";
    return mysqli_query($connection,$sql);

}
function get_all_categories($condition = 1){
    global $connection;
    $sql = "SELECT * FROM categories WHERE $condition";
    $result = mysqli_query($connection, $sql);
    $categories = array();
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
        $single_array = array();
        $single_array['cat_id'] = $row['cat_id'];
        $single_array['cat_title'] = $row['cat_title'];
        $categories[$i++] = $single_array;
    }
    return $categories;
}
function get_all_comments($condition = 1){
    global $connection;
    $sql = "SELECT * FROM comments WHERE $condition";
    return mysqli_query($connection, $sql);
}