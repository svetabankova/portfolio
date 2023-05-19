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
				<?
				if ($_SESSION['login']!='') {
					$login=$_SESSION['login'];
				?>
				<h2 align = 'center'> Личный кабинет </h2>
				<?
				//проверка нажатия кнопки 
				if ($_POST['img']=='Сохранить'){
					//принятие перменных
					$avatar=$_POST['avatar'];
					//запрос на изменение аватар
					$query="UPDATE `user` SET `img`='$avatar'WHERE `login` = '$login'";
					// отправка запроса 
					$result=mysqli_query($conn,$query);
				}
				if ($_POST['save']=='Сохранить'){
					if ($_POST['pass1'] == $_POST['pass2']){
					//принятие перменных
					$login = $_POST['login'];
					$password = $_POST['pass1'];
					$fio = $_POST['name'];
					$surname = $_POST['surname'];
					$mail = $_POST['mail'];
					$city = $_POST['City'];
					$adres = $_POST['adres'];
					$data_rozh = $_POST['data_rozh'];
					$tel = $_POST['tel'];
					//запрос на изменение аватар
					$query="UPDATE `user` SET `login`='$login', `password`='$password', `name`='$fio',`mail`='$mail',`City`='$city',`adres`='$adres',`data_rozh`='$data_rozh',`tel`='$tel', `surname`='$surname' WHERE `login` = '$login'";
					// отправка запроса  
					$result=mysqli_query($conn,$query);
					}
					else {
						echo "<h3> Пароли не совпадают! </h3><br>";
					}
				}
				// запрос на отображение данных пользователя
				$query = "SELECT * FROM `user` WHERE `login`='$login'";
				// отправка запроса
				$result=mysqli_query($conn,$query);
				// вывод данных из Бд
				$row=mysqli_fetch_array($result);
				?>
				
				<!-- аватар ил ЛК -->
				<div class = 'lichka'>
					<img src='img/<? echo $row[8]; ?>' alt='avatar' class='avatar'>
					<form action='LK.php' method='post'>
						<input type='file' name='avatar'>
						<input type='submit'name='img' value='Сохранить'>
					</form>
				</div>
				<div class = 'lichka'>
					<!-- форма для вывода данных и лк -->
					<form action='LK.php' method='post'>
						
							<label>Имя</label><br>
							<input type='text' name='name' value='<? echo $row[6];?>'> <br>

							<label>Фамилия</label><br>
							<input type='text' name='surname' value='<? echo $row[11];?>'> <br>
							
							<label>Логин</label><br>
							<input type='text' name='login' value='<? echo $row[1];?>'> <br>
							
							<label>Email</label><br>
							<input type='text' name='mail' value='<? echo $row[7];?>'> <br>
							
							<label>Пароль</label><br>
							<input type='password' name='pass1' value='<? echo $row[2];?>'> <br>
							
							<label>Повторите пароль</label><br>
							<input type='password' name='pass2' value='<? echo $row[2];?>'> <br>
							
							<label>Город</label><br>
							<input type='text' name='City' value='<? echo $row[5];?>'> <br>
							
							<label>Адрес доставки</label><br>
							<input type='text' name='adres' value='<? echo $row[9];?>'> <br>
							
							<label>Дата рождения</label><br>
							<input type='date' name='data_rozh' value='<? echo $row[4];?>'> <br>
							
							<label>Телефон</label> <br>
							<input type='number' name='tel' value='<? echo $row[10];?>'> <br>
							<input type='submit' name='save' value='Сохранить'>
					</form>
				</div>
				
				
			<div class='profile'>
			<h2>История заказов </h2>
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
					<td>
						Номер товара
					</td>
					<td>
						Количество
					</td>
					<td>
						Цена за ед.
					</td>
					<td>
						
						Итоговая цена
					</td>
					<td>
						Дата оформления
					</td>
					<td>
						Статус
					</td>
				</tr>
			
				<?
				// проверка нажатия кнопки
				if($_POST['zakaz']=='Оформить заказ'){
				// запрос на чтение корзины
				$query1="SELECT * FROM `korzina` WHERE `login`='$login'";
				// отправка запроса
				$result1=mysqli_query($conn,$query1);
				//цикл с выгрузкой данных из корзины
				while($row=mysqli_fetch_array($result1)){
					$id_tov=$row[1];
					$name=$row[3];
					$img=$row[2];
					$price=$row[6];
					$kolvo=$row[5];
					$about1=$row[4];
					$date=date("y-m-d");
					//запрос на формирование заказа
					$query="INSERT INTO `zakaz`(`id_tov`, `name`, `img`, `price`, `kol-vo`, `about1`, `date`, `login`, `status`) 
								VALUES ('$id_tov', '$name', '$img', '$price', '$kolvo', '$about1', '$date', '$login', 'Новый')";
					//отправка запроса
					$result=mysqli_query($conn,$query);
					
				}
				//очищаем корзину
				$query2="DELETE FROM `korzina` WHERE `login`='$login'";
				//отправка запроса
				$result2=mysqli_query($conn,$query2);
				}
				// отображаем список заказов
				$i=1;
				// запрос на поиск всех  пользователей
				$query3="SELECT * FROM `zakaz` WHERE `login`='$login'";

				// отправка запроса
				$result3=mysqli_query($conn,$query3);
				//цикл с выгрузкой данных из корзины
				while($row = mysqli_fetch_array($result3)){
				?>
				<tr>
					<td>
						<? echo $i++; ?>
					</td>
					<td>
						<img src='img/<? echo $row[3]; ?>' alt='tovar' class='tovar_mini'>
					</td>
					<td>
						<? echo $row[2]; ?>
					</td>
					<td>
						<? echo $row[6]; ?>
					</td>
					<td>
						<? echo $row[1]; ?>
					</td>
					<td>
						<? echo $row[5]; ?>
					</td>
					<td>
						<? echo $row[4]; ?>
					</td>
					<td>
						<? echo $row[5] * $row[4]; ?>
					</td>
					<td>
						<? echo $row[7]; ?>
					</td>
					<td>
						<? echo $row[9]; ?>
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
					echo "<h3> <a href = 'reg.php' сlass = ' a1'> Авторизуйтесь еще раз </a></h3>";
				}
				?>
				</div>
			</section>
			
		</main>
		
		<!-- подвал -->
		
	</body>
</html>