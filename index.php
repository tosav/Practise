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
	   <?
	  if($_SESSION['is_auth'])
	  {
		if($_SESSION['role'] == 2)
		{
		$log = $_SESSION['login'];	
		$prof1 = mysql_query("SELECT * FROM users INNER JOIN student ON (users.id = student.id)
		where users.login = '$log'");
		$prof = mysql_fetch_assoc($prof1);
		$group = $prof['group'];
		$res = mysql_query("SELECT number FROM `group` WHERE id = $group");
		$group = mysql_result($res, 0);	  
		$leader = $prof['leader'];
		$res = mysql_query("SELECT fio FROM `leader` WHERE id = $leader");
		$leader = mysql_result($res, 0);
		print_r('
			  <a class="accordion-title shade main">Профиль</a>
			  <div class="inf">
              <p><b>Логин: </b>'.$prof['login'].'</br>
              <b>ФИО: </b>'.$prof['fio'].'</br>
			  <b>Номер телефона: </b>'.$prof['phone'].'</br>
			  <b>Почта: </b>'.$prof['email'].'</br>
			  <b>Номер группы: </b>'.$group.'</br>
			  <b>Номер зачетной книжки: </b>'.$prof['num'].'</br>
			  <b>Статус занятости: </b>Ищет вакансии</br>
              <b>Руководитель практики: </b>'.$leader.'</br>
              </br>
              </p>
              </div>
              <a href="Change_student.php" style="padding: 9px;" class="button main top float-right shade">Изменить</a>
		');
	    }
	  elseif($_SESSION['role'] == 1)
	  {
	  $log = $_SESSION['login'];	
	  $prof1 = mysql_query("SELECT * FROM users INNER JOIN leader ON (users.id = leader.id)
	  where users.login = '$log'");
	  $prof = mysql_fetch_assoc($prof1);
	  print_r('
	   <a class="accordion-title shade main">Профиль</a>
            <div class="inf">
              <p><b>Логин: </b>'.$prof['login'].'</br>
              <b>ФИО: </b>'.$prof['fio'].'</br>
			  <b>Номер телефона: </b>'.$prof['phone'].'</br>
			  <b>Почта: </b>'.$prof['email'].'</br>
			  <b>Номера групп: </b>'.$prof['gropus'].'</br>
              </br>
              </p>
            </div>
            <a href="Change_leader.php" style="padding: 9px;" class="button main top float-right shade">Изменить</a>
		');
	  }
	  }
		?>
        <a class="accordion-title shade main">Узнай основную информацию о практике</a>
        <a id="0b" onclick="is_clicked('0', this)" style="padding: 9px;" class="button main top float-right shade">Подробнее</a>
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
         function is_clicked(id, p){
            if (document.getElementById(id).style.display=='none'){ 
            document.getElementById(id).style.display='block'; 
            document.getElementById(id+'b').style['background-color']='#d8d8d8'; 
            document.getElementById(id+'b').style['color']='#000'; 
            document.getElementById(id+'b').style['box-shadow']='inset 0px 2px 3px rgba(0,0,0,0.3)'; 
            p.innerHTML = 'Свернуть';
            }
            else{ 
            document.getElementById(id).style.display='none'; 
            document.getElementById(id+'b').style['background-color']='#269489'; 
            document.getElementById(id+'b').style['color']='#fff'; 
            document.getElementById(id+'b').style['box-shadow']='0px 2px 2px rgba(0,0,0,0.3)'; 
            p.innerHTML = 'Подробнее';
            }
         }
    </script>
  </body>
</html>
