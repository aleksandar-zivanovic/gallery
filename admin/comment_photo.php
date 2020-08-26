<?php include_once 'includes/header.php' ?>

<?php
if (!$session->is_signed_in()) {
    redirect("login.php");
}
?>

<?php

if(empty($_GET['id'])){
    redirect("photos.php");
}

$the_photo_comments = Comment::find_the_comments($_GET['id']);
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
                    All comments for photo ID = <?php echo $_GET['id']; ?>
                </h1>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <th>Comment ID</th>
                        <th>Author</th>
                        <th>Body</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($the_photo_comments as $comment) : ?>
                            
                            <?php $single_photo = Photo::find_by_id($comment->photo_id) ?>

                                    <tr>
                                        <td><?php echo $comment->id; ?></td>
                                        <td><?php echo $comment->author; ?></td>
                                        <td><?php echo $comment->body; ?>
                                            <div class="action_links">
                                                <a href="delete_comment.php?dc=<?php echo $comment->id; ?>&photo_id=<?php echo $_GET['id']; ?>">Delete</a>
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