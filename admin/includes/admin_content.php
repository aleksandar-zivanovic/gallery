<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>

            <?php
            echo "<hr style='border:1px solid red;'>";

            require_once 'test' . DIRECTORY_SEPARATOR . 'test.php';

            echo "<hr style='border:1px solid red;'>";



//            $user = new User();
//            $user->id = 13;
//            $user->username = "Betmen";
//            $user->password = 123;
//            $user->first_name = "Misa";
//            $user->last_name = "Slepac";
//
//            $user->create();
//            $user->update();
//            $user = User::find_by_id(111);
//            $user->last_name = "Zloba";
//            $user->delete();
//            /* pozivanje properties() metoda */
//            print_r($user->properties());
//            /* INSTANCIRANJE */
//            $niz = [
//                "id" => 53,
//                "username" => "MarkoP",
//                "password" => 123,
//                "first_name" => "Marko",
//                "last_name" => "Petrovic"];
//
//            $korisnik = User::instantiation($niz);
//            
//            $korisnik->nadimak = "Cmare";
//            $korisnik->starost = 34;
//            $korisnik->visina = "184cm";
//            $korisnik->tezina = "102kg";
//            
//            echo "<pre>";
//            print_r($korisnik);
//            echo "</pre>";
//            /* kraj - INSTANCIRANJE */



//            $user = User::find_all();
//            foreach ($user as $key => $value) {
//                print_r($value);
//                echo "<br>";
//            }
//
//            echo "<hr>";
//
//            $the_photo = Photo::find_all();
//            foreach ($the_photo as $keyph => $valueph) {
//                print_r($valueph);
//                echo "<br>";
//            }


//            $user = new User();
//            $user->username = "NEW USER";
//            $user->save();

            echo "<hr style='border:1px solid blue;'>";
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

