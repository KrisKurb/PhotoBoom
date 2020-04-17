<?php
require('../lib/account.php');
session_start();
if (isset($_SESSION['account'])) {
    header('Location: index.php');
    die();
}
// unset($_SESSION['account']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Регистрация</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
		<!-- шапка -->
		<header class="header">
			<div class="header__entry">
				<a class="header__logo" href="index.php">
					<p class="header__photo">Photo<span class="header__boom">Boom</span></p>
				</a>
				<div class="header__line">
				</div>
				<ul class="header__menu">
					<li class="header__li">
						<a class="header__Vxod header__1" href="autorization.php">Вход</a>
					</li>
					<li class="header__reg header__li">
						<a class="header__Vxod header__2" href="registration.php">Регистрация</a>
					</li>
				</ul>
			</div>
		</header>
		<!-- тело -->
		<section class="section">
			<form action="methods/signup.php" method="POST" class="section__form">
				<p class="section__tit">Регистрация нового пользователя</p>
				<div class="section__pole">
					<label class="section__label" for="name">Имя:</label>
					<input class="section__input" name="name" type="text" value='<?=$_SESSION['account-test']->nameAccount?>'>
				</div>
				<div class="section__pole">
					<label class="section__label" for="email">Email:</label>
					<input class="section__input" name="email" type="email" value='<?=$_SESSION['account-test']->email?>'>
				</div>
				<div class="section__pole">
					<label class="section__label" for="password">Пароль</label>
					<input class="section__input" name="password" type="password" value='<?=$_SESSION['account-test']->password?>'>
				</div>
				<div class="section__pole">
					<label class="section__label" for="password_replay">Повтор пароля</label>
					<input class="section__input" name="password_replay" type="password">
				</div>
				<div class="section__pole section__pole1">
					<input name='agree' id="radioButton" class="section__1" type="radio">
					<label class="section__label section__label1" for="consent">Согласие на обработку персональных данных</label>
				</div>
				<div class="section__send">
					<?php
					if ($_SESSION['message']) {
						echo '<p class="message"> ' . $_SESSION['message'] . '</p>';
						unset($_SESSION['message']);
					}
					?>
					<input type="submit" class="section__inp" value="Отправить">
				</div>
			</form>
		</section>
		<!--хвост-->
		<footer class="footer">
			<p class="footer__by">by Kristina Kurbatova</p>
		</footer>
</body>
</html>