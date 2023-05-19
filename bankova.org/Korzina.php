<?php
session_start();
?>
<html>
	<head>
		<title> FaceCare </title>
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
				<h2> Корзина </h2>
				<!-- таблицы вывода корзины -->
				<table>
					<tr>
						<td>
							№
						</td>
						<td>
							Изображение
						</td>
						<td>
							Наименование
						</td>
						<td>
							Описание
						</td>
						<td colspan = 3>
							Количество
						</td>
						<td>
							Цена за ед.
						</td>
						<td>
							Итоговая цена
						</td>
					</tr>
					<?
					$login = $_SESSION['login'];
					// получение переменных
					$id_tov = $_POST['id_tov'];
					//запрос на поиск данных товара в бд
					$query1 = "SELECT * FROM `tovar` WHERE `id` = '$id_tov' ";
					
					//отправка запроса
					$result1 = mysqli_query($conn, $query1);
					//вывод данных найденного товара
					$row2 = mysqli_fetch_array($result1);
					// перенос переменных индексы отличаются от студентов
					$img = $row2[2];
					$name = $row2[1];
					$about1 = $row2[4];
					$kolvo = 1;
					$price = $row2[3];
					if ($_SESSION['login'] == '') echo "<h3> <a href = 'auto.php'> Пройдите авторизацию </a> </h3>";
					else {
						//проверка нажатия кнопки
						if ($_POST['korzina'] == 'В корзину') {
							// Проверяем наличие и количество товаров в корзине
							$query4 = "SELECT * FROM `korzina` WHERE `id_tov` = '$id_tov' AND `login` = '$login' ";
							// отправка запроса в бд
							$result4 = mysqli_query($conn, $query4);
							// сама проверка
							$num = mysqli_num_rows($result4);
							if ($num > 0) {
								// определяем кол-во в бд
								$row = mysqli_fetch_array($result4);
								// прибавляем еще 1
								$kolvo = $row[5] + 1;
								// меняем в бд на +1
								$query5 = "UPDATE `korzina` SET `kolvo` = '$kolvo' WHERE `id_tov` = '$id_tov' AND `login` = '$login' "; 
								$result5 = mysqli_query($conn, $query5);
							}
							else {
								// запрос на добавление товаров
								$query2 =" INSERT INTO `korzina` (`id_tov`, `img`, `name`, `about1`, `kolvo`, `price`, `login`)
														VALUES ('$id_tov','$img', '$name', '$about1', '1', 	'$price', '$login')";
								// отправка запроса
								$result2 = mysqli_query($conn, $query2);
							}
						}
					
						// кнопка >
						if ($_POST['plus'] == '>') {
							// получение переменных
							$id_tov = $_POST['id_tov'];
							// увеличиваем товар на 1
							$kolvo = $_POST['kolvo'] + 1;
							$query = "UPDATE `korzina` SET `kolvo` = '$kolvo' WHERE `id_tov` = '$id_tov' AND `login` = '$login' ";
							// отправка запроса
							$result = mysqli_query($conn, $query);
						}
						if ($_POST['minus'] == '<') {
							// получение переменных
							$id_tov = $_POST['id_tov'];
							if ($_POST['kolvo'] == 1) {
								// если товар 1, то удаляем его;
								$query = "DELETE FROM `korzina` WHERE `id_tov` = '$id_tov' AND `login` = '$login' ";
							}
							else {
								// уменьшаем товар на 1
								$kolvo = $_POST['kolvo'] - 1;
								$query = "UPDATE `korzina` SET `kolvo` = '$kolvo' WHERE `id_tov` = '$id_tov' AND `login` = '$login' ";
							}
							$result = mysqli_query($conn, $query);
						}
						// запрос на отображение категорий
						$query = "SELECT * FROM `korzina` WHERE `login` = '$login' ";
						$i = 1;
						// отправка запроса
						$result = mysqli_query($conn, $query);
						// цикл с выводом данных из БД
						while ($row = mysqli_fetch_array($result)) {
						?>
						<tr>
							<td>
								<? echo $i++; ?>
							</td>
							<td>
								<img src = 'img/<? echo $row[2]; ?>' alt = 'tovar_mini' class = 'tovar_mini'>
							</td>
							<td>
								<? echo $row[3]; ?>
							</td>
							<td>
								<? echo $row[4]; ?>
							</td>
							<td>
								<form action = 'korzina.php' method = 'post'>
									<input type='hidden' name = 'id_tov' value='<? echo $row[1]; ?>'>
									<input type='hidden' name = 'kolvo' value='<? echo $row[5]; ?>'>
									<input type='submit' name = 'minus' value='<'>
								</form>
							</td>
							<td>
								<? echo $row[5]; ?>
							</td>
							<td>
								<form action = 'korzina.php' method = 'post'>
									<input type='hidden' name = 'id_tov' value='<? echo $row[1]; ?>'>
									<input type='hidden' name = 'kolvo' value='<? echo $row[5]; ?>'>
									<input type='submit' name = 'plus' value='>'>
								</form>
							</td>
							<td>
								<? echo $row[6]; ?>
							</td>
							<td>
								<? echo $row[5] * $row[6]; $summ=$row[5] * $row[6] + $summ; ?>
							</td>
						</tr>
						<?
						}
					}
					?>
					<tr>
						<td colspan=3>
								Итоговая Сумма: <? echo $summ; ?>
						</td>
						<td colspan=3>
							<form action ='Lk.php' method = 'post'>
								<input type ='submit' name='zakaz' value ='Оформить заказ'>
							</form>
						</td>
					</tr>
				</table>
			</section>
			
		</main>
		<!-- подвал -->
		
	</body>
</html>