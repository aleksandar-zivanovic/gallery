<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>

            <?php
//            $result_set = User::find_all_users();
//            while ($row = mysqli_fetch_array($result_set)) {
//                echo $row['username'] . "<br>";
//            }
//            echo "<hr>";
//            $found_user = User::find_user_by_id(2);
//            
//            $user = User::instantiation($found_user);
//
//            echo $user->username;
//            echo "<br>";
//            print_r(get_object_vars($user));

            $users = User::find_all_users();
            foreach ($users as $user) {
                echo $user->username . "<br>";
            }
            
            echo "<hr style='border:1px solid red;'>";
            
            $found_user = User::find_user_by_id(3);
            
            echo $found_user->username;
            
            
            
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

