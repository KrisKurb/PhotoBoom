<?php
require('../lib/account.php');
session_start();
if (isset($_SESSION['account'])) {
    header('Location: index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Авторизация</title>
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
				<li class="header__reg header__li">
					<a class="header__Vxod header__2" href="autorization.php">Вход</a>
				</li>
				<li class="header__li">
					<a class="header__Vxod header__1" href="registration.php">Регистрация</a>
				</li>
			</ul>
		</div>
	</header>
<!-- тело -->
<section class="section">
	<form action="methods/signin.php" method="POST" class="section__form section__form_reg">
		<p class="section__tit section__tit_reg">Авторизация</p>
		<div class="section__pole">
			<label class="section__label" for="email">Email:</label>
			<input class="section__input" name="email" type="email" value='<?=$_SESSION['account-test']->email?>'>
		</div>
		<div class="section__pole">
			<label class="section__label" for="password">Пароль</label>
			<input class="section__input" name="password" type="password">
		</div>
		<div class="section__send">
			<?php
        if ($_SESSION['message']) {
          echo '<p class="message"> ' . $_SESSION['message'] . '</p>';
        }
      unset($_SESSION['message']);
      ?>
			<input type="submit" class="section__inp" value="Войти">
		</div>
	</form>
</section>
<footer class="footer">
	<p class="footer__by">by Kristina Kurbatova</p>
</footer>
</body>
</html>