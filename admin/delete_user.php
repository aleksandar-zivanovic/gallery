<?php include_once 'includes/init.php' ?>

<?php

echo "<h3>Delete User Page</h3><hr>";

if (!$session->is_signed_in()) {
    redirect("login.php");
}

if (!isset($_GET['du'])) {
    redirect("login.php");
} else {
    $user_id = $_GET['du'];
    $user = User::find_by_id($_GET['du']);

    if ($user) {
        $user->delete_user();
        redirect("users.php");
    } else {
        echo "The user doesn't exist";
    }
}
?>