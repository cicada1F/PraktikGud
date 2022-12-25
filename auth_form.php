<?php
   session_start();
   ?>
<!DOCTYPE html>
<html>
<audio autoplay loop preload="auto">
         <source src="css/musicAuth.mp3" type="audio/mpeg">
</audio>
   <head>
      <title>Авторизация</title>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="css/styles.css">
   </head>
   <body>
      <div class="piska"></div>
      <div id="header">
         <?php
            if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
            ?>
         <form action="auth.php" method="post">
            <h1>Login</h1>
            <!--button type="button" onclick="history.back();">Отменить</button-->
            <p>
               <label>Email:<br></label>
               <input name="login" type="text" size="15" maxlength="15">
            </p>
            <p>
               <br>
               <label>Password:<br></label>
               <input name="password" type="password" size="15" maxlength="15">
            </p>
            <div>
           <ul class="nav"><li><button><a>Login</a></button></li>

         </form>
         <?php
            } else {
            	echo '<h2>Underdog! you have already logged in as<h2> <h1>'.$_SESSION['login'].'</h1>. <a href="?exit"><h2>LogOut</h2></a>';
            }
            ?>
           <ul class="nav"><li><button><a href="main.php">Back</a></li></ul>
      </div>
      
</div>
 </ul>



<script>
	


</script>
     
   </body>
</html>