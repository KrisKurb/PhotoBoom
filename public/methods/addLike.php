<?php
require_once('connect.php');
require('../../lib/account.php');
require('../../lib/photo.php');
require('../../lib/likes.php');
session_start();
if ($_POST == null) {
    header('Location: ../index.php');
    die();
}
$likes = new Likes();
$likes->setLikes();
$_SESSION['likes'] = $likes;
header('Location: ../openphoto.php?idPhoto=' . $_SESSION['photo']->idPhoto);

