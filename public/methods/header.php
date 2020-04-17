<?php
if(isset($_SESSION['account']))
{
	echo '<ul class="header__menu">
				<li class="header__liboss">
					<a class="header__Vxod header__1" href="add.php"><img class="header__plus" src="img/plus.svg" alt=""></a>
				</li>
				<li class="header__liboss">
					<a class="header__Vxod header__2" href="profile.php"><img class="header__plus" src="img/dom.svg" alt=""></a>
				</li>
				<li class="header__liboss">
					<a class="header__Vxod header__name" href="index.php">'.$_SESSION['account']->nameAccount.'</a>
				</li>
					<li class="header__liboss header__liboss_line"><img class="header__miniline" src="img/Line.svg" alt=""></li>
					<li class="header__liboss"><a class="header__Vxod header__name" href="methods/logout.php">Выход</a></li>
				</ul>';
} else {
	echo '<ul class="header__menu">
				<li class="header__reg header__li">
					<a class="header__Vxod header__2" href="autorization.php">Вход</a>
				</li>
				<li class="header__li">
					<a class="header__Vxod header__1" href="registration.php">Регистрация</a>
				</li>
			</ul>';
}