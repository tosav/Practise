<?
session_start();
$id=$_SESSION["is_auth"]?$_SESSION['id']:-1;
if ($_GET['id'])
    $id=$_GET['id'];
$role=$_SESSION["is_auth"]?$_SESSION['role']:-1;
if ($id){
    $dsn = 'mysql:dbname=practice;host=127.0.0.1;port=3306;charset=utf8';
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, 'root', '', $opt);
    $sql="SELECT * FROM users WHERE id=?";
    
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $res = $stm->fetch();
    $role=$res['role'];
    switch($res['role']){
          case 0:
                $_SESSION['name']='Админ';
          break;
          case 1:
            $sql="SELECT * FROM leader WHERE id=?";
            $stm = $pdo->prepare($sql);
            $stm->execute([$id]);
            $row = $stm->fetch();
          break;
          case 2:
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
          case 3:
            $sql="SELECT * FROM company WHERE id=?";
            $stm = $pdo->prepare($sql);
            $stm->execute([$id]);
            $res = $stm->fetch();
            $sql="SELECT * FROM vacancies WHERE company=?";
            $stm = $pdo->prepare($sql);
            $stm->execute([$id]);//чёт не то
            $vac = $stm->fetch();
            //еще студенты
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
      //блокировать пользователя
      //если его страница   
      switch (/*$_SESSION['role']*/$role/*2*/){
        case 0://Админ
            printf('
            <a class="accordion-title shade main">Студенты</a>
            <a id="0b" onclick="is_clicked_b(`0`, this)" style="padding: 9px;" class="button main top float-right shade">Развернуть</a>
            <div id="0" style="display:none;" class="podtv">
                <a class="accordion-title podt" href="profile.php?id=">Студенты</a>
                <a href="vac.php?id='.$row['id'].'" style="padding: 9px; margin-left: 18px; background-color: #ca3838;" class="button main top float-right shade">Отклонить</a>
                <a href="del.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Принять</a>
            </div>');
            printf('
            <a class="accordion-title shade main">Руководители</a>
            <a id="1b" onclick="is_clicked_b(`1`, this)" style="padding: 9px;" class="button main top float-right shade">Развернуть</a>
            <div id="1" style="display:none;" class="inf">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>');  
            printf('
            <a class="accordion-title shade main">Предприятия</a>
            <a id="2b" onclick="is_clicked_b(`2`, this)" style="padding: 9px;" class="button main top float-right shade">Развернуть</a>
            <div id="2" style="display:none;" class="inf">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>'); 
        break;
        case 1://Руководитель
            printf('
            <a class="accordion-title shade main">Профиль</a>
            <div class="inf">');
            /*printf('
                
              <p><b>Логин: </b>'.$row['login'].'</br>
              <b>ФИО: </b>'.$contr.'</br>
              <b>Номер телефона: </b>'.$row['description'].'</br>
              <b>Почта: </b>'.$row['description'].'</br>
              Остальные данные</p>
              <p>');*/
              
            printf('
              <p><b>Логин: </b>'.$res['login'].'</br>
              <b>ФИО: </b>'.$row['fio'].'</br>
              <b>Номер телефона: </b>'.$res['phone'].'</br>
              <b>Почта: </b>'.$res['phone'].'</br></p>
              <p class="link" onclick="is_clicked(`hidden_text`, this)" style="color:#949494; cursor: pointer;"><b>Остальные данные...</b></p>
              <p id="hidden_text" style="display:none;">

              <b>Номер зачётной книжки: </b>'.$row['description'].'</br>
              <b>Статус занятости: </b>'.$row['description'].'</br>
              <b>Руководитель практики: </b>'.$row['description'].'</br>
              </br>
              </p>
            </div>
            <a href="reg.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Изменить</a>
                ');               
                
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
                                   <input id="search" type="text" class="adm" value="'.$_GET['search'].'" name="search">
                                </div>
                                <div class="medium-2 cell">
                                    <a id="but_s" class="button adm top shade" onclick="is_clicked("but_s","student")">Вывести</a>
                                </div>
                                <div class="medium-2 cell">
                                    <a id="but_l" class="button adm top shade" onclick="is_clicked("but_l","leader")">Скачать .xls</a>
                                </div>
                                <div class="medium-4 cell">
                                    <a id="but_c" class="button adm top shade" onclick="is_clicked("but_c","company")">Скачать все группы .xls</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                ');   
                
        break;
        case 2://студент
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
            if ($_SESSION["is_auth"]&& $_SESSION["id"]=$id){
                printf('
                <a href="reg.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Изменить</a>
                    ');   
            }
        break;
        case 3://компания

            printf('
            <a class="accordion-title shade main">Профиль</a>
            <div class="inf">
              <p><b>Наименование: </b>'.$row['login'].'</br>
              <b>ИНН: </b>'.$row['description'].'</br>
              <b>Договор с ДВФУ: </b>'.$row['description'].'</br>
              <b>Описание: </b>'.$contr.'</br>
              </br>
              </p>
            </div>
            <a href="reg.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Изменить</a>');
            printf('
            <a class="accordion-title shade main">Занятость</a>
            <a class="accordion-title shade main" style="background-color: #95c9c3; color:#fff;">Какая-то вакансия</a>
            <a id="0b" onclick="is_clicked_b(`0`, this)" style="padding: 9px;" class="button main top float-right shade">Развернуть</a>
            <div id="0" style="display:none;" class="inf">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>');
/*            printf('
 
                <ul class="accordion" data-accordion data-allow-all-closed="true">
                    <li class="accordion-item" data-accordion-item>
                        <a class="accordion-title">Предприятия</a>
                        <div class="accordion-content" data-tab-content>
                            <table>
                              <thead>
                                <tr>
                                  <th>Название</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Иванов</td>
                                  <td><button class="button">Принять</button></td>
                                  <td><button class="button">Отклонить</button></td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
            ');  
 */			
    printf('
            <a class="accordion-title shade main">Заявки</a>
            <a class="accordion-title shade main" style="background-color: #95c9c3; color:#fff;">Какая-то вакансия</a>
            <a id="0b" onclick="is_clicked_b(`0`, this)" style="padding: 9px;" class="button main top float-right shade">Развернуть</a>
            <div id="0" style="display:none;" class="inf">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>');

        break;
      }
      ?>
        
    </div>
    <?php include ("footer.php");?>
    <script>
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
    </script>
  </body>
</html>
