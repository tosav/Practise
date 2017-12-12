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
    public function auth($login, $passwors) {
        if    (isset($_POST['login'])) 
        { 
            $login = str_replace(" ","",$_POST['login']); 
            if ($login == '') 
            { 
                unset($login);
            }    
        } 
        //заносим введенный пользователем e-mail, если он    пустой, то уничтожаем переменную
        if    (isset($_POST['password'])) 
        { 
            $password = str_replace(" ","",$_POST['password']);
            if ($password == '') 
            { 
                unset($password);
            } 
        } 
        //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
        if (empty($login) or empty($password)) 
        { //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
            ?>
            <script>
                alert("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
            </script>
            <?
            $_SESSION["is_auth"]=false;
            return false;
        }
        else
        {
            $dsn = 'mysql:dbname=practice;host=127.0.0.1;port=3306;charset=utf8';
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
             
            $pdo = new PDO($dsn, 'root', '', $opt);
            $sql="SELECT * FROM users WHERE login=?";
            
            $stm = $pdo->prepare($sql);
            $stm->execute([$login]);
            $res = $stm->fetch();
            if (!$res)
            {
                ?>
                <script>
                    alert("Извините, введённый вами логин неверный.");
                </script>
                <?
                        $_SESSION["is_auth"]=false;
                        return false;
            } 
            else
            { //если существует, то сверяем пароли
                $password=md5($password);
                if ($res['password']==$password) 
                {
                    if($res['activate']==0)
                    {
                        ?>
                        <script>
                            alert("Извините, ваша учётная запись ещё не подтверждена администратором сайта, попробуйте позже!");
                        </script>
                        <?
                        $_SESSION["is_auth"]=false;
                        return false;
                    }
                    else
                    {
                        $_SESSION["is_auth"]=true;
                        //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
                        $_SESSION['login']=$res['login']; 
                        $_SESSION['password']=$res['password']; 
                        $_SESSION['id']=$res['id'];
                        $_SESSION['role']=$res['role'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
                        $_SESSION['activate']=$res['activate'];
                        switch($_SESSION['role']){
                              case 0:
                                    $_SESSION['name']='Админ';
                              break;
                              case 1:
                                $sql="SELECT fio FROM leader WHERE id=?";
                                $stm = $pdo->prepare($sql);
                                $stm->execute([$_SESSION['id']]);
                                $res = $stm->fetch();
                                $_SESSION['name']=$res['fio'];
                                echo $_SESSION['name'];
                              break;
                              case 2:
                                $sql="SELECT fio FROM student WHERE id=?";
                                $stm = $pdo->prepare($sql);
                                $stm->execute([$_SESSION['id']]);
                                $res = $stm->fetch();
                                $_SESSION['name']=$res['fio'];
                                echo $_SESSION['name'];
                              break;
                              case 3:
                                $_SESSION['name']='Предприятие';
                              break;
                        }
                        return true;
                    }
                }
                else 
                {
                    ?>
                    <script>
                        alert("Извините, введённый пароль неверный.");
                    </script>
                    <?
                        $_SESSION["is_auth"]=false;
                        return false;
                }
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
		exit("<html><head><meta http-equiv='Refresh' content='0; URL=..".$_SERVER['PHP_SELF']."'></head></html>");
    }
}

$auth = new AuthClass();
if ($_POST["login"] && $_POST["password"]) { //Если логин и пароль были отправлены
    if (!$auth->auth($_POST["login"], $_POST["password"])) { //Если логин и пароль введен не правильно
		exit("<html><head><meta http-equiv='Refresh' content='0; URL=..".$_SERVER['PHP_SELF']."'></head></html>");
    }
    else{
        echo "<script>alert('Вы авторизованы');</script>";
		echo "<script>window.location.href='".$_SERVER['PHP_SELF']."'</script>";//ну тип
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
          <li><a class="button top"><? if($_SESSION['is_auth']){
                                            switch ($_SESSION['role']){
                                              case 0:
                                                echo 'Администратор';
                                              break;
                                              case 1:
                                                echo 'Руководитель';
                                              break;
                                              case 2:
                                                echo 'Студент';
                                              break;
                                              case 3:
                                                echo 'Предприятие';
                                              break;
                                            }         
                                        }
                                        else
                                            echo 'Гость';
                                      ?></a></li>
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
          <li><a id="openD" class="button top"><?
          if ($_GET['name'])
            echo $_GET['name'];
          else if($_SESSION['is_auth'])
            echo $_SESSION['name'];
          else 
            echo 'Войти'; 
          ?></a></li>
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
        
    window.onload = function(){
        
    }
</script>