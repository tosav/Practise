<?php 
$db = mysql_connect ("Practise","root","");
mysql_select_db ("practice",$db);
 
/** 
 * Класс для авторизации
 * @author дизайн студия ox2.ru 
 */ 
class AuthClass {
    private $_login = 'ничеготакого'; //Устанавливаем логин
    private $_password = 'ээ'; //Устанавливаем пароль
 
    /**
     * Проверяет, авторизован пользователь или нет
     * Возвращает true если авторизован, иначе false
     * @return boolean 
     */
    public function isAuth() {
        if (isset($_SESSION["is_auth"])) { //Если сессия существует
            return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        }
        else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }
     
    /**
     * Авторизация пользователя
     * @param string $login
     * @param string $passwors 
     */
    public function auth($login, $passwors) {
        $login=trim($login);
        $password=md5(trim($passwors));
        $query=mysql_query("SELECT activate FROM users WHERE login='".$login."' AND password='".$password."'");
        if (!$query){
            $_SESSION["is_auth"] = false;
            return false; 
        }
        else {
            print_r( $query);
            $activate=mysql_result($query,0);
            if (!$activate)
            {   //Логин и пароль не подошел
                $_SESSION["is_auth"] = false;
                return false; 
            }
            else { 
                $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
                $_SESSION["login"] = $login; //Записываем в сессию логин пользователя
                
                $query=mysql_query("SELECT role, id FROM users WHERE login='".$_login."' AND password='".$_password."'");        
                if (!$query)
                    echo "<script>alert('Ошибка')</script>";
                else{
                    $role=mysql_result($query,0);
                    if (!$role)
                        echo "<script>alert('Ошибка')</script>";
                    else 
                        $_SESSION["role"] = $role;
                    $id=mysql_result($query,1);
                    if (!$id)
                        echo "<script>alert('Ошибка')</script>";
                    else 
                        $_SESSION["id"] = $id;
                }
                return true;
            }
        }
    }
     
    /**
     * Метод возвращает логин авторизованного пользователя 
     */
    public function getLogin() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
        }
    }    
    public function getRole() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["role"]; //Возвращаем логин, который записан в сессию
        }
    }
     
     
    public function out() {
        $_SESSION = array(); //Очищаем сессию
        session_destroy(); //Уничтожаем
    }
}

$auth = new AuthClass();
 
if (isset($_POST["login"]) && isset($_POST["password"])) { //Если логин и пароль были отправлены
    if (!$auth->auth($_POST["login"], $_POST["password"])) { //Если логин и пароль введен не правильно
        echo "<script>alert(Логин или пароль введен не правильно!);</script>";
    }
}
 
if (isset($_GET["is_exit"])) { //Если нажата кнопка выхода
    if ($_GET["is_exit"] == 1) {
        $auth->out(); //Выходим
        header("Location: ?is_exit=0"); //Редирект после выхода
    }
}
?>
<div class="modal">
    <a class="accordion-title shade">Авторизация</a>
    <form id="login" action="" method="POST" class="log-in-form shade">
        <input class="reg" type="text" name="login" placeholder="Login">
        <input class="reg" type="password" name="password" placeholder="Password">
      <p><input type="submit" style="padding: 0;" class="button login" value="Вход"></input></p>
    </form>
    <div class="shade-in bottom">
    <label style="color: #949494; padding: 5px 0;"><center>У вас еще нет аккаунта?</center>
    </label>
    <a href="http://practise/reg.php" style="padding: 9px;" class="button login">Регистрация</a>
    </div>
</div>
<div class="bg_layer"></div>
<div class="grid-container"> 
    <?php include ("header.php");?>
    <div class="top-bar shade" id="responsive-menu">
        <ul class="menu">
          <li><a class="button top">Гость</a></li>
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
          <li><a id="openD" class="button top">Войти</a></li>
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