<?php

require_once 'init.php';

$user = new User();

if (isset($_POST['image_name'])) {
    $image_name = $_POST['image_name'];
    $user_id = $_POST['user_id'];

    $user->ajax_save_user_image($image_name, $user_id);
}


if (isset($_POST['photo_id'])) {
    Photo::display_sidebar_data($_POST['photo_id']);
}
?>