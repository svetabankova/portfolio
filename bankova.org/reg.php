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
				// проверка нажатия кнопки
				if($_POST['reg']=='Зарегистрироваться'){
					// Получение значимых переменных
					$name=$_POST['name'];
					$surname=$_POST['surname'];
					$mail=$_POST['mail'];
					$login=$_POST['login'];
					$pass1=$_POST['pass1'];
					$pass2=$_POST['pass2'];
					//проверка паролей
					if($pass1 != $pass2) {
						echo " <h3> Пароль не верный! <h3>";
					}
					else {
						$pass = $pass1;
						//запрос на поиск пользователя
						$query = "SELECT * FROM `user` WHERE `login` = '$login'";
						//отправка запроса
						$result = mysqli_query($conn, $query);
						//проверка на логин и пароль в бд
						$num = mysqli_num_rows($result);
						if ($num > 0) {
							echo " <h3> Пользователь с этим именем уже зарегистрирован <h3>";
							echo "<h3> <a href = 'reg.php' сlass = ' a1'> Зарегистрироватся заново </a></h3>";
						}
						else {
							//запрос на добавление пользователя
							$query =" INSERT INTO `user` (`login`, `name`, `surname`, `mail`, `password`, `status`)
												VALUES ('$login', '$name', '$surname', '$mail', '$pass', '0')";
							// отправка запроса
								$result = mysqli_query($conn, $query);
							// сообщение пользователю
							echo "<h3>Пользователь успешно зарегистрирован!</h3><br>";
							echo "<h3> <a href = 'auto.php' сlass = ' a1'> Войдите в личный кабинет </a></h3>";
						}
					}
				}
				else 
				{
				?>
				<!-- Форма регистрации -->
				<center>
					<table>	
						<h2> Регистрация </h2>
						<form action = 'reg.php' method = 'post'>
							<tr>
								<td>
									Введите ваше имя
								</td>
								<td>
								<input type = 'text' name = 'name'  placeholder = 'Имя'>
								</td>
							</tr>
							<tr>
								<td>
									Введите вашу фамилия
								</td>
								<td>
								<input type = 'text' name = 'surname'  placeholder = 'Фамилия'>
								</td>
							</tr>
							<tr>
								<td>
									Введите вашу почту
								</td>
								<td>
								<input type = 'text' name = 'mail'  placeholder = 'Почта'>
								</td>
							</tr>
							<tr>
								<td>
									Введите логин
								</td>
								<td>
								<input type = 'text' name = 'login' placeholder = 'Логин'>
								</td>
							</tr>
							<tr>
								<td>
									Введите пароль
								</td>
								<td>
								<input type = 'password' name = 'pass1'  placeholder = 'Пароль'>
								</td>
							</tr>
							<tr>
								<td>
									Подтвердите пароль
								</td>
								<td>
								<input type = 'password' name = 'pass2'  placeholder = 'Пароль'>
								</td>
							</tr>
							<tr>
								<td colspan = 2>
									<input type = 'submit' name = 'reg' value = 'Зарегистрироваться'>
								</td>
							</tr>
						</form>
					</table>
				</center>
				<?
				}
				?>
			</section>
			
		</main>
		<!-- подвал -->
		
	</body>
</html>