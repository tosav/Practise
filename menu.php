<script>
    $(function(){
        $("#dialog").dialog({autoOpen: false});
        $("#openD").click(function(){
        $("#dialog").dialog("open");
        });
    });
</script>
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
<div class="top-bar" id="responsive-menu">
  <div class="top-bar-left">
    <ul class="menu">
      <li><a class="button large">Гость</a></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <?
            $path=parse_url($_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],PHP_URL_PATH);
            if ($path=="practise/"||$path=="practise/index.php"){
                echo '<li class="menu-text">Поиск</li>';
                echo '<li><input type="search" placeholder="Search"></li>';
            }
      ?>
      <li><a id="openD" class="button large">Войти</a></li>
    </ul>
  </div>
</div>
<div class="dark-side" id="dialog">
    <div title="Авторизация">
        <form id="login" action="" method="GET" class="log-in-form">
            <input type="text" name="login" placeholder="Login">
            <input type="password" name="password" placeholder="Password">
          <p><input type="submit" class="button login" value="Вход"></input></p>
        </form>
        <label><center>У вас еще нет аккаунта?</center>
        </label>
        <a href="http://practise/reg.php" class="button expanded">Регистрация</a>
    </div>
</div>
<div id="overlay"></div>