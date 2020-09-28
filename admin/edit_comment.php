<?php include_once 'includes/header.php' ?>

<?php
if (!$session->is_signed_in()) {
    redirect("login.php");
}

if (!isset($_GET['ec'])) {
    redirect("comments.php");
}

$single_comment = Comment::find_by_id($_GET['ec']);
$single_photo = Photo::find_by_id($single_comment->photo_id);

/* update user */
if (isset($_POST['update'])) {

    if ($single_comment) {
        $single_comment->photo_id = $_POST['photo_id'];
        $single_comment->author = $_POST['author'];
        $single_comment->body = $_POST['body'];

        $single_comment->save();
    }
}
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
                    Comment User: <small>comment id: <?php echo $single_comment->id; ?>
                </h1>


                <form action="" method="post">

                    <div class="col-md-6">

                        <div class="form-group">
                            <img class="admin-photo-thumbnail" src="images/<?php echo $single_photo->filename; ?>">
                        </div>

                        <div class="form-group">
                            <label for="photo_id">Photo ID:</label><br>
                            <input type="text" name="photo_id" class="form-control" value="<?php echo $single_comment->id; ?>">
                        </div>

                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control" value="<?php echo $single_comment->author; ?>">
                        </div>

                        <div class="form-group">
                            <label for="body">Comment</label>
                            <textarea name="body" class="form-control"><?php echo $single_comment->body; ?></textarea>
                        </div>

                        <div class="form-group">
                            <a href="delete_comment.php?dc=<?php echo $single_comment->id; ?>" class="delete_link btn btn-danger pull-left">Delete Comment</a>
                            <input type="submit" name="update" class="btn btn-primary pull-right" value="Edit Comment">
                        </div>


                    </div>
                </form>



            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


<?php include("includes/footer.php"); ?>