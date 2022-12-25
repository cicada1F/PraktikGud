<?php
session_start();
?>
<!DOCTYPE html>
<html>
<audio autoplay loop preload="auto"> 
	
    <source src="css/musicActiv.mp3" type="audio/mpeg">
 
  
  </audio>
<head>
	<title>Услуги</title>
	<link rel="stylesheet" href="css/styles.css">

	<meta charset="UTF-8">
</head>

<body>
	<div class="piska"></div>
  <div id="header">
    <ul class="nav">
<?php
	require_once 'menu.php';
	require_once 'login.php';

	if (!isset($_GET["action"])) $_GET["action"] = "showlist";

	switch ($_GET["action"]) {
		case 'buy':
			addBuy($link);
			break;
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

	function addBuy($link)
	{
		array_push($_SESSION['buy'], $_GET['id_act']);
		echo '<meta http-equiv="refresh" content="0;URL=active.php">';
	}

	function show_list($link){
		global $link;
		$que = 'SELECT * FROM active';
		$res = mysqli_query($link, $que);
		echo '<div class="d_cont">
		<h1>Services provided<button onclick="history.back();"><h2>↪</h2></button><br></h1>
		<h3>if the number of specialists is 0, then you can leave a request and they will contact you later</h3>
		
		<br><table border="1" class="data_tbl">
		<tr align="center"><th>Наименование</th><th>Услуга</th><th>Гарантия</th><th>Доступные специалисты в данной области </th><th>Прайс</th><th>Детали</th><th colspan="2"></th></tr>
		';

		if (empty($_SESSION['id'])){
			while ($item = mysqli_fetch_array($res)){
			$que1 = 'SELECT * FROM category WHERE id_cat = '.$item['id_cat'];
			$res1 = mysqli_fetch_array(mysqli_query($link, $que1));
				echo '<tr align="center" class="tbl">
			<td>'.$item['name_act'].'</td>
			<td>'.$res1['name_cat'].'</td>
			<td>'.$item['ed_izm'].'</td>
			<td>'.$item['quantity'].'</td>
			<td>'.$item['price'].'</td>
			<td>'.$item['comments'].'</td>
			<td colspan="2"><a href="'.$_SERVER['PHP_SELF'].'?action=buy&id_act='.$item['id_act'].'"><ul class="nav"><li><button type="button">To order</a></button></ul></td>';
			}
		} elseif ($_SESSION['status'] == 1) {
			while ($item = mysqli_fetch_array($res)){
				$que1 = 'SELECT * FROM category WHERE id_cat = '.$item['id_cat'];
			$res1 = mysqli_fetch_array(mysqli_query($link, $que1));
				echo '<tr align="center" class="tbl">
				<td>'.$item['name_act'].'</td>
				<td>'.$res1['name_cat'].'</td>
				<td>'.$item['ed_izm'].'</td>
				<td>'.$item['quantity'].'</td>
				<td>'.$item['price'].'</td>
				<td>'.$item['comments'].'</td>
				<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id_act='.$item['id_act'].'"><img src="img/edit.png" title="Редактировать"></a></td>
				<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id_act='.$item['id_act'].'"><img src="img/drop.png" title="Удалить" onClick="return confirmDelete();"></a></td>
				<td><a href="'.$_SERVER['PHP_SELF'].'?action=buy&id_act='.$item['id_act'].'">
				<ul><li><button type="button">To Order</a></button></li></ul></td>	
				</tr>
				';
			}
			echo '<tr align="center"><td colspan=11>
			<a href="'.$_SERVER['PHP_SELF'].'?action=addform"><button type="button">Add</button></a>
			</td></tr></table>
			</div>
			';
		} else {
			while ($item = mysqli_fetch_array($res)){
				$que1 = 'SELECT * FROM category WHERE id_cat = '.$item['id_cat'];
			$res1 = mysqli_fetch_array(mysqli_query($link, $que1));
				echo '<tr align="center" class="tbl">
			<td>'.$item['name_act'].'</td>
			<td>'.$res1['name_cat'].'</td>
			<td>'.$item['ed_izm'].'</td>
			<td>'.$item['quantity'].'</td>
			<td>'.$item['price'].'</td>
			<td>'.$item['comments'].'</td>
			<td colspan="2"><a href="'.$_SERVER['PHP_SELF'].'?action=buy&id_act='.$item['id_act'].'"><button type="button">Заказать</button></a></td>';
			}
		}
	}

	function get_add_item_form(){
		if ($_SESSION['status']==1)
		{
			echo '<div class="d_cont">
			<h2>Добавить</h2>
			<form name="addform" action="'.$_SERVER['PHP_SELF'].'?action=add" method="POST">
			<button type="button" onClick="history.back();">Отменить</button><br />
			<br><table border="1" class="data_tbl">
			<tr>
			<td>Наименование</td>
			<td><input type="text" name="name_act" value="" /></td>
			</tr>
			<tr>
			<td>Услуга</td>
			<td>';
			global $link;
			$sql1 = "SELECT * FROM category";
			$res1 = mysqli_query($link, $sql1) or die("Err ".mysqli_error());
			echo '<select name="id_cat">\r\n
			<option selected disabled>Выберите Услугу</option>
			';
			while ($row = mysqli_fetch_array($res1)){
				$id_cat = intval($row['id_cat']);
				$name_cat = htmlspecialchars($row['name_cat']);
				echo "<option value='$id_cat'>$name_cat</option>\r\n";
			}
		echo '</select></td>';
		echo '<tr>
			<td>Гарантия	</td>
			<td><input type="text" name="ed_izm" value="" /></td>
			</tr>
			<tr>
			<td>Свободные специалисты</td>
			<td><input type="text" name="quantity" value="" /></td>
			</tr>
			<tr>
			<td>Цена</td>
			<td><input type="text" name="price" value="" /></td>
			</tr>
			';
		echo '<tr>
			<td>Комментарий</td>
			<td><input type="text" name="comments" value="" /></td>
			</tr>
			';
			
		echo '<tr align="center">
			<td colspan="2"><input type="submit" value="Сохранить"></td>
			</tr>
			</table>
			</form>
			</div>
			';
		} else {
			echo '<meta http-equiv="refresh" content="0;URL=active.php">';
		}
	}

	function add_item(){
		global $link;
		$name_act = mysqli_escape_string($link, $_POST['name_act']);
		$id_cat = mysqli_escape_string($link, $_POST['id_cat']);
		$ed_izm = mysqli_escape_string($link, $_POST['ed_izm']);
		$quantity = mysqli_escape_string($link, $_POST['quantity']);
		$price = mysqli_escape_string($link, $_POST['price']);
		$comments = mysqli_escape_string($link, $_POST['comments']);
		$query = "INSERT INTO active (name_act, id_cat, ed_izm, quantity, price, comments) VALUES ('$name_act', '$id_cat', '$ed_izm', '$quantity', '$price','$comments');";
		mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
		echo '<meta http-equiv="refresh" content="0;URL=active.php">';
		die();
	}

	function get_edit_item_form(){
		if ($_SESSION['status']==1)
		{
			global $link;
			echo '<div class="d_cont">';
			echo '<h1>Edit <button type="button" onClick="history.back();"><h2>↪</h2></button></h1>'; 
			$query = 'SELECT * FROM active WHERE id_act='.$_GET['id_act']; 
			$res = mysqli_query( $link, $query ) or die("Ошибка " . mysqli_error($link)); 
			$item = mysqli_fetch_array( $res ); 
			echo '<form name="editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id_act='.$_GET['id_act'].'" method="POST">'; 
			
			echo '<br><table border="1" class="data_tbl">'; 
			echo '<tr>'; 
			echo '<td>Наименование</td>'; 
			echo '<td><input type="text" name="name_act" value="'.$item['name_act'].'"></td>'; 
			echo '</tr>';  

			echo '<tr>'; 
			echo '<td>Категория</td>'; 
			echo '<td>'; 
			$sql4 = 'SELECT * FROM category'; 

			$res4 = mysqli_query($link,$sql4) or die( "Error in $sql4 : " . mysql_error());

			echo '<select name="id_cat">\r\n';
			echo '<option selected value="'.(int)$item['id_cat'].'">'.$item['name_cat'].'</option>';
			echo '<option disabled>------------------</option>';
			while($row = mysqli_fetch_array($res4)) 
			{ 
			  $id_cat = intval($row['id_cat']); 
			  $name_cat = htmlspecialchars($row['name_cat']);
			  echo "<option value=$id_cat>$name_cat</option>\r\n"; 
			} 
			echo "</select>\r\n";
			echo '</td>';

			echo '</tr>';  
			echo '<tr>'; 
			echo '<td>Гарантия	</td>'; 
			echo '<td><input type="text" name="ed_izm" value="'.$item['ed_izm'].'"></td>'; 
			echo '</tr>';  
			echo '<tr>'; 
			echo '<td>Свободные специалисты</td>'; 
			echo '<td><input type="text" name="quantity" value="'.$item['quantity'].'"></td>'; 
			echo '</tr>';  
			echo '<tr>'; 
			echo '<td>Цена</td>'; 
			echo '<td><input type="text" name="price" value="'.$item['price'].'"></td>'; 
			echo '</tr>';  

			echo '<tr>'; 
			echo '<td>Комментарий</td>'; 
			echo '<td><input type="text" name="comments" value="'.$item['comments'].'"></td>'; 
			echo '</tr>'; 


			echo '<tr align="center">'; 
			echo '<td colspan=5><ul ><li><input type="submit" value="Save"></li></ul></td>'; 
			echo '</tr>'; 
			echo '</table>'; 
			echo '</form>'; 
			echo '</div>';
			echo '<br>';
		} else {
			echo '<meta http-equiv="refresh" content="0;URL=active.php">';
		}
	}

	function update_item(){
		global $link;
		$name_act = mysqli_escape_string($link, $_POST['name_act']);
		$id_cat = mysqli_escape_string($link, $_POST['id_cat']);
		$ed_izm = mysqli_escape_string($link, $_POST['ed_izm']);
		$quantity = mysqli_escape_string($link, $_POST['quantity']);
		$price = mysqli_escape_string($link, $_POST['price']);
		$comments = mysqli_escape_string($link, $_POST['comments']);
		$que = "UPDATE active SET name_act='$name_act', id_cat='$id_cat', ed_izm='$ed_izm', quantity='$quantity', price='$price', comments='$comments' WHERE id_act=".$_GET['id_act'];
		mysqli_query($link, $que) or die("Ошибка ".mysqli_error($link));
		echo '<meta http-equiv="refresh" content="0;URL=active.php">';
		die();
	}

	function delete_item(){
		if ($_SESSION['status']==1)
		{
			global $link;
			$que = "DELETE FROM active WHERE id_act=".$_GET['id_act'];
			mysqli_query($link, $que) or die("Ошибка ".mysqli_error($link));
			echo '<meta http-equiv="refresh" content="0;URL=active.php">';
			die();
		} else {
			echo '<meta http-equiv="refresh" content="0;URL=active.php">';
		}
	}
?>
</ul>

</body>
</html>