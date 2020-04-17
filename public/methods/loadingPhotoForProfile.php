<?php
require_once('connect.php');
require('../lib/photo.php');

$photo = new Photo();
if(!$profile)
	$data = $photo->getPhotoProfile($_SESSION['account']->idAccount);
else
	$data = $photo->getPhotoProfile($profile->idaccount);
if(!$data) {
	echo '
						<div class="BossSection__container">
							<p class="BossSection__text">Нет фотографий</p>
						</div>';
} else {
	for ($i=0; $i<count($data); $i++) {
			echo '<div class="BossSection-content__poster" onClick="clickOnPhoto(' . $data[$i]['idphoto'] . ');">
							<div class="BossSection-content__img-poster transation">
								<img src=' . $data[$i]['imgphoto'] . ' alt="" class="BossSection-content__img"/>
							</div>
						</div>';
	}
}