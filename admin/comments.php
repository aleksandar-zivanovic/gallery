<?php include_once 'includes/header.php' ?>

<?php
if (!$session->is_signed_in()) {
    redirect("login.php");
}
?>

<?php
$comments = Comment::find_all();
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
                    All Comments
                </h1>

                <?php echo "<div class='alert-success'>{$session->message}</div><br>"; ?>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <th>Comment ID</th>
                        <th>Photo ID</th>
                        <th>Author</th>
                        <th>Body</th>
                        </thead>
                        <tbody>
                            <?php foreach ($comments as $comment) : ?>

                                <?php $single_photo = Photo::find_by_id($comment->photo_id) ?>

                                <tr>
                                    <td><?php echo $comment->id; ?></td>
                                    <td><img class="user_image" src="images/<?php echo $single_photo->filename; ?>"></td>
                                    <td><?php echo $comment->author; ?></td>
                                    <td><?php echo $comment->body; ?>
                                        <div class="action_links">
                                            <a class="delete_link" href="delete_comment.php?dc=<?php echo $comment->id; ?>">Delete</a>
                                            <a href="edit_comment.php?ec=<?php echo $comment->id; ?>">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
//                                }

                            endforeach;
                            ?>
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