<?php require_once 'admin/includes/config.php'; ?>
<?php include_once "includes/header.php"; ?>

<?php
$photos = Photo::find_all();
?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-12">

            <div class="thumbnails row">

                <?php foreach ($photos as $photo): ?>

                    <div class="col-md-3 col-xs-6">
                        <a href="photo.php?id=<?php echo $photo->id ?>">
                            <img class="home_page_photo thumbnail" src="admin/<?php echo $photo->picture_path() ?>" alt="<?php echo $photo->alternate_text ?>">
                        </a>
                    </div>


                <?php endforeach; ?>

            </div>






        </div>




        <!-- Blog Sidebar Widgets Column -->
        <!--<div class="col-md-4">-->


        <?php // include("includes/sidebar.php");   ?>



        <!--</div>-->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
