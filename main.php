<?php
   session_start();
   ?>
<!DOCTYPE html>
<html>
   <audio autoplay loop preload="auto">
      <source src="css/musicMain.mp3" type="audio/mpeg">
   </audio>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/styles.css">
      <title>P1skanor</title>
         <link href="/rainbow.css" rel="stylesheet" type="text/css" media="all">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   </head>
   <body>
    
<div class="piska"></div>
      <div id="header">

         <h1>P1skanor</h1>
         <ul class="nav">
                
 
       <li> <a href="main.php">Home</a></li>
            <li><a href="active.php">Service</a></li>
          
    
            <?php

               //$_SESSION['buy'] = array();
               if (empty($_SESSION['buy'])){
                 $_SESSION['buy'] = array();
               }
              
               if (empty($_SESSION['login']) or empty($_SESSION['id'])){
               
               echo ' <li><a href="auth_form.php">LogIn</a></li>';
                 echo '';
               echo '<li><a href="reg_form.php">SignUp</a></li>';

                
                } else {
                echo '<li><a href="?exit">LogOut</a></li><br>';
                 echo ' '.$_SESSION['login'];

               }  echo '<li><a href="department.php">Orders('.count($_SESSION['buy']).')</a></li><br>';
               
           
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
                 echo '<br><li><a href="category.php">Editor</a></li>';
                 echo '<br><li><a href="history.php">History</a></li>';
               }
              ?>
         </ul>

      </div>
  
     



      <div id="container">


         <span class="tl"></span><span class="tr"></span>
         <div class="post">
         </div>
         <div class="flair1" role="presentation"></div>
         <div class="flair2" role="presentation"></div>
         <div class="flair3" role="presentation"></div>
         <div class="flair4" role="presentation"></div>
         <div class="flair5" role="presentation"></div>
         <div class="extra6" role="presentation"></div>
         <span class="bl"></span><span class="br"></span>
      </div>

    

      <script>// Hide the current .post div
         let oldPost = document.querySelector(".post");
         oldPost.style.display = "none";
         
         // Add a banner under the header and...
         let header = document.getElementById("header");
         let banner = document.createElement("div");
         banner.setAttribute("class", "banner");
         header.after(banner);
         
         // create a list of topics for the blog
         const topicsArray = [
         
       
         ];
         let topicTitle = document.createElement("h4");
         topicTitle.innerText = "topics";
         let topics = document.createElement("ul");
         
         topicsArray.forEach((topic) => {
           let topicItem = document.createElement("li");
           topicItem.innerText = topic;
           topics.appendChild(topicItem);
         });
         // Update CSS property that determines number of columns in grid
         let r = document.querySelector(":root");
         r.style.setProperty("--num-of-topics", topicsArray.length);
         
         
         
         // Create a new .post div and populate with cards
         let container = document.getElementById("container");
         let post = document.createElement("div");
         post.setAttribute("class", "post");
         document.body.append(post);
         
         // Data for the cards
         const cardsData = [
           {
             cardNum: 1,
             title: 'Support and maintenance',
             body: [
               "Установка и настройка любых популярных операционных систем и программного обеспечения, модернизация и замена компьютеров, техническое обслуживание любой оргтехники."
             ]
           },
           {
             cardNum: 2,
             title: "IT security audit",
             list: [
               
               
               {
                 text: "WE COOPERATE WITH THEM",
                 link: "https://www.company.rt.ru"
               }
             ],
             body: [
               " Проведение аудита ИТ-инфраструктуры позволяет получить представление о текущем состоянии дел. Основываясь на этой информации, в дальнейшем можно будет определить пути устранения выявленных недостатков и направления модернизации. ИТ-аудит необходим в следующих случаях: заказчик тщательно планирует стратегическое развитие компании и понимает роль ИТ в этом процессе; в компании произошел критический для бизнеса сбой, и эта компания хотела бы исключить такую возможность в будущем; компания столкнулась с тем, что существующие серверные мощности больше не справляются с возросшей нагрузкой, и хотела бы понять, как повысить производительность на основе текущих и будущих запросов; руководство компании хочет знать, как их данные защищены от вторжения извне. Мы проводим ИТ-аудит компаний в Москве и по всей России.",
               "Деятельность практически любой компании в наши дни тесно связана с Интернетом, коммуникациями, мгновенными платежами. В то же время ни один из клиентов не готов платить за удобство ведения бизнеса с риском хакерского вторжения и кражи данных или денег. ИТ-аудит позволяет понять, насколько сеть компании защищена от внешних угроз. Если аудит ИТ-систем выявил наличие проблем с безопасностью, мы совместно с клиентом разрабатываем план, который позволит нам закрыть все уязвимости, сохранив при этом наиболее удобный способ входа пользователей в систему и работы."
             ]
           },

           
           
         ];
         
         // Creates the cards and populates them with the cardData array
         const createCards = () => {
           cardsData.forEach((item) => {
             let card = document.createElement("div");
             card.setAttribute("class", `card card-${item.cardNum}`);
             let h2 = document.createElement("h2");
             h2.innerText = item.title;
             card.appendChild(h2);
             if (item.list) {
               let ul = document.createElement("ul");
               for (let j = 0; j < item.list.length; j++) {
                 let li = document.createElement("li");
                 let a = document.createElement("a");
                 a.setAttribute("href", item.list[j].link);
                 a.setAttribute("target", "blank");
                 a.innerText = item.list[j].text;
                 li.appendChild(a);
                 ul.appendChild(li);
               }
         
               card.appendChild(ul);
             }
             for (let i = 0; i < item.body.length; i++) {
               let p = document.createElement("p");
               p.innerText = item.body[i];
               card.appendChild(p);
             }
             post.appendChild(card);
           });
         };
         
         createCards();
         
         // Add the new .post div to the container
         container.appendChild(post);
      </script>
     
   </body>
</html>