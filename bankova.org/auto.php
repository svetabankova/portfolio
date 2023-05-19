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
				if($_POST['auto']=='Войти'){
					// Получение значимых переменных
					$login=$_POST['login'];
					$pass=$_POST['password'];
					
					//запрос на поиск пользователя
					$query = "SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$pass' ";
					//отправка запроса
					$result = mysqli_query($conn, $query);
					//проверка на логин и пароль в бд
					$num = mysqli_num_rows($result);
					if ($num == 1) {
						$_SESSION['login'] = $login;
						$_SESSION['password'] = $pass;
						
						// проверка статуса пользователя
						$row = mysqli_fetch_array($result);
						
						$_SESSION['status'] = $row[3]; // ногмер может отличаться
						
						echo "<h3>Пользователь успешно авторизован!</h3><br>";
						echo "<h3> <a href = 'LK.php' сlass = ' a1'> Войдите в личный кабинет </a></h3>";
						if ($_SESSION ['status'] == 1) {
							echo "<h3><a href = 'admin.php' class = 'a1'> Панель администратора </a></h3>";
						}
					}
					else
					{
						echo "<h3> Неверные данные! </h3>";
						echo "<h3> <a href = 'auto.php' сlass = ' a1'> Авторизуйтесь еще раз </a></h3>";
						echo "<h3> <a href = 'reg.php' сlass = ' a1'> Зарегистрироватся </a></h3>";
					}
				}
				else
				{
				?>
				<!-- Форма авторизации -->
				<center>
					<table>
						<h2> Авторизация </h2>
						<form action = 'auto.php' method = 'post'>
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
								<input type = 'password' name = 'password'  placeholder = 'Пароль'>
								</td>
							</tr>
							<tr>
								<td colspan = 2>
									<input type = 'submit' name = 'auto' value = 'Войти'>
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