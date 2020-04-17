<?php
if($likes->getIdPhotoLike($_SESSION['photo']->idPhoto, $_SESSION['account']->idAccount)){
		echo '<p style="color:white;">Ваша оценка: '. $_SESSION['likes']->markLikes .'<br>Спасибо за оценку!</p>';
} else {
	if(isset($_SESSION['account']))
		echo '<div class="OPSection__mark">
						<input name="markLikes" type="submit" class="OPSection__1" value="1">
					</div>
					<div class="OPSection__mark">
						<input name="markLikes" type="submit" class="OPSection__1" value="2">
					</div>
					<div class="OPSection__mark">
						<input name="markLikes" type="submit" class="OPSection__1" value="3">
					</div>
					<div class="OPSection__mark">
						<input name="markLikes" type="submit" class="OPSection__1" value="4">
					</div>
					<div class="OPSection__mark">
						<input name="markLikes" type="submit" class="OPSection__1" value="5">
					</div>';
}