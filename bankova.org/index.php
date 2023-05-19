<?php
session_start();
// проверка на выход
if ($_POST['vihod'] == 'Выход') {
	$_SESSION['login'] = '';
	$_SESSION['pass'] = '';
	$_SESSION['status'] = '';
}
?>
<html>
	<head>
		<title> FaceCare </title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="slide.css">

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
		<header class="navvv">
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

			<!-- шапка -->
		
			<?
			include 'nav.php';
			?>

		</header>
		
		
		
		<!-- основная часть -->
		<main>

			<div id="Slider">
				<div id="polosa">
					<img class="imageSlide" src="img/1.jpg" alt="">
					<img class="imageSlide" src="img/2.jpg" alt="">
					<img class="imageSlide" src="img/3.jpg" alt="">
				</div>

				<a id="slider-left" class="prev">&#10094</a>
				<a id="slider-right" class="next">&#10095</a>

				<script type="text/javascript" src="SliderScript.js"></script>
			</div>

			<section class ='left'>
				<div class='poisk'>
					<form action='index.php' method='post'>
						<input type="text" class = 'fifth' name='search'>
						<input type="submit" class = 'fifth' name='search_button' value='Поиск'>
					</form>
				</div>

				<? 
				// запрос на отображение категорий
				$query = "SELECT * FROM `kategory`";
				// отправка запроса
				$result = mysqli_query($conn, $query);
				// цикл с выводом данных из БД
				while($row = mysqli_fetch_array($result)) {
				?>
					<form action = 'index.php' method = 'post'>
						<input type='submit' class='fifth' name='kategory' value='<? echo $row[1]; ?>'>
					</form>
				<?
				}
				?>

				<form action = 'index.php' method = 'post'>
					<input type = 'submit' class='fifth' name='kategory' value='Все товары'>
				</form>
			</section>

			<section class ='center'>	
				<h2> Товары </h2>
					<h3>Сортировка по</h3>
						<div class='sor' >
						<form action='index.php'  method='post'>
							<input type='submit' class='fifth' name='price' value='Цена'>
						</form>
						</div>
						<div class='sor'>
						<form action='index.php' method='post'>
							<input type='submit' class='fifth' name='gram' value='Цвет'>
						</form>
						</div>
						<div class='sor'>
						<form action='index.php' method='post'>
							<input type='submit' class='fifth' name='kol' value='Количество'>
						</form>
						</div>
						<div class='sor'>
						<form action='index.php' method='post'>
							<input type='submit' class='fifth' name='kkal' value='Страна'>
						</form>
						
						</div>
					
				
				<?
				// получение переменных
				$kategory = $_POST['kategory'];
				$i=0;
				if ($_POST['kategory'] == 'Все товары')
				{
					// запрос на отображение категорий
					$query1 = "SELECT * FROM `tovar`";
				}
				elseif ($_POST['kategory'] != '')
				{
					// запрос на отображение товаров
					$query1 = "SELECT * FROM `tovar` WHERE `kategory` = '$kategory' ";
				}
				elseif ($_POST['search_button'] == 'Поиск')
				{
					// запрос на отображение категорий
					$search = $_POST['search'];
					//Запрос на отображение товаров
					$query1 = "SELECT * FROM `tovar` WHERE `name` LIKE '%$search%' ";
				}
				elseif ($_POST['price'] == 'Цена') //Сортировка по цене
				{
					// запрос на отображение категорий
					$i = $_SESSION['chethik'];
					$i++;
					$_SESSION['chethik'] = $i;
					if ($i%2==0)
						$query1 = "SELECT * FROM `tovar` ORDER BY `tovar`.`price` DESC";
					else
						$query1 = "SELECT * FROM `tovar` ORDER BY `tovar`.`price` ASC ";
				}
				/*
				elseif ($_POST['gram'] == 'Грамм') //Сортировка по весу
				{
					// запрос на отображение категорий
					$i = $_SESSION['chethik'];
					$i++;
					$_SESSION['chethik'] = $i;
					if ($i%2==0)
						$query1 = "SELECT * FROM `tovar` ORDER BY `tovar`.`Gram` ASC";
					else
						$query1 = "SELECT * FROM `tovar` ORDER BY `tovar`.`Gram` DESC";
				}
				*/
				elseif ($_POST['kol'] == 'Количество') //Сортировка по количеству
				{
					// запрос на отображение категорий
					$i = $_SESSION['chethik'];
					$i++;
					$_SESSION['chethik'] = $i;
					if ($i%2==0)
						$query1 = "SELECT * FROM `tovar` ORDER BY `tovar`.`Kolichestvo` ASC";
					else
						$query1 = "SELECT * FROM `tovar` ORDER BY `tovar`.`Kolichestvo` DESC";
				}
				/*
				elseif ($_POST['kkal'] == 'Каллории') //Сортировка по каллории
				{
					// запрос на отображение категорий
					$i = $_SESSION['chethik'];
					$i++;
					$_SESSION['chethik'] = $i;
					if ($i%2==0)
						$query1 = "SELECT * FROM `tovar` ORDER BY `tovar`.`Kkal.` ASC";
					else
						$query1 = "SELECT * FROM `tovar` ORDER BY `tovar`.`Kkal.` DESC";
				}
				*/
				else
				{
					// запрос на отображение категорий
					$query1 = "SELECT * FROM `tovar` ";
				}
				// запрос на отображение категорий
				
				// отправка запроса
				$result = mysqli_query($conn, $query1);
				// цикл с выводом данных из БД
				while($row = mysqli_fetch_array($result)) {
				?>
					<div class='tovar'>
						<div class='img_tovar'>
							<img src='img/<? echo $row[2]; ?>' alt='tovar' class='img_tovar'>
						</div>
						<div class='about_tovar'>
							<h3> <? echo $row[1]; ?></h3>
							<p> <b> Цена товара: <? echo $row[3]; ?> </b> </p>
							<p> Описание товара: <? echo $row[4]; ?></p>
							<form action = 'tovar.php' method = 'post'>
								<input type = 'hidden' class = 'fifth' name = 'id_tov' value = '<? echo $row[0]; ?>'>
								<input type = 'submit' class = 'fifth' name = 'tovar' value = 'Подробнее'>
							</form>
						</div>
					</div>
				<?
				}
				?>
			</section>
		</main>

		<!-- подвал -->
		
	</body>
</html>