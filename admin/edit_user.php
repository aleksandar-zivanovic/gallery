<?php include_once 'includes/header.php' ?>
<?php include_once 'includes/photo_library_modal.php'; ?>

<?php
if (!$session->is_signed_in()) {
    redirect("login.php");
}

if (!isset($_GET['id'])) {
    redirect("photos.php");
}

$user = User::find_by_id($_GET['id']);

/* update user */
if (isset($_POST['update'])) {

    if ($user) {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];

        if (empty($_FILES['user_image'])) {
            $user->save();
            $session->message("User {$user->username} is updated.");
            redirect("users.php");
        } else {
            $user->set_file($_FILES['user_image']);
            $user->upload_photo();
            $user->save();
            $session->message("User {$user->username} is updated.");
            redirect("users.php");
        }
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
                    Edit User: <small><?php echo $user->username; ?>
                </h1>

                <div class="col-md-6 user_image_box">
                    <a href="" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""></a>
                </div>


                <form action="" method="post" enctype="multipart/form-data">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="user_image">User Image</label>
                            <input type="file" name="user_image" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" class="form-control" value="<?php echo $user->password; ?>">
                        </div>

                        <div class="form-group">
                            <a id="user-id" href="delete_user.php?du=<?php echo $user->id; ?>" class="delete_link btn btn-danger pull-left">Delete User</a>
                            <input type="submit" name="update" class="btn btn-primary pull-right" value="Update User">                          
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