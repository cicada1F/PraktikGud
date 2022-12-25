<?php
session_start();
?>
<!DOCTYPE html>
<html>
<audio autoplay loop preload="auto">
    <source src="css/musicHis.mp3" type="audio/mpeg">
  </audio>
<head>
	<title>История</title>
	<link rel="stylesheet" href="css/styles.css">
	<script type="text/javascript" src="js/script.js"></script>
	<meta charset="UTF-8">
</head>

<body>
	<div class="piska"></div>
	<div id="header">
<?php

	require_once 'login.php';

	if (!isset($_GET["action"])) $_GET["action"] = "showlist";

	switch ($_GET["action"]) {
		case 'showlist':
			show_list($link);
			break;
		
		default:
			show_list($link);
			break;
	}
	


	function show_list($link){
		global $link;
		$que = 'SELECT * FROM history ORDER BY id DESC';
		$res = mysqli_query($link, $que);
		echo '<div class="d_cont">
		<h1>User purchase history <button type="button" onClick="history.back();"><h2>↪</h2></button></h1>
		<br>
		<br><table border="1" class="data_tbl">
		<tr align="center"><th>#</th><th>Пользователь (Логин)</th><th>Заказ</th><th>Дата</th></tr>
		';

			while ($item = mysqli_fetch_array($res)){
				$que1 = 'SELECT * FROM active WHERE id_act = '.$item['id_sub'];
				$res1 = mysqli_fetch_array(mysqli_query($link, $que1));
				$sub_name = $res1['name_act'];

				$que1 = 'SELECT * FROM users WHERE id = '.$item['id_user'];
				$res1 = mysqli_fetch_array(mysqli_query($link, $que1));
				$user_name = $res1['login'];
				echo '<tr align="center" class="tbl">
				<td>'.$item['id'].'</td>
				<td>'.$user_name.'</td>
				<td>'.$sub_name.'</td>
				<td>'.$item['dates'].'</td>';
			}
			echo '</table><br>';
	}

	
?>

</body>
</html>