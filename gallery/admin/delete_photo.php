<?php include("includes/init.php");

if(!$session->isUserSingedIn()) {
    redirect("login.php");
}

if(empty($_GET['id'])) {
    redirect("photos.php");
}

$photo = Photo::find_by_id($_GET['id']);

if($photo) {
    $photo->deletePhoto();
    redirect("photos.php");
} else {
    redirect("photos.php");
}