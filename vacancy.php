<?
session_start();

    $dsn = 'mysql:dbname=practice;host=127.0.0.1;port=3306;charset=utf8';
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
     
    $pdo = new PDO($dsn, 'root', '', $opt);
    $_GET['id']=trim($_GET['id']);
    $sql="SELECT v.*, c.name as com_name, c.description as descr, u.email, u.phone 
    FROM vacancies v 
    LEFT OUTER JOIN company c ON v.company=c.id
    LEFT OUTER JOIN users u ON u.id=v.company
    WHERE v.id = ?
    GROUP BY v.id";
    $stm = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stm->execute([$_GET['id']]);
    $string='';
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
        <?  
        while ($row = $stm->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {          
            if ($auth->isAuth()){
                if ($_SESSION['role']==2 OR $_SESSION['role']==3){
                    $show=true;
                    if ($_SESSION['role']==2){
                        $string='<a href="'.$_SERVER['REQUEST_URI'].'&stid='.$_SESSION.'" style="padding: 9px;" class="button main top float-right shade">Записаться</a>';
                    }
                    else{                    
                        if ($_SESSION['id']==$row['company']){
                            $string='<a href="vac.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Изменить</a>';
                        }
                    }
                }
            }  
          $contr='Нет';
          if ($row['contract']==1){
                $contr='Есть';
          }
          print_r('          
            <a class="accordion-title shade main">'.$row['name'].'</a>
            <!--<a class="float-right text">Даты которых нигде нет</a>-->
            <div class="inf">
              <p><b>Условие приема: </b>'.$row['conditions'].'</br>
              <b>Договор с ДВФУ: </b>'.$contr.'</br>
              <b>Описание деятельности студента: </b>'.$row['description'].'</br>
              <b>Описание деятельности предприятия: </b>'.$row['descr'].'</br>
              <b>Номер телефона: </b>'.$row['phone'].'</br>
              <b>Почта: </b>'.$row['email'].'</br>
              </br>
              </br>
              </br>
              </p>
              '.$string.'
            </div>
            
         ');
        }
        ?> 
    </div>
    </div>
    <?php include ("footer.php");?>
  </body>
</html>
