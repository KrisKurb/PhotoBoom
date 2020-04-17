<?php
require_once('connect.php');
require('../../lib/account.php');
session_start();
if ($_POST == null) {
    header('Location: ../index.php');
    die();
}
$account=new Account();
$account->addParams();
$_SESSION['account-test']=$account;
try {
	$account->regAccount();
	$account->setAccount();
	$_SESSION['account']=$account;
	unset($_SESSION['account-test']);
	header('Location: ../index.php');
	die();
} catch (Exception $e) {
	$_SESSION['message'] = $e->getMessage();
  header('Location: ../registration.php'); 
  unset($account);
  die();
}