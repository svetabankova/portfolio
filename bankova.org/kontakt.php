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
						<input type='submit' name = 'kategory' value='<? echo $row[1]; ?>'>
					</form>
				<?
				}
				?>

				<form action = 'index.php' method = 'post'>
					<input type = 'submit' class = 'fifth' name = 'kategory' value = 'Все товары'>
				</form>
			</section>
			
			<section class ='center'>

			<div class="map">
				<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A2cee003d039d8ca14d84d702a13c2572dc709cb68f2a8b48007910a8967fa85d&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
			
				<p class="contacts">
					Мы находимся по адресу Петра Алексеева 25.
					<br>
					<br> Телефон: 705-405
					<br>
					<br>Почта: facecare@gmail.ru
				</p>

			</div>
				
			</section>
		</main>
		<!-- подвал -->
		
	</body>
</html>