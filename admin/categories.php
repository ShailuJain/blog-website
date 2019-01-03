<?php
    $page_title = 'Categories';
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once ('includes/header.php');
?>

<body id="page-top"  class="sidebar-toggled">

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
            ?>

            <div class="row">
                <div class="col-md-6">
                    <?php
                    include_once ('pages/categories/add-category-form.php');
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    include_once ('pages/categories/edit-category-form.php');
                    ?>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-8 offset-md-2">
                    <?php
                    include_once ('pages/categories/view-all-categories.php');
                    ?>
                </div>
            </div>

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
