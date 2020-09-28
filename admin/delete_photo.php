<?php include_once 'includes/init.php' ?>

<?php
if (!$session->is_signed_in()) {
    redirect("login.php");
}


if(empty($_GET['id'])){
    redirect("photos.php");
}

$photo = Photo::find_by_id($_GET['id']);

if($photo){
    $photo->delete_photo();
    $session->message("Photo {$photo->filename} is deleted!");
    return redirect("photos.php");
} else {
    echo "This photo doesn't exist!";
}




?>