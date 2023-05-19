<?php
session_start();
?>
<html>
	<head>
		<title> Корзина </title>
		<link rel="stylesheet" type="text/css" href="style.css">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300&display=swap" rel="stylesheet">
	</head>
	<?php 
	//подключение к БД
	include 'connect.php';
	?>
	<body>
		<!-- шапка -->
		<header>
			<!-- logo -->
			<div class ='logo'>
				<img src='img/logo.png' alt='logo' class='img_logo'>
			</div>
			<!-- vhod -->
			<div class ='vhod'>
				<?
				include 'vhod.php';
				?>
			</div>
		</header>
		
		<!-- шапка -->

		<?
		include 'nav.php';
		?>
	
		<!-- основная часть -->
		<main>
			<section class ='left'>
				<? 
				// запрос на отображение категорий
				$query = "SELECT * FROM `kategory`";
				// отправка запроса
				$result = mysqli_query($conn, $query);
				// цикл с выводом данных из БД
				while($row = mysqli_fetch_array($result)) {
				?>
					<form action = 'index.php' method = 'post'>
						<input type='submit' class = 'fifth' name = 'kategory' value='<? echo $row[1]; ?>'>
					</form>
				<?
				}
				?>
				<form action = 'index.php' method = 'post'>
					<input type = 'submit' class = 'fifth' name = 'kategory' value = 'Все товары'>
				</form>
			</section>
			<section class ='center'>	
			<h2> Товар </h2>
				<?
				// получение переменных
				$id_tov = $_POST['id_tov'];
				// запрос на отображение категорий
				$query = "SELECT * FROM `tovar` WHERE `id` = '$id_tov' ";
				// отправка запроса
				$result = mysqli_query($conn, $query);
				// цикл с выводом данных из БД
				$row = mysqli_fetch_array($result)
				?>
				<div class='tovar'>

					<div class='img_tovar'>
						<img src='img/<? echo $row[2]; ?>' alt='tovar' class='img_tovar'>
					</div>

					<div class='about_tovar'>
						<h3> <? echo $row[1]; ?></h3>
						<p> Цена товара: <? echo $row[3]; ?></p>
						<p> Описание товара: <? echo $row[4]; ?></p>
						<form action = 'korzina.php' method = 'post'>
							<input type = 'hidden' class = 'fifth' name = 'id_tov' value = '<? echo $row[0]; ?>'>
							<input type = 'submit' class = 'fifth' name = 'korzina' value = 'В корзину'>
						</form>
					</div>

				</div>
				<div class='tovar'>
					<div class='about_tovar'>
						<div class="about_style">
							<p> Название: <? echo $row[4]; ?></p>
							<p> В комплекте: <? echo $row[5]; ?></p>
							<p> Цвет: <? echo $row[6]; ?></p>
							<p> Страна: <? echo $row[7]; ?></p>
						</div>
					</div>
				</div>
			</section>
		</main>
		<!-- подвал -->
		
	</body>
</html>