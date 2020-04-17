<?php
require_once('methods/connect.php');
require('../lib/account.php');
require('../lib/photo.php');
session_start();
if (!isset($_SESSION['account'])) {
    header('Location: index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Добавить фото</title>
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
	<!--тело-->
	<section class="AddSection">
		<div class="AddSection__form">
				<div class="AddSection__tic">
					<img class="AddSection__tt" id="image1" src='img/images.png' alt="">
				</div>
			<form action="methods/addfile.php" method="POST" class="AddSection__forms" enctype="multipart/form-data">
				<div class="AddSection__addphoto">
					<div class="AddSection__send">
						<label class="AddSection__inp AddSection__newinp" for='file'>Добавить</label>
						<input type="file" name='file' id='file' class="AddSection__hidden">
					</div>
					<div class="AddSection__pole">
						<textarea name="description" maxlength=4000
            class="AddSection__txt"
            placeholder="Напишите описание"><?= $_SESSION['test_photo']->description ?></textarea>
					</div>
					<div class="AddSection__send1">
							<?php
							if ($_SESSION['message']) {
								echo '<p class="message"> ' . $_SESSION['message'] . '</p>';
							}
							unset($_SESSION['message']);
							?>
						<input type="submit" class="AddSection__inp" value="Отправить">
					</div>
					</div>
			</form>
		</div>
		</div>
	</section>
	<!--хвост-->
	<footer class="footer">
		<p class="footer__by">by Kristina Kurbatova</p>
	</footer>
</body>
<script src="scripts/addPhoto.js"></script>
</html>