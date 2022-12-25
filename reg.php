<?php
session_start();
?>
<!DOCTYPE html>
<html>
<audio autoplay loop preload="auto">
    <source src="css/musicREG.mp3" type="audio/mpeg">
  </audio>
<head>
	<meta charset="UTF-8">
	<title>Underdog</title>
	
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
<div class="piska"></div>
<?php
//	require_once 'menu.php';
?>

 <div id="header">
	
	 	

<?php
	if (isset($_POST['login'])){
		$login = $_POST['login'];
		if ($login == ''){
			unset($login);
		}
	}
	if (isset($_POST['password'])){
		$password = $_POST['password'];
		if ($password == ''){
			unset($password);
		}
	}

	if (empty($login) or empty($password))
		exit("<h2>Underdog! you have not entered all the information, go back and fill in all the fields!</h2>");

	$login = stripslashes($login);
	$login = htmlspecialchars($login);
	$password = stripslashes($password);
	$password = htmlspecialchars($password);

	$login = trim($login);
	$password = trim($password);
	$password = md5($password);

	require_once "login.php";

	$result = mysqli_query($link, "SELECT id FROM users WHERE login='$login'");
	$myrow = mysqli_fetch_array($result);
	if (!empty($myrow['id']))
		exit("<h2>Sorry Underdog! the username you entered is already registered. Enter a different username.</h2>");

	$result2 = mysqli_query($link, "INSERT INTO users (login, password, status) VALUES ('$login', '$password', 10)");
	if ($result2=="TRUE"){
		echo "<h2>Underdog! you have successfully registered! Now you can go to the website.</h2><a href='auth_form.php'><h2>Log to site</h2></a>";
	} else {
		echo "<h2>Underdog! you're not registered.</h2>";
	}
?>

</div>

</body>
</html>