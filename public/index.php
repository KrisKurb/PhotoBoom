<?php 
require_once('methods/connect.php');
require('../lib/account.php');
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Главная</title>
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
	<section class="BossSection-index">
		<div class="BossSection-content">
				<div class="BossSection-content__row">
						<!-- Тут картинки -->
						<?php include('methods/loadingPhotoForIndex.php') ?> 
						<?php if(!$data) echo '
						<div class="BossSection__container">
							<p class="BossSection__text">Тут пока нет ни одной фотографии</p>
						</div>
						'?>
				</div>
			</div>
	</section>
	<!--хвост-->
	<footer class="footer">
		<p class="footer__by">by Kristina Kurbatova</p>
	</footer>
</body>
<script src="scripts/clickOnPhoto.js"></script>
</html>