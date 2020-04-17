<?php
require_once('connect.php');
require('../../lib/account.php');
require('../../lib/photo.php');
session_start();
if ($_POST == null) {
    header('Location: ../index.php');
    die();
}
$photo=new Photo();
try {
	$photo->checkParams($_SESSION['account']->idAccount);
	$photo->setPhoto();
	if (isset($_SESSION['test_photo'])) {
        unset($_SESSION['test_photo']);
				unset($_SESSION['file']);
				unset($photo);
		}
	header('Location: ../profile.php');
} catch (Exception $e) {
 	$_SESSION['message'] = $e->getMessage();
	$_SESSION['test_photo'] = $photo;
	header('Location: ../add.php');
	die();
}