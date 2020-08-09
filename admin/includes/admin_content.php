<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>

            <?php
//            echo "<hr style='border:1px solid red;'>";
            
//            $user = new User();
//            
//            $user->username = "Djole";
//            $user->password = 123;
//            $user->first_name = "Djole";
//            $user->last_name = "Zloba";
//            
//            $user->create();
            
            $user = User::find_user_by_id(8);
//            $user->last_name = "Zloba";
            $user->delete();
            
            
            ?>

            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>

            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>

