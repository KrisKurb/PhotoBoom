<?php
require_once('methods/connect.php');
require('../lib/account.php');
session_start();
if (!isset($_SESSION['account'])) {
    header('Location: index.php');
    die();
}
// Если мы нажмем на ссылку профиля (своего), то переадрисуемся на свой просто профиль
if($_GET['nameAccount'] == $_SESSION['account']->nameAccount) {
	unset($_GET['nameAccount']);
	header('Location: profile.php');
	die();
} else {
	$acc = new Account();
	$profile = $acc->checkAccountProfile($_GET['nameAccount']);
	// если аккаунта с таким именем несуществует - то переадрисуем пользователя на его профиль
	unset($acc);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Профиль</title>
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
			<?php include('methods/header.php')?>
		</div>
	</header>
	<!-- тело -->
	<section class="BossSection">
		<div class="BossSection__profile">
			<img class="BossSection__gomer" src="img/gomer1.svg" alt="">
			<div class="BossSection__titprof">
				<p class="BossSection__name"><?php echo $profile ? $profile->nameaccount : $_SESSION['account']->nameAccount ?></p>
				<?php echo $profile ? null : '<a class="BossSection__addphoto" href="add.php"><img class="BossSection__plus" src="img/plus1.svg" alt="">Добавить фотографию</a>' ?>
			</div>
		</div>
		<div class="BossSection__bl">
			<img class="BossSection__bigline" src="img/bigline.svg" alt="">
		</div>
			<div class="BossSection-content">
				<div class="BossSection-content__row">
						<?php include('methods/loadingPhotoForProfile.php') ?>
				</div>
			</div>
	</section>
	<!--хвост-->
	<footer class="footer">
		<p class="footer__by">by Kristina Kurbatova</p>
	</footer>
	</body>
</body>
<script src="scripts/clickOnPhoto.js"></script>
</html>