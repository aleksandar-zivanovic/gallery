<?php include_once 'includes/header.php' ?>

<?php
if (!$session->is_signed_in()) {
    redirect("login.php");
}
?>

<?php
$users = User::find_all();
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
                    Users
                </h1>
                
                <?php echo "<div class='alert-success'>{$session->message}</div><br>"; ?>
                
                <a href="add_user.php" class="btn btn-primary">Add user</a>

                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <th>User ID</th>
                        <th>Photo</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?php echo $user->id; ?></td>
                                    <td><img class="user_image" src="<?php echo $user->image_path_and_placeholder(); ?>"></td>
                                    <td><?php echo $user->username; ?>
                                        <div class="action_links">
                                            <a class="delete_link" href="delete_user.php?du=<?php echo $user->id; ?>">Delete</a> 
                                           <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                        </div>
                                    </td>
                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name; ?></td>
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