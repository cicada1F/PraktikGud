<?php
session_start();
?>
<!DOCTYPE html>
<html>
<audio autoplay loop preload="auto">
	
    <source src="css/musicAuth.mp3" type="audio/mpeg">
 
  
  </audio>
<head>
	<title>Underdog</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
<div class="piska"></div>
 <div id="header">
	 
	 	<button onclick="history.back();"><h2>↪</h2></button>
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

	$result = mysqli_query($link, "SELECT * FROM users WHERE login='$login'");
	$myrow = mysqli_fetch_array($result);
	if (empty($myrow['password'])){
		exit("<h2>Sorry Underdog!, the username or password you entered is incorrect.</h2>");
	} else {
		if ($myrow['password']==$password){
			$_SESSION['id'] = $myrow['id'];
			$_SESSION['login'] = $myrow['login'];
			$_SESSION['status'] = $myrow['status'];
			echo "<h2>Welcome</h2> <h1>".$_SESSION['login']."</h1><br>";
			#echo "<pre>";
			#print_r($_SESSION);
			#echo "</pre>";
		} else {
			exit("<h2>Sorry Underdog!, the username or password you entered is incorrect.</h2>");
		}
	}
?>

</ul>

</div>

</body>
</html>