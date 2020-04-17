<?php
require_once('connect.php');
require('../lib/photo.php');

$photo = new Photo();
$data = $photo->getPhotoIndex();

for ($i=0; $i<count($data); $i++) {
    echo '<div class="BossSection-content__poster" onClick="clickOnPhoto(' . $data[$i]['idphoto'] . ');">
						<div class="BossSection-content__img-poster transation">
							<img src=' . $data[$i]['imgphoto'] . ' alt="" class="BossSection-content__img"/>
						</div>
					</div>';
}