<?php
require_once('methods/connect.php');
require('../lib/account.php');
require('../lib/photo.php');
require('../lib/likes.php');
session_start();
require('methods/getPhoto.php');
if (!isset($_SESSION['photo'])) {
    header('Location: index.php');
    die();
}
$likes = new Likes();
$acc = new Account();
$nameAccount = $acc->getNameAccount($_SESSION['photo']->idPhoto); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Фотография</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="scripts/lightzoom_v/style.css" type="text/css">
	<script src="scripts/jquery-3.5.0.min.js"></script>
	<script type="text/javascript" src="scripts/lightzoom_v/lightzoom.js"></script>
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
	<section class="OPSection">
		<div class="OPSection__form">
		<div class="OPSection__head">
		<div class="OPSection__you">
			<a href="profile.php?nameAccount=<?=$nameAccount?>"><p class="OPSection__youname"><?php 
			$acc = new Account();
			echo $acc->getNameAccount($_SESSION['photo']->idPhoto);
			?></p></a>
		</div>
		<div class="OPSection__sect">
			<a href="<?=$_SESSION['photo']->imgPhoto?>" class="lightzoom"><img class="OPSection__ex" src="<?=$_SESSION['photo']->imgPhoto ?>" alt=""></a>
		<form action="methods/addLike.php" method="POST">
			<div class="OPSection__opphoto">
				<div class="OPSection__mark">
				<p class="OPSection__AR">Средняя оценка:</p>
				<p class="OPSection__rating"><?= $likes->getAvarageMarkLikes($_SESSION['photo']->idPhoto) ?></p>
				</div>
				<div class="OPSection__marks">
					<?php include('methods/checkLikes.php') ?>
				</div>
				<div class="OPSection__l">
					<img class="OPSection__like" src="/img/like.svg" alt="like">
					<p class="OPSection__rating"><?php echo $likes->countLikes; unset($likes); ?></p>
				</div>
			</div>
			</div>
		</form>
		</div>
		<div class="OPSection__pole">
			<p class="OPSection__txt"><?=$_SESSION['photo']->description ?></p>
		</div>
		<p><?=$_SESSION['photo']->datePhoto ?></p>
	</section>
	<!--хвост-->
	<footer class="footer">
		<p class="footer__by">by Kristina Kurbatova</p>
	</footer>
</body>
<script type="text/javascript">jQuery('.lightzoom').lightzoom({speed: 400, viewTitle: true});</script>
</html>