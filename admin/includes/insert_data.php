<?php
include_once ('admin_functions.php');
function convertToString($item){
    return "'".$item."'";
}
if(isset($_POST['add_category'])){
    $cat_title = convertToString($_POST['cat_title']);
    insert('categories','cat_title',$cat_title);
    header('Location: ../categories.php');
}