<?php
session_start();
?>
<!DOCTYPE html>
<html>
<audio autoplay loop preload="auto">
    <source src="css/musicREG.mp3" type="audio/mpeg">
  </audio>
<head>
	<title>Регистрация</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/styles.css">
</head>

<body><div class="piska"></div>


 <div id="header">
	 <ul class="nav">
	<?php

	if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
	?>
	<h1>SignUp</h1>
	<form action="reg.php" method="post">
		
		
		<p>
			<label><a>Your email: </a><br></label>
			<input name="login" type="email" size="20" maxlength="100" >
		</p>
		<br>
		<p>
			<label><a>create a password: </a><br></label>
			<input name="password" type="password" size="15" maxlength="15">
		</p>
		 <ul class="nav"><li><button><a>SignUp</a></button></li>
	</form>
	<?php



	} else {
		echo '<h1>'.$_SESSION['login'].'!</h1><h2> you have already logged in</h2>.';
	}
	?><br>
	<li><a href="main.php">Back</a></li>
	
</div>
</body>
</html>