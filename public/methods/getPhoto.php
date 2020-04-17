<?php
if (!isset($_GET['idPhoto'])) {
    header('Location: index.php');
    die();
}

$photo = new Photo();
$photo->getPhoto($_GET['idPhoto']);
$_SESSION['photo'] = $photo;
if (!$_SESSION['photo']->idPhoto) {
    header('Location: index.php');
    unset($_SESSION['photo']);
    unset($photo);
    die();
}
