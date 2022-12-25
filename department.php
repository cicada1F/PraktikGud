<?php
   session_start();
   ?>
<!DOCTYPE html>
<html>
 <audio autoplay loop preload="auto">
         <source src="css/musicDepart.mp3" type="audio/mpeg">
      </audio>
   <head>
      <title>Заказы</title>
      <link rel="stylesheet" href="css/styles.css">
      
      <meta charset="UTF-8">
   </head>
   <body>
       <div class="piska"></div>  




<div id="header">

   <img src="img/123.gif">

	<ul class="nav">

    



      <?php

         error_reporting(0);
         
         	
         	require_once 'login.php';
         
         	if (!isset($_GET["action"])) $_GET["action"] = "showlist";
         
         	switch ($_GET["action"]) {
         		case 'okBUY':
         			okBUY($link);
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
         	
         
         
         	function show_list($link){
         		global $link;
         		$que = 'SELECT * FROM buy';
         		$res = mysqli_query($link, $que);
         		echo '
         		<h2>Your Order</h2><br>
         		<ul><li onclick="history.back();"><a>Back</a></li></ul><br>
         		<br><table border="1" class="data_tbl"><br>
         		<tr align="center"><th><h2>Name</h2></th><th colspan="2"></th></tr>
         		';
         		//if (empty($_SESSION['id'])){
         			foreach ($_SESSION['buy'] as $key => $value) {
         				$que1 = 'SELECT * FROM active WHERE id_act = '.$value;
         				$res1 = mysqli_fetch_array(mysqli_query($link, $que1));
         				$vll = $res1['name_act'];
         				echo '<tr align="center" class="tbl">
         				<td>'.$vll.'</td>
         				<td colspan="2"><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id_dep='.$key.'"><img src="img/drop.png" title="Remove" onClick="return confirmDelete();"></a></td>';
         			}
         		//}
         			echo '</table>';
         			if (count($_SESSION['buy'])>0){
         				echo '<a href="'.$_SERVER['PHP_SELF'].'?action=okBUY">
                     <ul><li><button type="button">Order</a></button></ul>';


         			}else{
         				echo '<h2>There is no order, go back to the section</h2>
                     <ul><li><a href="active.php">Services provided</a></li></ul>';
         			}

         		
         	}
         
         	function okBUY($link) 
         
         
         	{
         		if (!empty($_SESSION['id']))


                {  echo '    <ul><li><a href="main.php">Home</a></li></ul><ul><li><a href="department.php">Back</a></li></ul>';
         			foreach ($_SESSION['buy'] as $key => $value) {
         				$que = 'SELECT * FROM active WHERE id_act = '.$value;
         				$res = mysqli_fetch_array(mysqli_query($link, $que));
         				$vll = $res['quantity']-1;
         
         				$que = "UPDATE active SET quantity='$vll' WHERE id_act=".$value;
         				mysqli_query($link, $que) or die("<ul><li><h2>at the moment there is no available specialist</h2>"
                      .mysqli_error(print"<h1>Excuse me</h1></li></ul>  ")) ;
   
         				
         
         				$today = date("F j, Y, g:i a"); 
         				$id = $_SESSION['id'];
         				$id_s = $value;
         				$query = "INSERT INTO history (id, id_user, id_sub, dates) VALUES ('0','$id', '$id_s', '$today');";
         				mysqli_query($link, $query) or die("<h2>Error</h2> ".mysqli_error($link));
         
         
         				unset($_SESSION['buy'][$key]);
         			} 
         			//echo '<meta http-equiv="refresh" content="0;URL=active.php">';
         			//die();
         			
         			
         			echo '<h2>The order has been successfully formed, expect a call from a specialist!</h2>' ;
         
         		}else
         		{
         			echo '<h2>Authorization is required to place an order!<br> <button onclick="history.back();"><h2>↪</h2></button></h2>';
         		}
         
         	}
         
         	function get_edit_item_form(){
         		if ($_SESSION['status'] == 1)
         		{
         			global $link;
         			echo '<div id="header">
         			<h2>Редактировать</h2>';
         			$que = 'SELECT * FROM department WHERE id_dep='.$_GET['id_dep'];
         			$res = mysqli_query($link, $que) or die("Ошибка ".mysqli_error($link));
         			$item = mysqli_fetch_array($res);
         			echo '<form name="editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id_dep='.$_GET['id_dep'].'" method="POST">
         			<button type="button" onClick="history.back();">Cancel</button><br />
         			<br><table border="1" class="data_tbl">
         			<tr>
         			<td>Отдел</td>
         			<td><input type="text" name="name_dep" value="'.$item['name_dep'].'"></td>
         			</tr>
         			<tr align="center">
         			<td colspan=5><input type="submit" value="Save"></td>
         			</tr>
         			</table>
         			</form>
         			</div>
         			';
         		} else {
         			echo '<meta http-equiv="refresh" content="0;URL=department.php">';
         		}
         	}
         
         	function update_item(){
         		global $link;
         		$name_dep = mysqli_escape_string($link, $_POST['name_dep']);
         		$que = "UPDATE department SET name_dep='".$name_dep."' WHERE id_dep=".$_GET['id_dep'];
         		mysqli_query($link, $que) or die("Ошибка ".mysqli_error($link));
         		echo '<meta http-equiv="refresh" content="0;URL=department.php">';
         		die();
         	}
         
         	function delete_item(){
         		/*if ($_SESSION['status'] == 1)
         		{
         			global $link;
         			$que = "DELETE FROM department WHERE id_dep=".$_GET['id_dep'];
         			mysqli_query($link, $que) or die("Ошибка ".mysqli_error($link));
         			echo '<meta http-equiv="refresh" content="0;URL=department.php">';
         			die();
         		} else {
         			echo '<meta http-equiv="refresh" content="0;URL=department.php">';
         		}*/
         		unset($_SESSION['buy'][$_GET['id_dep']]);
         		echo '<meta http-equiv="refresh" content="0;URL=department.php">';
         	}
         ?>
     </ul>
   
 </div>
     
   </body>
</html>
