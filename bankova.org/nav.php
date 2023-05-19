<nav class="navigation">
	
	<div class ='a2'>
		<a href='index.php'> Главная </a>
	</div>

	<div class ='a2'>
		<a href='o_nas.php'> О нас </a>
	</div>

	<?
	if ($_SESSION['login'] != '') {
	?>

		<div  class ='a2'>
			<a href='LK.php'> Личный кабинет </a>
		</div>
		<div class ='a2'>
			<a href='korzina.php'> Корзина </a>
		</div>
	<?
	}
	?>

	<div class ='a2'>
		<a href='kontakt.php'> Где нас найти </a>
	</div>
</nav>