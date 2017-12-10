<?php
    $db = mysql_connect ("Practise","root","");
    mysql_select_db ("practice",$db);
    if (isset($_GET['login'])){	
        $query=mysql_query("SELECT activate FROM users WHERE login='".$_GET['login']."' AND password='".$_GET['password']."'");
        if (!$query){
            echo "ошибка";
        }
        else{
            $activate=mysql_result($query,0);
            if (!$activate)
            {
                echo "нет аккаунта";
            }
            else{
                echo "есть аккаунт";
            }
        }
    }
?>
<div class="modal">
    <a class="accordion-title">Авторизация</a>
    <form id="login" action="" method="GET" class="log-in-form">
        <input type="text" name="login" placeholder="Login">
        <input type="password" name="password" placeholder="Password">
      <p><input type="submit" class="button login" value="Вход"></input></p>
    </form>
    <div class="bottom">
    <label><center>У вас еще нет аккаунта?</center>
    </label>
    <a href="http://practise/reg.php" class="button login">Регистрация</a>
    </div>
</div>
<div class="bg_layer"></div>
<div class="grid-container"> 
    <?php include ("header.php");?>
    <div class="top-bar" id="responsive-menu">
        <ul class="menu">
          <li><a class="button">Гость</a></li>
          <?
                $path=parse_url($_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],PHP_URL_PATH);
                if ($path=="practise/"||$path=="practise/index.php"){
                    printf('</ul><ul class="menu align-center">');
                    echo '<li class="menu-text">Поиск</li>';
                    echo '<li class="menu-input"><input type="search" placeholder="Search"></li>';
                }
          ?>
        </ul>
        <ul class="menu align-right">
          <li><a id="openD" class="button ">Войти</a></li>
        </ul>
      </div>
<script>
        $('.modal, .bg_layer').hide();
        $('#openD').click(function(){
            $('.modal, .bg_layer').show();
            $(".modal").css({
                
            });          
            $('.grid-container').css({
                "filter": "blur(10px)"
            });
        });
        $('.bg_layer').click(function(){
            $('.modal, .bg_layer').hide();     
            $('.grid-container').css({
                "filter": "none"
            });
        });
</script>