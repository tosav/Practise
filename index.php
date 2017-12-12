<?
session_start();

            $dsn = 'mysql:dbname=practice;host=127.0.0.1;port=3306;charset=utf8';
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
             
            $pdo = new PDO($dsn, 'root', '', $opt);
            $_GET['search']=trim($_GET['search']);
            if ($_GET['search']){
                $sql="SELECT v.*, c.name as com_name, c.description as descr 
                FROM vacancies v 
                LEFT OUTER JOIN company c ON v.company=c.id
                WHERE v.name LIKE ?
                GROUP BY v.id";
                $stm = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stm->execute(['%'.$_GET['search'].'%']);
            }
            else{
                $sql="SELECT v.*, c.name as com_name, c.description as descr 
                FROM vacancies v 
                LEFT OUTER JOIN company c ON v.company=c.id
                GROUP BY v.id";
                $stm = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
                $stm->execute();
            }
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
        <a class="accordion-title shade main">Узнай основную информацию о практике</a>
        <a id="0b" onclick="is_clicked('0')" style="padding: 9px;" class="button main top float-right shade">Подробнее</a>
        <div id="0" style="display:none;" class="inf">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        </div>
        <?        
        while ($row = $stm->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
          $contr='Нет';
          if ($row['contract']==1){
                $contr='Есть';
          }
          print_r('          
            <a class="accordion-title shade main">'.$row['name'].'</a>
            <a class="float-right text">Даты которых нигде нет</a>
            <div class="inf">
              <p><b>Условие приема: </b>'.$row['conditions'].'</br>
              <b>Договор с ДВФУ: </b>'.$contr.'</br>
              <b>Описание деятельности студента: </b>'.$row['description'].'</br>
              </br>
              </p>
            </div>
            <a href="vacancy.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Подробнее</a>
         ');
        }
        ?> 
    </div>
    <?php include ("footer.php");?>
    <script>
         function is_clicked(id){
            if (document.getElementById(id).style.display=='none'){ 
            document.getElementById(id).style.display='block'; 
            document.getElementById(id+'b').style['background-color']='#d8d8d8'; 
            document.getElementById(id+'b').style['color']='#000'; 
            document.getElementById(id+'b').style['box-shadow']='inset 0px 2px 3px rgba(0,0,0,0.3)'; 
            }
            else{ 
            document.getElementById(id).style.display='none'; 
            document.getElementById(id+'b').style['background-color']='#269489'; 
            document.getElementById(id+'b').style['color']='#fff'; 
            document.getElementById(id+'b').style['box-shadow']='0px 2px 2px rgba(0,0,0,0.3)'; 
            }
         }
    </script>
  </body>
</html>
