<?
session_start();
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
      switch (/*$_SESSION['role']*/1){
        case 0://Админ
            printf('
            <a class="accordion-title shade main">Профиль</a>
            <div class="inf">
              <p><b>Логин: </b>'.$row['login'].'</br>
              <b>ФИО: </b>'.$contr.'</br>
              <b>Номер телефона: </b>'.$row['description'].'</br>
              <b>Номер группы: </b>'.$row['description'].'</br>
              <b>Номер зачётной книжки: </b>'.$row['description'].'</br>
              <b>Статус занятости: </b>'.$row['description'].'</br>
              <b>Руководитель практики: </b>'.$row['description'].'</br>
              </br>
              </p>
            </div>
            <a href="reg.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Изменить</a>
                ');   
        break;
        case 1://Руководитель
            printf('
            <a class="accordion-title shade main">Профиль</a>
            <div class="inf">
              <p><b>Логин: </b>'.$row['login'].'</br>
              <b>ФИО: </b>'.$contr.'</br>
              <b>Номер телефона: </b>'.$row['description'].'</br>
              <b>Почта: </b>'.$row['description'].'</br></p>
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
              <p><b>Логин: </b>'.$row['login'].'</br>
              <b>ФИО: </b>'.$contr.'</br>
              <b>Номер телефона: </b>'.$row['description'].'</br>
              <b>Номер группы: </b>'.$row['description'].'</br>
              <b>Номер зачётной книжки: </b>'.$row['description'].'</br>
              <b>Статус занятости: </b>'.$row['description'].'</br>
              <b>Руководитель практики: </b>'.$row['description'].'</br>
              </br>
              </p>
            </div>
            <a href="reg.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Изменить</a>
                ');   
        break;
        case 3:
            printf('
            <a class="accordion-title shade main">Профиль</a>
            <div class="inf">
              <p><b>Логин: </b>'.$row['login'].'</br>
              <b>ФИО: </b>'.$contr.'</br>
              <b>Номер телефона: </b>'.$row['description'].'</br>
              <b>Почта: </b>'.$row['description'].'</br>
              //Остальные данные</p>
              <p>
              <b>Номер зачётной книжки: </b>'.$row['description'].'</br>
              <b>Статус занятости: </b>'.$row['description'].'</br>
              <b>Руководитель практики: </b>'.$row['description'].'</br>
              </br>
              </p>
            </div>
            <a href="reg.php?id='.$row['id'].'" style="padding: 9px;" class="button main top float-right shade">Изменить</a>
                ');     
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
    </script>
  </body>
</html>
