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
					<input type = 'submit' name = 'kategory' value = 'Все товары'>
				</form>
				<h3>Добавить</h3>
				<form action = 'admin.php' method = 'post'>
					<input type = 'submit' name = 'kat_add' value = 'Добавить категорию'>
				</form>
				<form action = 'admin.php' method = 'post'>
					<input type = 'submit' name = 'kat_tov' value = 'Добавить товар'>
				</form>
			</section>
			<section class ='center'>	
				
				<?
				if ($_SESSION['status'] == 1) {
					?>
					<h2> Админ панель </h2>
					<!--Добавление категории-->
					<?
					//Проверка нажатия кнопки
					if ($_POST ['kat_add'] == 'Добавить категорию') {
						?>
						<form action = 'admin.php' method = 'post'>
							<input type = 'text' name = 'name' placeholder = 'Наименование категории'>
							<input type = 'submit' name = 'kat_add2' value = 'Добавить категорию'>
						</form>
						<?	
					}
					if ($_POST ['kat_add2'] == 'Добавить категорию') {
						$name = $_POST['name'];
						$query ="INSERT INTO `kategory` (`name`) VALUES ('$name')";
						$result =mysqli_query($conn, $query);
						echo "<h3> Категория добавлена! </h3><br>";
						echo "<h3><a href='admin.php'class='a1'> Обновить страницу </a></h3><br>";
						
					}
					?>
					<!--Добавление товара-->
					<?
					//Проверка нажатия кнопки
					if ($_POST ['kat_tov'] == 'Добавить товар') {
						?>
						<form action = 'admin.php' method = 'post'>
							<p>Добавить изображение</p>
							<input type = 'file' name = 'img'><br>
							<input type = 'text' name = 'name' placeholder = 'Наименование товара'> <br>
							<input type = 'number' name = 'price' placeholder = 'Цена товара'> <br>
							<input type = 'text' name = 'about' placeholder = 'Описание товара'> <br>
							<input type = 'number' name = 'Kolichestvo' placeholder = 'Количсетво'> <br>
							<input type = 'text' name = 'Cvet' placeholder = 'Цвет'> <br>
							<input type = 'text' name = 'Country' placeholder = 'Страна'> <br>
							
							<select name="kategory" required="kategory">
								  <option value="">Выберите категорию</option>
								  <option value="Джемпер">Джемпер</option>
								  <option value="Юбка">Юбка</option>
								  <option value="Платье">Платье</option>
								  <option value="Пальто">Пальто</option>
								  <option value="Жакет">Жакет</option>
							</select>
							
							<input type = 'submit' name = 'kat_tov2' value = 'Добавить товар'>
						</form>
						<?	
					}
					if ($_POST ['kat_tov2'] == 'Добавить товар') {
						$img = $_POST['img'];
						$name = $_POST['name'];
						$price = $_POST['price'];
						$about = $_POST['about'];
						$Kolichestvo = $_POST['Kolichestvo'];
						$Cvet = $_POST['Cvet'];
						$Country = $_POST['Country'];
						$kategory = $_POST['kategory'];
						$query ="INSERT INTO `tovar`  (`img`, `name`, `price`,  `about`,  `Kolichestvo`,  `Cvet`,  `Country.`, `kategory`) 
											  VALUES ('$img', '$name', '$price', '$about', '$Kolichestvo', '$Cvet', '$Country.', '$kategory')";
											  
						// отправка запроса
						$result = mysqli_query($conn, $query); 
						echo $query;
						// сообщение
						echo "<h3> Товар добавлен</h3><br>";
						echo "<h3><a href = 'admin.php' class 'a1'> Обновить страницу </a></h3>";
						
					}
					
					//Удаление категории
					//Проверка нажатия кнопки
					if ($_POST ['kat_del'] == 'Удалить') {
						//Получение переменных
						$id = $_POST['id'];
						?>
						<h3>Вы уверены что хотите удалить категорию?</h3>
						<form action = 'admin.php' method = 'post'>
							<input type = 'hidden' name = 'id' value = '<? echo $id; ?>'>
							<input type = 'submit' name = 'kat_dell2' value = 'Удалить категорию'>
						</form>
						<form action = 'admin.php' method = 'post'>
							<input type = 'submit' value = 'Нет'>
						</form>
						<?	
					}
					if ($_POST ['kat_dell2'] == 'Удалить категорию') {
						//
						$id = $_POST['id'];
						//
						$query ="DELETE FROM `kategory` WHERE `id` = '$id' ";
						//
						$result =mysqli_query($conn, $query);
						//
						echo "<h3> Категория удалена! </h3><br>";
						echo "<h3><a href='admin.php'class='a1'> Обновить страницу </a></h3><br>";
						
					}
					// Удаление товара
					// Проверка нажатия кнопки
					if ($_POST ['tov_del'] == 'Удалить') {
						//Получение переменных
						$id = $_POST['id'];
						?>
						<h3>Вы уверены что хотите удалить товар?</h3>
						<form action = 'admin.php' method = 'post'>
							<input type = 'hidden' name = 'id' value = '<? echo $id; ?>'>
							<input type = 'submit' name = 'tov_dell2' value = 'Удалить товар'>
						</form>
						<form action = 'admin.php' method = 'post'>
							<input type = 'submit' value = 'Нет'>
						</form>
						<?	
					}
					if ($_POST ['tov_dell2'] == 'Удалить товар') {
						//
						$id = $_POST['id'];
						//
						$query ="DELETE FROM `tovar` WHERE `id` = '$id' ";
						//
						$result =mysqli_query($conn, $query);
						//
						echo "<h3> Категория удалена! </h3><br>";
						echo "<h3><a href='admin.php'class='a1'> Обновить страницу </a></h3><br>";	
					}
					
					// Удаление пользователя
					// Проверка нажатия кнопки
					if ($_POST ['pol_del'] == 'Удалить') {
						//Получение переменных
						$id = $_POST['id'];
						?>
						<h3>Вы уверены что хотите удалить пользователя?</h3>
						<form action = 'admin.php' method = 'post'>
							<input type = 'hidden' name = 'id' value = '<? echo $id; ?>'>
							<input type = 'submit' name = 'pol_del2' value = 'Удалить пользователя'>
						</form>
						<form action = 'admin.php' method = 'post'>
							<input type = 'submit' value = 'Нет'>
						</form>
						<?	
					}
					if ($_POST ['pol_del2'] == 'Удалить пользователя') {
						//
						$id = $_POST['id'];
						//
						$query ="DELETE FROM `user` WHERE `id` = '$id' ";
						//
						$result =mysqli_query($conn, $query);
						//
						echo "<h3> Пользователь удалён! </h3><br>";
						echo "<h3><a href='admin.php'class='a1'> Обновить страницу </a></h3><br>";	
					}
					
					?>
					<?
					// Удаление заказа
					// Проверка нажатия кнопки
					if ($_POST ['zak_del'] == 'Удалить') {
						//Получение переменных
						$id = $_POST['id'];
						?>
						<h3>Вы уверены что хотите удалить заказ?</h3>
						<form action = 'admin.php' method = 'post'>
							<input type = 'hidden' name = 'id' value = '<? echo $id; ?>'>
							<input type = 'submit' name = 'zak_del2' value = 'Удалить заказ'>
						</form>
						<form action = 'admin.php' method = 'post'>
							<input type = 'submit' value = 'Нет'>
						</form>
						<?	
					}
					if ($_POST ['zak_del2'] == 'Удалить заказ') {
						//
						$id = $_POST['id'];
						//
						$query ="DELETE FROM `zakaz` WHERE `id` = '$id' ";
						//
						$result =mysqli_query($conn, $query);
						//
						echo "<h3> Пользователь удалён! </h3><br>";
						echo "<h3><a href='admin.php'class='a1'> Обновить страницу </a></h3><br>";	
					}
					
					?>
					
					
					<!--Изменение категории-->
					<?
					//Проверка нажатия кнопки
					if ($_POST ['kat_red'] == 'Изменить') {
						//Получение переменных
						$id = $_POST['id'];
					// запрос на отображение категорий
					$query = "SELECT * FROM `kategory` WHERE `id`='$id'";
					// отправка запроса
					$result = mysqli_query($conn, $query);
					// цикл с выводом данных из БД
					$row = mysqli_fetch_array($result);
						?>
						<form action = 'admin.php' method = 'post'>
							<input type = 'hidden' name = 'id' value='<? echo $row[0]; ?>'>
							<input type = 'text' name = 'name' value='<? echo $row[1]; ?>'>
							<input type = 'submit' name = 'kat_red2' value = 'Изменить категорию'>
						</form>
						<?
					}
					?>
					<?
					
					//Проверка нажатия кнопки
					if ($_POST ['kat_red2'] == 'Изменить категорию') {
						//
						$id = $_POST['id'];
						$name = $_POST['name'];
						// запрос на отображение категорий
						$query = "UPDATE `kategory` SET `name`='$name' WHERE `id`='$id'";
						// отправка запроса
						$result = mysqli_query($conn, $query);
						echo "<h3> Категория изменена! </h3><br>";
						echo "<h3><a href='admin.php'class='a1'> Обновить страницу </a></h3><br>";	
					}
					
					?>
					
					<!--Изменение товара-->
					<?
					//Проверка нажатия кнопки
					if ($_POST ['tov_red'] == 'Изменить') {
						//Получение переменных
						$id = $_POST['id'];
					// запрос на отображение категорий
					$query = "SELECT * FROM `tovar` WHERE `id`='$id'";
					// отправка запроса
					$result = mysqli_query($conn, $query);
					// цикл с выводом данных из БД
					$row = mysqli_fetch_array($result);
						?>
						<form action = 'admin.php' method = 'post'>
							<input type = 'hidden' name = 'id' value='<? echo $row[0]; ?>'><br>
							<input type = 'text' name = 'name' value='<? echo $row[1]; ?>'><br>
							<input type = 'file' name = 'img' value='<? echo $row[2]; ?>'><br>
							<input type = 'number' name = 'price' value='<? echo $row[3]; ?>'><br>
							<input type = 'text' name = 'about' value='<? echo $row[4]; ?>'><br>
							<input type = 'number' name = 'Kolichestvo' value='<? echo $row[5]; ?>'><br>
							<input type = 'number' name = 'Gram' value='<? echo $row[6]; ?>'><br>
							<input type = 'number' name = 'Kkal' value='<? echo $row[7]; ?>'><br>
							<input type = 'text' name = 'Cook' value='<? echo $row[8]; ?>'><br>
							<input type = 'submit' name = 'tov_red2' value = 'Изменить товар'><br>
						</form><br>
						<select name="kategory" required="kategory">
								  <option value="">Выберите категорию</option>
								  <option value="Суши">Джемпер</option>
								  <option value="Пицца">Юбка</option>
								  <option value="Напитки">Платье</option>
								  <option value="Комбо">Пальто</option>
								  <option value="Соусы">Жакет</option>
							</select>
						<?
					}
					?>
					<?
					
					//Проверка нажатия кнопки
					if ($_POST ['tov_red2'] == 'Изменить товар') {
						//
						$id = $_POST['id'];
						$name = $_POST['name'];
						$img = $_POST['img'];
						$price = $_POST['price'];
						$about = $_POST['about'];
						$Kolichestvo = $_POST['Kolichestvo'];
						$Gram = $_POST['Gram'];
						$Kkal = $_POST['Kkal'];
						$Cook = $_POST['Cook'];
						
						// запрос на отображение категорий
						$query = "UPDATE `tovar` SET `name`='$name', `img`='$img', `price`='$price', `about`='$about', `Kolichestvo`='$Kolichestvo', `Gram`='$Gram', `Kkal`='$Kkal', `Cook`='$Cook' WHERE `id`='$id'";
						// отправка запроса
						$result = mysqli_query($conn, $query);
						
						echo "<h3> Товар изменен! </h3><br>";
						echo "<h3><a href='admin.php'class='a1'> Обновить страницу </a></h3><br>";
					}
					
					?>
					
					<!--Изменение пользователя-->
					<?
					//Проверка нажатия кнопки
					if ($_POST ['pol_red'] == 'Изменить') {
						//Получение переменных
						$id = $_POST['id'];
					// запрос на отображение категорий
					$query = "SELECT * FROM `user` WHERE `id`='$id'";
					// отправка запроса
					$result = mysqli_query($conn, $query);
					// цикл с выводом данных из БД
					$row = mysqli_fetch_array($result);
						?>
						<form action = 'admin.php' method = 'post'>
							<input type = 'hidden' name = 'id' value='<? echo $row[0]; ?>'><br>
							<input type = 'number' name = 'status' value='<? echo $row[3]; ?>'><br>
							<input type = 'date' name = 'data_rozh' value='<? echo $row[4]; ?>'><br>
							<input type = 'text' name = 'City' value='<? echo $row[5]; ?>'><br>
							<input type = 'text' name = 'fio' value='<? echo $row[6]; ?>'><br>
							<input type = 'text' name = 'mail' value='<? echo $row[7]; ?>'><br>
							<input type = 'file' name = 'img' value='<? echo $row[8]; ?>'><br>
							<input type = 'text' name = 'adres' value='<? echo $row[9]; ?>'><br>
							<input type = 'number' name = 'tel' value='<? echo $row[10]; ?>'><br>
							<input type = 'submit' name = 'pol_red2' value = 'Изменить пользователя'><br>
						</form><br>
						<?
					}
					?>
					<?
					
					//Проверка нажатия кнопки
					if ($_POST ['pol_red2'] == 'Изменить пользователя') {
						//
						$id = $_POST['id'];
						$status = $_POST['status'];
						$data_rozh = $_POST['data_rozh'];
						$City = $_POST['City'];
						$fio = $_POST['fio'];
						$mail = $_POST['mail'];
						$img = $_POST['img'];
						$adres = $_POST['adres'];
						$tel = $_POST['tel'];
						
						// запрос на отображение категорий
						$query = "UPDATE `user` SET `status`='$status', `data_rozh`='$data_rozh', `City`='$City', `fio`='$fio', `mail`='$mail', `img`='$img', `adres`='$adres', `tel`='$tel' WHERE `id`='$id'";
						// отправка запроса
						$result = mysqli_query($conn, $query);
						
						echo "<h3> пользователь изменен! </h3><br>";
						echo "<h3><a href='admin.php'class='a1'> Обновить страницу </a></h3><br>";
						echo $query;
					}
					
					?>
					
					
					
					<!--Изменение статуса заказа-->
					<?
					//Проверка нажатия кнопки
					if ($_POST ['zak_reg'] == 'Изменить') {
						//Получение переменных
						$id = $_POST['id'];
					// запрос на отображение категорий
					$query = "SELECT * FROM `zakaz` WHERE `id`='$id'";
					// отправка запроса
					$result = mysqli_query($conn, $query);
					// цикл с выводом данных из БД
					$row = mysqli_fetch_array($result);
						?>
						<form action = 'admin.php' method = 'post'>
							<input type = 'hidden' name = 'id' value='<? echo $row[0]; ?>'><br>
							<select name="status" required="status">
								  <option value="Подтвержден">Подтвержден</option>
								  <option value="Не подтвержден">Не подтвержден</option>
							</select>
							<input type = 'submit' name = 'zak_reg2' value = 'Изменить статус'><br>
						</form><br>
						<?
					}
					?>
					<?
					
					//Проверка нажатия кнопки
					if ($_POST ['zak_reg2'] == 'Изменить статус') {
						//
						$id = $_POST['id'];
						$status = $_POST['status'];
						// запрос на отображение категорий
						$query = "UPDATE `zakaz` SET `status`='$status' WHERE `id`='$id'";
						// отправка запроса
						$result = mysqli_query($conn, $query);
						
						echo "<h3> статус изменен! </h3><br>";
						echo "<h3><a href='admin.php'class='a1'> Обновить страницу </a></h3><br>";
						echo $query;
					}
					
					?>
					
					
					
					<h2> Категории </h2>
					<table border=1>
						<tr>
							<th>Наименования</th>
							<th></th>
							<th></th>
						</tr>
					<?
					// запрос на отображение категорий
					$query = "SELECT * FROM `kategory`";
					// отправка запроса
					$result = mysqli_query($conn, $query);
					// цикл с выводом данных из БД
					while($row = mysqli_fetch_array($result)) {
						?>
						<tr>
							<td><? echo $row[1]; ?></td>
							<td>
								<form action = 'admin.php' method = 'post'>
									<input type = 'hidden' name = 'id' value = '<? echo $row[0]; ?>'>
									<input type = 'submit' name = 'kat_red' value = 'Изменить'>
								</form>
							</td>
							<td>
								<form action = 'admin.php' method = 'post'>
									<input type = 'hidden' name = 'id' value = '<? echo $row[0]; ?>'>
									<input type = 'submit' name = 'kat_del' value = 'Удалить'>
								</form>
							</td>
						</tr>
						<?
					}
					?>
					</table>
					<h2> Товары </h2>
					<table border=1>
						<tr>
							<th>img</th>
							<th>Наименования</th>
							<th>price</th>
							<th>about</th>
							<th>Кол-во</th>
							<th>Цвет</th>
							<th>Страна</th>
							<th>Категория</th>
							<th></th>
							<th></th>
						</tr>
						<?
					// запрос на отображение категорий
					$query = "SELECT * FROM `tovar`";
					// отправка запроса
					$result = mysqli_query($conn, $query);
					// цикл с выводом данных из БД
					while($row = mysqli_fetch_array($result)) {
						?>
						<tr>
							<td> <img src='img/<? echo $row[2]; ?>' alt='tovar' class='img_admin' width="100" > </td>
							<td> <? echo $row[1]; ?> </td>
							<td> <? echo $row[3]; ?> </td>
							<td> <? echo $row[4]; ?> </td>
							<td> <? echo $row[5]; ?> </td>
							<td> <? echo $row[6]; ?> </td>
							<td> <? echo $row[7]; ?> </td>
							<td> <? echo $row[8]; ?> </td>
							
							<td>
								<form action = 'admin.php' method = 'post'>
									<input type = 'hidden' name = 'id' value = '<? echo $row[0]; ?>'>
									<input type = 'submit' name = 'tov_red' value = 'Изменить'>
								</form>
							</td>
							<td>
								<form action = 'admin.php' method = 'post'>
									<input type = 'hidden' name = 'id' value = '<? echo $row[0]; ?>'>
									<input type = 'submit' name = 'tov_del' value = 'Удалить'>
								</form>
							</td>
						</tr>
						<?
					}
						?>
					</table>
					<h2> Пользователи </h2>
					<table border=1>
						<tr>
							<th>img</th>
							<th>Логин</th>
							<th>Пароль</th>
							<th>Статус</th>
							<th>Дата рождения</th>
							<th>Город</th>
							<th>Mail</th>
							<th>Телефон</th>
							
							<th></th>
							<th></th>
						</tr>
						<?
					// запрос на отображение категорий
					$query = "SELECT * FROM `user`";
					// отправка запроса
					$result = mysqli_query($conn, $query);
					// цикл с выводом данных из БД
					while($row = mysqli_fetch_array($result)) {
						?>
						<tr>
							<td> <img src='img/<? echo $row[8]; ?>' alt='tovar' class='img_admin' width="100"> </td>
							<td> <? echo $row[1]; ?> </td>
							<td> <? echo $row[2]; ?> </td>
							<td> <? echo $row[3]; ?> </td>
							<td> <? echo $row[4]; ?> </td>
							<td> <? echo $row[5]; ?> </td>
							<td> <? echo $row[7]; ?> </td>
							<td> <? echo $row[10]; ?> </td>
							<td>
								<form action = 'admin.php' method = 'post'>
									<input type = 'hidden' name = 'id' value = '<? echo $row[0]; ?>'>
									<input type = 'submit' name = 'pol_red' value = 'Изменить'>
								</form>
							</td>
							<td>
								<form action = 'admin.php' method = 'post'>
									<input type = 'hidden' name = 'id' value = '<? echo $row[0]; ?>'>
									<input type = 'submit' name = 'pol_del' value = 'Удалить'>
								</form>
							</td>
						</tr>
						<?
					}
						?>
					</table>
					<h2> Заказы </h2>
					<table border = 1>
						<tr>
							<th> № </th>
							<th> Изображение </th>
							<th> Наименование </th>
							<th> Цена </th>
							<th> Количество </th>
							<th> Описание </th>
							<th> Дата </th>
							<th> Пользователь </th>
							<th> Статус </th>
							<th></th>
							<th></th>
						</tr>
						<?
						// запрос на отображение категорий
						$query = "SELECT * FROM `zakaz`";
						// отправка запроса
						$result = mysqli_query($conn, $query);
						// цикл с выводом данных из БД
						while($row = mysqli_fetch_array($result)) {
							?>
							<tr>
								<td> <? echo $row[1]; ?> </td>
								<td> <img src='img/<? echo $row[3]; ?>' alt='tovar' class='img_admin' width="100"> </td>
								<td> <? echo $row[2]; ?> </td>
								<td> <? echo $row[4]; ?> </td>
								<td> <? echo $row[5]; ?> </td>
								<td> <? echo $row[6]; ?> </td>
								<td> <? echo $row[7]; ?> </td>
								<td> <? echo $row[8]; ?> </td>
								<td> <? echo $row[9]; ?> </td>
								<td>
								<?
								if ($row[9]== 'Новый') {
								?>
									<form action = 'admin.php' method = 'post'>
										<input type = 'hidden' name = 'id' value = '<? echo $row[0]; ?>'>
										<input type = 'submit' name = 'zak_reg' value = 'Изменить'>
									</form>
								<?
								}
								?>
								</td>
								<td>
									<form action = 'admin.php' method = 'post'>
										<input type = 'hidden' name = 'id' value = '<? echo $row[0]; ?>'>
										<input type = 'submit' name = 'zak_del' value = 'Удалить'>
									</form>
								</td>
							</tr>
							<?
						}
						?>
					</table>
					
					<?
				}
				else {
					echo "<h3> У вас нет прав доступа! </h3><br>";
					echo "<h3> <a href = 'auto.php' сlass = ' a1'> Авторизуйтесь еще раз </a></h3>";
				}
				?>
			</section>
			
		</main>
		
		<!-- подвал -->
		
	</body>
</html>