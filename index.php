<?
session_start();
 /* if    (isset($_POST['login'])) 
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
                        return false;
                    }
                    else
                    {
                        //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
                        $_SESSION['login']=$res['login']; 
                        $_SESSION['password']=$res['password']; 
                        $_SESSION['id']=$res['id'];
                        $_SESSION['role']=$res['role'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
                        $_SESSION['activate']=$res['activate'];
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
                        return false;
                }
            }
        }   */
?>
<!doctype html>
<html class="no-js" lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практики</title>
    <?php include ("head.php");?>
  </head>
  <body>  
      <?php include ("menu.php");?>
        <a class="accordion-title">Узнай основную информацию о практике</a>
        <a id="0b" onclick="is_clicked('0')" style="padding: 9px;" class="button login">Регистрация</a>
        <div id="0">
          <p>Panel 1. Lorem ipsum dolor</p>
        </div>
        <a class="accordion-title">Название компании</a>
        <div>
          <p>Panel 1. Lorem ipsum dolor</p>
          <a href="#" class="button float-right">Learn More</a>
        </div>
    </div>
    <?php include ("footer.php");?>
    <script>
            function is_clicked(id){
            document.getElementById(id).style.display='block'; 
            document.getElementById(id+'b').style['background-color']='#d8d8d8'; 
         }
    </script>
  </body>
</html>
