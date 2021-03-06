<?php include_once 'includes/header.php' ?>

<?php
if (!$session->is_signed_in()) {
    redirect("login.php");
}
?>

<?php
$photos = Photo::find_all();
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include_once 'includes/top_nav.php'; ?>


    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include_once 'includes/side_nav.php'; ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Photos
                    <!--<small>Subheading</small>-->
                </h1>

                <?php echo "<div class='alert-success'>{$session->message}</div><br>"; ?>

                <?php
//                echo "<pre>";
//                print_r($photos);
//                echo "</pre>";
                ?>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <th>Photo</th>
                        <th>ID</th>
                        <th>File Name</th>
                        <th>Title</th>
                        <th>Size</th>
                        <th>Comments</th>
                        </thead>
                        <tbody>
                            <?php foreach ($photos as $photo) : ?>
                                <tr>
                                    <td><img class="admin-photo-thumbnail" src="<?php echo $photo->picture_path(); ?>">
                                        <div class="action_links">
                                            <a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                            <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                            <a href="../photo.php?id=<?php echo $photo->id; ?>" target="_blank">View</a>
                                        </div>
                                    </td>
                                    <td><?php echo $photo->id; ?></td>
                                    <td><?php echo $photo->filename; ?></td>
                                    <td><?php echo $photo->title; ?></td>
                                    <td><?php echo $photo->size; ?></td>
                                    <td>
                                        <?php
                                        $comment_counter = Comment::find_the_comments($photo->id);
                                        echo "<a href='comment_photo.php?id={$photo->id}'>" . count($comment_counter) . "</a>";
                                        ?>
                                    </td>


                                </tr>
<?php endforeach; ?>
                        </tbody>
                    </table> <!-- End of table -->

                </div>



            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


<?php include("includes/footer.php"); ?>