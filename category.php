<?php
session_start();
?>
<!DOCTYPE html>
<html>
<audio autoplay loop preload="auto">
    <source src="css/musicRed.mp3" type="audio/mpeg">
  </audio>
<head>
	<title>Редактор</title>
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
		case 'addform':
			get_add_item_form($link);
			break;
		case 'add':
			add_item($link);
			break;
		case 'editform':
			get_edit_item_form($link);
			break;
		case 'update':
			update_item($link);
			break;
		case 'delete':
			delete_item($link);
			break;
		
		default:
			show_list($link);
			break;
	}

	function show_list($link){
		global $link;
		$que = 'SELECT * FROM category';
		$res = mysqli_query($link, $que);
		echo '<div class="d_cont">
		<h1>Services <button type="button" onClick="history.back();"><h2>↪</h2></button></h1><br>
		<br><table border="1" class="data_tbl">
		<tr align="center"><th><h2>Editing</h2></th><th colspan="2"></th></tr>
		';

		if (empty($_SESSION['id'])){
			while ($item = mysqli_fetch_array($res)){
				echo '<tr align="center" class="tbl">
				<td>'.$item['name_cat'].'</td>
				<td colspan="2"></td>';
			}
		} elseif ($_SESSION['status'] == 1) {
			while ($item = mysqli_fetch_array($res)){
				echo '<tr align="center" class="tbl">
				<td>'.$item['name_cat'].'</td>
				<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id_cat='.$item['id_cat'].'"><img src="img/edit.png" title="Редактировать"></a></td>
				<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id_cat='.$item['id_cat'].'"><img src="img/drop.png" title="Удалить" onClick="return confirmDelete();"></a></td>
				</tr>
				';
			}
			echo '<tr align="center"><td colspan=3>
			<a href="'.$_SERVER['PHP_SELF'].'?action=addform"><ul class="nav"><li><button type="button">Добавить</a></button></li></ul>
			</td></tr>
			';
		} else {
			while ($item = mysqli_fetch_array($res)){
				echo '<tr align="center" class="tbl">
				<td>'.$item['name_cat'].'</td>
				<td colspan="2"></td>';
			}
		}
		echo "</table></div>";
	}

	function get_add_item_form(){
		if ($_SESSION['status'] == 1)
		{
			echo '<div class="d_cont">
			<h2>Добавить</h2>
			<form name="addform" action="'.$_SERVER['PHP_SELF'].'?action=add" method="POST">
			<button type="button" onClick="history.back();">Отменить</button><br />
			<br><table border="1" class="data_tbl">
			<tr>
			<td>Категория</td>
			<td><input type="text" name="name_cat" value="" /></td>
			</tr>
			<tr align="center">
			<td colspan="2"><input type="submit" value="Сохранить"></td>
			</tr>
			</table>
			</form>
			</div>
			';
		} else {
			echo '<meta http-equiv="refresh" content="0;URL=category.php">';
		}
	}

	function add_item(){
		global $link;
		$name_cat = mysqli_escape_string($link, $_POST['name_cat']);
		$query = "INSERT INTO category (name_cat) VALUES ('".$name_cat."');";
		mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
		echo '<meta http-equiv="refresh" content="0;URL=category.php">';
		die();
	}

	function get_edit_item_form(){
		if ($_SESSION['status'] == 1)
		{
			global $link;
			echo '<div class="d_cont">
			<h2>Редактировать</h2>';
			$que = 'SELECT * FROM category WHERE id_cat='.$_GET['id_cat'];
			$res = mysqli_query($link, $que) or die("Ошибка ".mysqli_error($link));
			$item = mysqli_fetch_array($res);
			echo '<form name="editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id_cat='.$_GET['id_cat'].'" method="POST">
			<button type="button" onClick="history.back();">отменить</button><br />
			<br><table border="1" class="data_tbl">
			<tr>
			<td>Категория</td>
			<td><input type="text" name="name_cat" value="'.$item['name_cat'].'"></td>
			</tr>
			<tr align="center">
			<td colspan=5><input type="submit" value="Сохранить"></td>
			</tr>
			</table>
			</form>
			</div>
			';
		} else {
			echo '<meta http-equiv="refresh" content="0;URL=category.php">';
		}
	}

	function update_item(){
		global $link;
		$name_cat = mysqli_escape_string($link, $_POST['name_cat']);
		$que = "UPDATE category SET name_cat='".$name_cat."' WHERE id_cat=".$_GET['id_cat'];
		mysqli_query($link, $que) or die("Ошибка ".mysqli_error($link));
		echo '<meta http-equiv="refresh" content="0;URL=category.php">';
		die();
	}

	function delete_item(){
		if ($_SESSION['status'] == 1)
		{
			global $link;
			$que = "DELETE FROM category WHERE id_cat=".$_GET['id_cat'];
			mysqli_query($link, $que) or die("Ошибка ".mysqli_error($link));
			echo '<meta http-equiv="refresh" content="0;URL=category.php">';
			die();
		} else {
			echo '<meta http-equiv="refresh" content="0;URL=category.php">';
		}
	}
?>

</body>
</html>