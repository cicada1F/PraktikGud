</!DOCTYPE html>
<html>

<audio autoplay loop preload="auto">
    <source src="css/.mp3" type="audio/mpeg">
  </audio>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

</head>
<body>
	<div class="piska"></div>
	<div class="d_reg">
		<div id="header">

		<?php
		//$_SESSION['buy'] = array();
		if (empty($_SESSION['buy'])){
			$_SESSION['buy'] = array();
		}
		if (empty($_SESSION['login']) or empty($_SESSION['id'])){
			echo '<h2>Welcome</h2> <h3>NoName!</h3><br>';
			echo '<li><a href="reg_form.php">Sign In</a></li>';
			echo '<li><a href="auth_form.php">Log In</a></li>';
			echo '<li><a href="main.php">Home</a></li>';
		} else {
			echo '<h2>Welcome '.$_SESSION['login'].'</h2><b><br><li><a href="?exit">Sign Out</a></li>';
		}
		echo '<br><br><li><a href="department.php">Orders('.count($_SESSION['buy']).')</a></li>';

		if(isset($_GET['exit'])){
			//session_unset();
			//session_destroy();
			unset($_SESSION['id']);
			unset($_SESSION['status']);
			echo '<meta http-equiv="refresh" content="0;URL='.$_SERVER['PHP_SELF'].'">';
			exit;
		}
		?>

	
				<?php
					if (!empty($_SESSION['id']) && $_SESSION['status']==1){
						echo '<li><a href="category.php">Editor</a></li>';
						echo '<li><a href="history.php">History</a></li>';
					}
				?>
	
</div>


</body>
</html>