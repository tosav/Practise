<?
session_start();
$dsn = 'mysql:dbname=practice;host=127.0.0.1;port=3306;charset=utf8';
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, 'root', '', $opt);
$id=$_SESSION["is_auth"]?$_SESSION['id']:-1;
if ($_GET['id'])
    $id=$_GET['id'];
$role=$_SESSION["is_auth"]?$_SESSION['role']:-1;
//добавить студента
if ($id&&$_GET['addst']&&$_GET['vac']){
    //еще студенты
    $sql="SELECT *
    FROM vacancies
    WHERE company=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $vac = $stm->fetchAll();
    //удалить из списка желающих
    foreach ($vac as $rw => $link) {
        if ($link['id']==$_GET['vac']){
            $stds=explode(";",$link['students']);
            $key=array_search($_GET['addst'],$stds);
            unset($stds[$key]);
            $str=implode(";",$stds);
            $sql = "UPDATE vacancies SET students = :students
            WHERE id = :id";
            $stmt = $pdo->prepare($sql);                                  
            $stmt->bindParam(':students', $str, PDO::PARAM_STR);   
            $stmt->bindParam(':id', $_GET['vac'], PDO::PARAM_INT);   
            $stmt->execute(); 
        }
    }
    //добавить вакансию
    $sql = "UPDATE student SET vacancy = :vacancy
    WHERE id = :id";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':vacancy', $_GET['vac'], PDO::PARAM_INT);   
    $stmt->bindParam(':id', $_GET['addst'], PDO::PARAM_INT);   
    $stmt->execute(); 
}
//удалить студента
if ($id&&$_GET['deletest']&&$_GET['vac']){
    //еще студенты
    $sql="SELECT *
    FROM vacancies
    WHERE id=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$_GET['vac']]);
    $vac = $stm->fetch();
    //удалить из списка желающих
    $stds=explode(";",$vac['students']);
    $key=array_search($_GET['deletest'],$stds);
    unset($stds[$key]);
    $str=implode(";",$stds);
    $sql = "UPDATE vacancies SET students = :students
    WHERE id = :id";
    $stmt = $pdo->prepare($sql);                                  
    $stmt->bindParam(':students', $str, PDO::PARAM_STR);   
    $stmt->bindParam(':id', $_GET['vac'], PDO::PARAM_INT);   
    $stmt->execute(); 
}
//исключить студента
if ($id&&$_GET['delst']){
    //еще студенты
    $sql = "UPDATE student SET vacancy = NULL
    WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['delst'], PDO::PARAM_INT);   
    $stmt->execute();
}
//активировать пользователя
if ($_GET['actid']){
    //еще студенты
    $sql = "UPDATE users SET activate = '1'
    WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['actid'], PDO::PARAM_INT);   
    $stmt->execute();
}
//блокировать пользователя
if ($_GET['disid']){
    //еще студенты
    $sql = "UPDATE users SET activate = '0'
    WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['disid'], PDO::PARAM_INT);   
    $stmt->execute();
}
//дизактивировать пользователя
if ($_GET['disactid']){
    //еще студенты
    $sql = "SELECT role FROM users WHERE id = ?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$_GET['disactid']]);
    $roleq = $stm->fetch();
    $sql = "DELETE FROM leader WHERE id = :id";
    switch($roleq['role']){
        case '2':
            $sql = "DELETE FROM student WHERE id = :id";
        break;
        case '3':
            $sql = "DELETE FROM company WHERE id = :id";
        break;
    }
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['disactid'], PDO::PARAM_INT);   
    $stmt->execute();
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['disactid'], PDO::PARAM_INT);   
    $stmt->execute();
}
//удалить вакансию
if ($id&&$_GET['delvac']){
    $sql = "DELETE FROM vacancies WHERE id =:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['delvac'], PDO::PARAM_INT);   
    $stmt->execute();
//добавить вакансию
    $sql="SELECT * FROM student";
    $stm = $pdo->prepare($sql);
    $stm->execute([]);
    $std = $stm->fetchAll();
    foreach($std as $rw => $st){
        if ($st['vacancy']==$_GET['delvac']){
            $sql = "UPDATE student SET vacancy = NULL
            WHERE id = :id";
            $stmt = $pdo->prepare($sql);                                 
            $stmt->bindParam(':id', $st['id'], PDO::PARAM_INT);   
            $stmt->execute(); 
        }
    }
}
if ($id>0){
    $sql="SELECT * FROM users WHERE id=?";
    
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $res = $stm->fetch();
    $role=$res['role'];
    switch($res['role']){
          case 0:
            $sql="SELECT * FROM users WHERE activate='0' AND role='1'";
            $stm = $pdo->prepare($sql);
            $stm->execute([]);
            $leader = $stm->fetchAll();
            $sql="SELECT * FROM users WHERE activate='1' AND role='1'";
            $stm = $pdo->prepare($sql);
            $stm->execute([]);
            $unleader = $stm->fetchAll();
            $sql="SELECT * FROM users WHERE activate = '0' AND role = '2'";
            $stm = $pdo->prepare($sql);
            $stm->execute([]);
            $st = $stm->fetchAll();
            $sql="SELECT * FROM users WHERE activate = '1' AND role = '2'";
            $stm = $pdo->prepare($sql);
            $stm->execute([]);
            $unst = $stm->fetchAll();
            $sql="SELECT * FROM users WHERE activate='0' AND role='3'";
            $stm = $pdo->prepare($sql);
            $stm->execute([]);
            $cmp = $stm->fetchAll();
            $sql="SELECT * FROM users WHERE activate='1' AND role='3'";
            $stm = $pdo->prepare($sql);
            $stm->execute([]);
            $uncmp = $stm->fetchAll();
          break;
          case 1://complete
            $sql="SELECT * FROM leader WHERE id=?";
            $stm = $pdo->prepare($sql);
            $stm->execute([$id]);
            $row = $stm->fetch();
          break;
          case 2://complete
            $sql="SELECT s.*,g.number, g.name, l.id AS l_id, l.fio AS l_fio , v.name as v_name
            FROM student s 
            LEFT OUTER JOIN `group` g 
            ON s.group = g.id
            LEFT OUTER JOIN leader l 
            ON s.leader = l.id             
            LEFT OUTER JOIN vacancies v 
            ON s.vacancy = v.id 
            WHERE s.id=?";
            $stm = $pdo->prepare($sql);
            $stm->execute([$id]);
            $row = $stm->fetch();
            $vacancy=$row['vacancy']?$row['v_name']:'Нет';
          break;
          case 3://complete
            $sql="SELECT c.*
            FROM company c
            WHERE c.id=?";
            $stm = $pdo->prepare($sql);
            $stm->execute([$id]);
            $row = $stm->fetch();
            $contract=$row['contract']==1?'Есть':'Нет';
            //еще студенты
            $sql="SELECT *
            FROM vacancies
            WHERE company=?";
            $stm = $pdo->prepare($sql);
            $stm->execute([$id]);
            $vac = $stm->fetchAll();
          break;
    }
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
      switch ($role){
        case -1:
		break;
        case 0://Админ         
            //видно админам   
            if ($_SESSION['is_auth']&&$_SESSION['role']==0){
                $a=0;
                if (count($st)>0||count($unst)>0){
                    printf('<a class="accordion-title shade main">Студенты</a>
                    <a id="'.$a.'b" onclick="is_clicked_b(`'.$a.'`, this)" style="padding: 9px;" class="button main top float-right shade">Развернуть</a>
                    <div id="'.$a.'" style="display:none;" class="podtv">');
                        foreach($st as $rw => $link){
                            $sql='SELECT fio FROM student WHERE id=?';
                            $stm = $pdo->prepare($sql);
                            $stm->execute([$link['id']]);
                            $fio = $stm->fetch();
                            printf('<a class="accordion-title podt" href="profile.php?id='.$link['id'].'" style="margin-bottom: 5px;">'.$fio['fio'].'</a>
                            <a href="profile.php?disactid='.$link['id'].'" style="top: -58px; padding: 9px; margin-left: 18px; background-color: #ca3838;" class="button main top float-right shade">Отклонить</a>
                            <a href="profile.php?actid='.$link['id'].'" style="top: -58px; padding: 9px;" class="button main top float-right shade">Принять</a>');
                            $a++;
                        }
                        foreach($unst as $rw => $link){
                            $sql='SELECT fio FROM student WHERE id=?';
                            $stm = $pdo->prepare($sql);
                            $stm->execute([$link['id']]);
                            $fio = $stm->fetch();
                            printf('<a class="accordion-title podt" href="profile.php?id='.$link['id'].'" style="margin-bottom: 5px;">'.$fio['fio'].'</a>
                            <a href="profile.php?disid='.$link['id'].'" style="top: -58px; padding: 9px; margin-left: 18px; background-color: #ca3838; width: 200px; min-width: 200px;" class="button main top float-right shade">Блокировать пользователя</a>');
                            $a++;
                        }
                    printf('</div>');
                }
                if (count($leader)>0||count($unleader)>0){
                    printf('<a class="accordion-title shade main">Руководители</a>
                    <a id="'.$a.'b" onclick="is_clicked_b(`'.$a.'`, this)" style="padding: 9px;" class="button main top float-right shade">Развернуть</a>
                    <div id="'.$a.'" style="display:none;" class="podtv">');
                        foreach($leader as $rw => $link){
                            $sql='SELECT fio FROM leader WHERE id=?';
                            $stm = $pdo->prepare($sql);
                            $stm->execute([$link['id']]);
                            $fio = $stm->fetch();
                            printf('<a class="accordion-title podt" href="profile.php?id='.$link['id'].'" style="margin-bottom: 5px;">'.$fio['fio'].'</a>
                            <a href="profile.php?disactid='.$link['id'].'" style="top: -58px; padding: 9px; margin-left: 18px; background-color: #ca3838;" class="button main top float-right shade">Отклонить</a>
                            <a href="profile.php?actid='.$link['id'].'" style="top: -58px; padding: 9px;" class="button main top float-right shade">Принять</a>');
                            $a++;
                        }
                        foreach($unleader as $rw => $link){
                            $sql='SELECT fio FROM leader WHERE id=?';
                            $stm = $pdo->prepare($sql);
                            $stm->execute([$link['id']]);
                            $fio = $stm->fetch();
                            printf('<a class="accordion-title podt" href="profile.php?id='.$link['id'].'" style="margin-bottom: 5px;">'.$fio['fio'].'</a>
                            <a href="profile.php?disid='.$link['id'].'" style="top: -58px; padding: 9px; margin-left: 18px; background-color: #ca3838; width: 200px; min-width: 200px;" class="button main top float-right shade">Блокировать пользователя</a>');
                            $a++;
                        }
                    printf('</div>');
                }
                if (count($cmp)>0||count($uncmp)>0){
                    printf('<a class="accordion-title shade main">Предприятия</a>
                    <a id="'.$a.'b" onclick="is_clicked_b(`'.$a.'`, this)" style="padding: 9px;" class="button main top float-right shade">Развернуть</a>
                    <div id="'.$a.'" style="display:none;" class="podtv">');
                        foreach($cmp as $rw => $link){
                            $sql='SELECT name FROM company WHERE id=?';
                            $stm = $pdo->prepare($sql);
                            $stm->execute([$link['id']]);
                            $fio = $stm->fetch();
                            printf('<a class="accordion-title podt" href="profile.php?id='.$link['id'].'" style="margin-bottom: 5px;">'.$fio['name'].'</a>
                            <a href="profile.php?disactid='.$link['id'].'" style="top: -58px; padding: 9px; margin-left: 18px; background-color: #ca3838;" class="button main top float-right shade">Отклонить</a>
                            <a href="profile.php?actid='.$link['id'].'" style="top: -58px; padding: 9px;" class="button main top float-right shade">Принять</a>');
                            $a++;
                        }
                        foreach($uncmp as $rw => $link){
                            $sql='SELECT name FROM company WHERE id=?';
                            $stm = $pdo->prepare($sql);
                            $stm->execute([$link['id']]);
                            $fio = $stm->fetch();
                            printf('<a class="accordion-title podt" href="profile.php?id='.$link['id'].'" style="margin-bottom: 5px;">'.$fio['name'].'</a>
                            <a href="profile.php?disid='.$link['id'].'" style="top: -58px; padding: 9px; margin-left: 18px; background-color: #ca3838; width: 200px; min-width: 200px;" class="button main top float-right shade">Блокировать пользователя</a>');
                            $a++;
                        }
                    printf('</div>');
                }
            }
        break;
        case 1://Руководитель //выбрать данные
            //видно админу
            if ($_SESSION['is_auth']&&$_SESSION['role']==0){
                print_r('<a class="accordion-title shade main" style="background-color:#ffda9c;
                border: 1px solid #ffda9c;"></br></a>
                <a href="profile.php?disid='.$row['id'].'" style="padding: 9px; margin-left: 18px; background-color: #ca3838; width: 200px; min-width: 200px;" class="button main top float-right shade">Блокировать пользователя</a>');
            }
            //видно всем
            printf('
            <a class="accordion-title shade main">Профиль</a>
            <div class="inf">');              
            printf('
              <p><b>Логин: </b>'.$res['login'].'</br>
              <b>ФИО: </b>'.$row['fio'].'</br>
              <b>Номер телефона: </b>'.$res['phone'].'</br>
              <b>Почта: </b>'.$res['phone'].'</br>
              <b>Группы: </b>');
            $stds=explode(";",$row['groups']);
            foreach($stds as $gr){
                $sql='SELECT number, name FROM `group` WHERE id=?';
                $stm = $pdo->prepare($sql);
                $stm->execute([$gr]);
                $group = $stm->fetch();      
                echo ''.$group['number'].' ('.$group['name'].')</br>';
            }       
            printf('</br>
              </p>
            </div>
            <a href="reg.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Изменить</a>
                ');                  
            if ($_SESSION["is_auth"]&& $_SESSION["id"]==$id) {
            printf('
            <a class="accordion-title shade main">Отчет</a>
            <div class="inf adm">
                    <div class="grid-x">
                        <div class="large-12 cell">
                            <div class="grid-x grid-margin-x">
                                <div class="medium-1 cell">
                                    <p class="adm"><b>Группа: </b></p>
                                </div> 
                                <div class="medium-3 cell">
                                   <input id="search" type="text" class="adm" onchange=prof() value="'.$_GET['search'].'" name="search" list="citynames">
                                </div>
                                <div class="medium-2 cell">
                                    <a href="profile.php?grnnamexls=" id="but_v" class="button adm top shade" onclick="is_clicked("but_v","student")">Вывести</a>
                                </div>
                                <div class="medium-2 cell">
                                    <a href="download_group.php?grnname="  id="but_s" class="button adm top shade" onclick="is_clicked("but_s","leader")">Скачать .xls</a>
                                </div>
					
								
                                <div class="medium-4 cell">
                                    <a href="download_groups.php" id="but_c" class="button adm top shade" onclick="is_clicked("but_c","company")">Скачать все группы .xls</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                ');   
            if ($_GET['grnnamexls']<>"") {
			$grnnamexls	= $_GET['grnnamexls'];
			printf('
			<table border="1">
			<caption>Группа '.$_GET['grnnamexls'].'</caption>
			<tr>
			<th>ФИО</th>
			<th>Вакансия</th>
			</tr> ');
			$query = "SELECT * FROM `student` LEFT OUTER JOIN `group` ON student.`group`=group.id where group.number = '$grnnamexls' ORDER BY student.fio";
			$res = mysql_query( $query );
			while( $prd = mysql_fetch_assoc($res) ) {
			$vac = $prd['vacancy'];
			$query2 =mysql_query("SELECT vacancies.name FROM vacancies LEFT OUTER JOIN student ON student.vacancy=vacancies.id where vacancies.id = '$vac'");
			$res1 = mysql_result($query2, 0); 
			printf('
				<tr>
				<td align="center">'.$prd['fio'].'</td>
				<td align="center">'.$res1.'</td>
				</tr> ');
			}

			}
			}
        break;
        case 2://студент
            //видно администратору
            if ($_SESSION['is_auth']&&$_SESSION['role']==0){
                print_r('<a class="accordion-title shade main" style="background-color:#ffda9c;
                border: 1px solid #ffda9c;"></br></a>
                <a href="profile.php?disid='.$row['id'].'" style="padding: 9px; margin-left: 18px; background-color: #ca3838; width: 200px; min-width: 200px;" class="button main top float-right shade">Блокировать пользователя</a>');
            }
            //видно всем 
            printf('
            <a class="accordion-title shade main">Профиль</a>
            <div class="inf">
              <p><b>Логин: </b>'.$res['login'].'</br>
              <b>ФИО: </b>'.$row['fio'].'</br>
              <b>Номер телефона: </b>'.$res['phone'].'</br>
              <b>Номер группы: </b>'.$row['number'].' ('.$row['name'].')</br></p>
              <p class="link" onclick="is_clicked(`hidden_text`, this)" style="color:#949494; cursor: pointer;"><b>Остальные данные...</b></p>
              <p id="hidden_text" style="display:none;">
              <b>Номер зачётной книжки: </b>'.$row['num'].'</br>
              <b>Статус занятости: </b>'.$vacancy.'</br>
              <b>Руководитель практики: </b>'.$row['l_fio'].'</br>
              </br>
              </p>
            </div>');
            //видно пользователю и администратору
            if (($_SESSION["is_auth"]&& $_SESSION["id"]==$id)||($_SESSION['is_auth']&& $_SESSION['role']==0)){
                printf('
                <a href="reg.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Изменить</a>
                    ');   
            }
        break;
        case 3  ://компания
            //видно админитсратору
            if ($_SESSION['is_auth']&&$_SESSION['role']==0){
                print_r('<a class="accordion-title shade main" style="background-color:#ffda9c;
                border: 1px solid #ffda9c;"></br></a>
                <a href="profile.php?disid='.$row['id'].'" style="padding: 9px; margin-left: 18px; background-color: #ca3838; width: 200px; min-width: 200px;" class="button main top float-right shade">Блокировать пользователя</a>');
            }
            $a=0;
            //видно всем
            printf('
            <a class="accordion-title shade main">Профиль</a>
            <div class="inf">
              <p><b>Наименование: </b>'.$row['name'].'</br>
              <b>ИНН: </b>'.$row['inn'].'</br>
              <b>Договор с ДВФУ: </b>'.$contract.'</br>
              <b>Описание: </b>'.$row['description'].'</br>
              </br>
              </p>
            </div>');
            //видно пользователю и администратору
            if (($_SESSION["is_auth"]&& $_SESSION["id"]==$id)||($_SESSION['is_auth']&& $_SESSION['role']==0)){
                printf('
                <a href="reg.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Изменить</a>');
            }
            //видно пользоватетлю
            if ($_SESSION["is_auth"]&& $_SESSION["id"]==$id) {
            printf('<a class="accordion-title shade main">Занятость</a>');
            foreach ($vac as $rw => $link) {
                $sql="SELECT s.*, g.name, g.number
                FROM student s
                LEFT OUTER JOIN `group` g
                ON s.group = g.id
                WHERE s.vacancy=?";
                $stm = $pdo->prepare($sql);
                $stm->execute([$link['id']]);
                $std = $stm->fetchAll();
                printf('
                <a class="accordion-title shade main" style="background-color: #95c9c3; color:#fff; border-color:#95c9c3;">'.$link['name'].'</a>
                <a id="'.$a.'b" onclick="is_clicked_b(`'.$a.'`, this)" style="padding: 9px;" class="button main top float-right shade">Развернуть</a>
                <div id='.$a.' style="display:none;min-height: 60px;" class="inf">');
                if ($_SESSION["is_auth"]&& $_SESSION["id"]=$id)
                    echo '<a href="profile.php?delvac='.$link['id'].'" style="padding: 9px; height: 30px; line-height:1; margin-left: 18px; background-color: #b1051a; position: relative; top: 0px; margin: 0px; width: 200px; min-width:200px; right:-85px;" class="button main top float-right shade">Удалить вакансию</a>';
                if (count($std)>0){
                    printf('<table class="mytable" >
                            <tr class="myrow">
                                <td class="mytd">
                                    Фио
                                </td>
                                <td class="mytd">
                                    Направления
                                </td>
                                <td class="mytd">
                                    Номер группы
                                </td>
                                <td class="none" style="display:none;">
                                </td>
                            </tr>');
                            foreach ($std as $st => $slink) {
                                printf('
                                <tr class="myrow">
                                    <td class="mytd">
                                        <p><a style="color:#31c0b2; text-decoration: underline;" href="profile.php?id='.$slink['id'].'">'.$slink['fio'].'</a></p>
                                    </td>
                                    <td class="mytd">
                                        '.$slink['name'].'
                                    </td>
                                    <td class="mytd">
                                        '.$slink['number'].'
                                    </td>
                                    <td class="none">
                                        <a href="profile.php?delst='.$slink['id'].'" style="padding: 9px; background-color: #ca3838; top: 0px;  height: 30px; line-height:1;" class="button main float-right shade">Исключить</a>
                                    </td>
                                </tr>');
                            }
                }
                printf('</table>
                </div>');
                $a++;
            }
            printf('<a class="accordion-title shade main">Заявки</a>');
            foreach ($vac as $rw => $link) {
                $stds=explode(";",$link['students']);
                if ($stds[0]){
                    printf('
                    <a class="accordion-title shade main" style="background-color: #95c9c3; color:#fff; border-color:#95c9c3;">'.$link['name'].'</a>
                    <a id="'.$a.'b" onclick="is_clicked_b(`'.$a.'`, this)" style="padding: 9px;" class="button main top float-right shade">Развернуть</a>
                    <div id='.$a.' style="" class="inf">');
                    printf('<table class="mtable" style="position: relative; top: -50px;">');
                            foreach ($stds as $st) {                               
                                $sql="SELECT s.*, g.name, g.number
                                FROM student s
                                LEFT OUTER JOIN `group` g
                                ON s.group = g.id
                                WHERE s.id=?";
                                $stm = $pdo->prepare($sql);
                                $stm->execute([$st]);
                                $std = $stm->fetch();
                                if ($std){
                                    printf('
                                    <tr id="mrow">
                                        <td class="mtd">
                                            <p><a style="color:#31c0b2; text-decoration: underline;" href="profile.php?id='.$std['id'].'">'.$std['fio'].'</a></p>
                                        </td>
                                        <td class="mtd">
                                            '.$std['name'].'
                                        </td>
                                        <td class="mtd">
                                            '.$std['number'].'
                                        </td>
                                        <td class="mtd">
                                            <a href="profile.php?addst='.$std['id'].'&vac='.$link['id'].'" style="padding: 9px; background-color: #228379; top: 0px;  height: 30px; line-height:1;" class="button main float-right shade">Принять</a>
                                        </td>
                                        <td class="mtd">
                                            <a href="profile.php?deletest='.$std['id'].'&vac='.$link['id'].'" style="padding: 9px; background-color: #ca3838; top: 0px;  height: 30px; line-height:1;" class="button main float-right shade">Отклонить</a>
                                        </td>
                                    </tr>');
                                }
                            }
                    printf('</table>
                    </div>');
                }
                $a++;
            }
        }
        break;
      }
      ?>
        
    </div>
    <?php include ("footer.php");?>
    <script>
	window.onload = function() {
		document.getElementById(`but_s`).href='download_group.php?grnname='+document.getElementById(`search`).value;
		document.getElementById(`but_v`).href='profile.php?grnnamexls='+document.getElementById(`search`).value;
	}
    function is_clicked(id, p){
            if (document.getElementById(id).style.display=='none'){ 
            document.getElementById(id).style.display='block'; 
            p.innerHTML = '<b>Скрыть данные...</b>'
            }
            else{ 
            document.getElementById(id).style.display='none'; 
            p.innerHTML = '<b>Остальные данные...</b>'
            }
         }
         
    function is_clicked_b(id,p){
            if (document.getElementById(id).style.display=='none'){ 
            document.getElementById(id).style.display='block'; 
            document.getElementById(id+'b').style['background-color']='#d8d8d8'; 
            document.getElementById(id+'b').style['color']='#fff'; 
            document.getElementById(id+'b').style['box-shadow']='inset 0px 2px 3px rgba(0,0,0,0.3)'; 
            p.innerHTML = 'Свернуть'
            }
            else{ 
            document.getElementById(id).style.display='none'; 
            document.getElementById(id+'b').style['background-color']='#269489'; 
            document.getElementById(id+'b').style['color']='#fff'; 
            document.getElementById(id+'b').style['box-shadow']='0px 2px 2px rgba(0,0,0,0.3)'; 
            p.innerHTML = 'Развернуть'
            }
         }
         document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboard(document.getElementById("copyTarget"));
});

    function copyToClipboard(elem) {
          // create hidden text element, if it doesn't already exist
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;
        if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;
        }
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);
        
        // copy the selection
        var succeed;
        try {
              succeed = document.execCommand("copy");
        } catch(e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }
        
        if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            // clear temporary content
            target.textContent = "";
        }
        return succeed;
    }
	function prof(){
		document.getElementById(`but_s`).href='download_group.php?grnname='+document.getElementById(`search`).value;
		document.getElementById(`but_v`).href='profile.php?grnnamexls='+document.getElementById(`search`).value;
	}
    </script>
  </body>
</html>
