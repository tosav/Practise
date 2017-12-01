<script>
    $(function(){
        $("#dialog").dialog({autoOpen: false});
        $("#openD").click(function(){
        $("#dialog").dialog("open");
        });
    });
</script>
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
<div id="dialog" title="Авторизация">
<form id="login" class="log-in-form">
    <input type="email" placeholder="login">
    <input type="password" placeholder="password">
  <p><input type="submit" class="button expanded" value="Вход"></input></p>
</form>
<label><center>У вас еще нет аккаунта?</center>
</label>
    <a href="http://practise/reg.php" class="button expanded">Регистрация</a>
</div>