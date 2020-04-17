<?php
require_once('connect.php');
require('../../lib/account.php');
session_start();
if ($_POST == null) {
    header('Location: ../index.php');
    die();
}
try {
    $account = new Account();
    $account->email = trim($_POST['email']);
		$account->password = trim($_POST['password']);
		$_SESSION['account-test']=$account;
    if (!$account->emailVerification()) {
        throw new Exception('Пользователя с данным логином в системе не найден.');
    }
    if ($account->verifyPassword(trim($_POST['password']))) { // сравниваем зашифрованный пароль
				$_SESSION['account'] = $account;
				unset($_SESSION['account-test']);
        header('Location: ../index.php'); 
        die();
    } else {
        throw new Exception('Неверный пароль');
    }
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    header('Location: ../autorization.php'); 
    die();
}