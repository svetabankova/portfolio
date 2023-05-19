<a href='reg.php' class='a1'> Войти </a>
<a href='reg.php' class='a1'> Регистрация </a>
<?
if ($_SESSION['status'] ==1){
?>
<a href='admin.php' class='a1'> Админка </a>
<?
}
?>
<?
if ($_SESSION['login'] ==1){
?>

<form action='index.php' method='post'>
	<input type='submit' name='vihod' value='выход'>
</form>
<?
}
?>