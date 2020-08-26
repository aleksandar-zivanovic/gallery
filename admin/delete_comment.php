<?php include_once 'includes/init.php' ?>

<?php

echo "<h3>Delete Comment Page</h3><hr>";

if (!$session->is_signed_in()) {
    redirect("login.php");
}

if (!isset($_GET['dc'])) {
    redirect("comments.php");
} else {
    $comment = Comment::find_by_id($_GET['dc']);

    if ($comment) {
        $comment->delete();
        if (strpos($_SERVER['HTTP_REFERER'], "comment_photo.php") && isset($_GET['photo_id'])) {
            redirect("comment_photo.php?id={$_GET['photo_id']}");
        } else {
            redirect("comments.php");
        }
        
    } else {
        echo "The comment doesn't exist";
    }
}
?>