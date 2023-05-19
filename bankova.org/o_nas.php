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

			<div class="map">
				
				<p class="o_nas_style">
					Наш девиз: Подчеркни свою внутреннюю красоту
					<br>
					<br> Корейская косметика довольно быстро завоевала сердца миллионов красавиц по всему миру. Так в чём же её секрет, покоривший прекрасную половину человечества? 
					<br> Прежде всего, корейская косметика славится своей натуральностью. В большинстве своём, кремы, гели и другие косметические средства не содержат в себе вредных компонентов, которые могли бы нанести вред коже.
					<br>Именно корейская косметика раскрыла для всех женщин важный секрет в уходе за кожей лица, который тут же вошел в тренд по всему миру. Конечно же, речь идет о многоступенчатой системе ухода, где каждый этап играет особую роль. Очищение, тонизирование, питание, увлажнение - такой тщательный уход позволяет коже лица всегда оставаться молодой, прекрасной, а главное - здоровой.
					<br>А с чего, собственно, началась любовь к корейской косметике? Пожалуй, что самым инновационным средством для европейских и американских женщин стали ВВ-кремы, которые взорвали мир бьюти-индустрии! Согласитесь, совместить в одном средстве и маскирующие, и ухаживающие средства - стало поистине мудрым решением, которое помогает девушкам создать идеальный макияж, заботясь при этом о здоровье кожи.
					
					<br>
					<br><img src='img/33.jpg' alt='logo' class='img_logo_nas' >
				</p>

			</div>
				
			</section>
		</main>
		<!-- подвал -->
		
	</body>
</html>