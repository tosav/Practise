<? session_start(); ?>
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
      <?php include ("menu.php");
	  if ($_SESSION["is_auth"]==true){
	  $id = $_GET['id'];
	  $res = mysql_query("SELECT role FROM users WHERE id='$id'");
	  $role = mysql_result($res, 0);}
	  if ($_SESSION["is_auth"]==false)
	  print_r('
            <div>
                <a class="accordion-title shade">Регистрация</a>
                <div class="regi" >
                    <div class="grid-x" style="padding: 25px 0 5px; ">
                        <div class="large-12 cell">
                            <div class="grid-x grid-margin-x">
                                <div class="medium-4 cell">
                                    <a id="but_s" class="button role shade" onclick="is_clicked(\'but_s\',\'student\')">Студент</a>
                                </div>
                                <div class="medium-4 cell">
                                    <a id="but_l" class="button role shade" onclick="is_clicked(\'but_l\',\'leader\')">Руководитель</a>
                                </div>
                                <div class="medium-4 cell">
                                    <a id="but_c" class="button role shade" onclick="is_clicked(\'but_c\',\'company\')">Предриятие</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="student" action="save_user.php" method="post" data-abide style="display: blo ck;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row">
                        <div class="small-12 columns">
                          <label class="reg">Логин</label>
                            <input name="login" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Пароль</label>
                            <input name="password" class="in" type="password" id="password" required >
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Повторите пароль</label>
                            <input name="checkPassword" class="in" type="password" required data-equalto="password">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">ФИО</label>
                            <input  name="fullName" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">E-mail</label>
                            <input name="email" class="in" type="text" required>
                            <span class="form-error"></span>                      
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Группа</label>
                            <input name="group" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Номер телефона</label>
                            <input name="phone" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                            <label class="reg">Номер зачётной книжки</label>
                            <input name="num" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%" type="submit" value="Submit">Записаться</button>
                        </fieldset>
                      </div>
                    </form>
                    <form id="leader" action="save_user2.php" method="post" data-abide style="display: none;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row">
                        <div class="small-12 columns">
                          <label class="reg">Логин</label>
                            <input name="login" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Пароль</label>
                            <input name="password" class="in" type="password" id="password" required >
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Повторите пароль</label>
                            <input name="checkPassword" class="in" type="password" required data-equalto="password">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">ФИО</label>
                            <input  name="fullName" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">E-mail</label>
                            <input name="email" class="in" type="text" required>
                            <span class="form-error"></span>                      
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Список групп</label>
                            <input name="gropus" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Номер телефона</label>
                            <input name="phone" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%"type="submit" value="Submit">Записаться</button>
                        </fieldset>
                      </div>
                    </form>
                    <form id="company" action="save_user3.php" method="post" data-abide style="display: none;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row">
                        <div class="small-12 columns">
                          <label class="reg">Логин</label>
                            <input name="login" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Пароль</label>
                            <input name="password" class="in" type="password" id="password" required >
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Повторите пароль</label>
                            <input name="checkPassword" class="in" type="password" required data-equalto="password">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Наименование предприятия</label>
                            <input  name="fullName" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">E-mail</label>
                            <input name="email" class="in" type="text" required>
                            <span class="form-error"></span>                      
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Номер телефона</label>
                            <input name="phone" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
						<div class="small-12 columns">
                          <label class="reg">ИНН</label>
                            <input name="inn" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
						<div class="small-12 columns">
                          <label class="reg">Описание предприятия</label>
                            <input name="description" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
						<div class="small-12 columns">
                          <label class="reg">Договор с ДВФУ(1 если есть или 0 если нет)</label>
                            <input name="contract" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%"type="submit" value="Submit">Записаться</button>
                        </fieldset>
                      </div>
                    </form>
                </div>
            </div>
    </div>	  ');
	elseif($role==1 && ($_SESSION['id']==$_GET['id'] or $_SESSION['role']==0)) {	
	$prof1 = mysql_query("SELECT * FROM users INNER JOIN leader ON (users.id = leader.id)
	where users.id = '$id'");
	$prof = mysql_fetch_assoc($prof1);
	$stds=explode(";",$prof['gropus']);
	$gropus = "";
    foreach($stds as $gr){
        $sql=mysql_query("SELECT number FROM `group` WHERE id='$gr'");
        $group = mysql_result($sql, 0);      
	    $gropus = $gropus . $group . " ";}
		$gropus = substr($gropus, 0, -1);
		print_r('
	    <div>
                <a class="accordion-title shade">Профиль</a>
				<div class="regi" >
                    <form id="student" action="save_change_leader.php" method="post" data-abide style="display: block;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row">
                        <div class="small-12 columns">
                          <label class="reg">Логин</label>
                            <input name="login" class="in" type="text" required value="'.$prof['login'].'">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Пароль</label>
                            <input name="password" class="in" type="password" id="password" required >
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Повторите пароль</label>
                            <input name="checkPassword" class="in" type="password" required data-equalto="password">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">ФИО</label>
                            <input  name="fullName" class="in" type="text" required value="'.$prof['fio'].'">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">E-mail</label>
                            <input name="email" class="in" type="text" required value="'.$prof['email'].'">
                            <span class="form-error"></span>                      
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Номера групп</label>
                            <input name="gropus" class="in" type="text" required value="'.$gropus.'">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Номер телефона</label>
                            <input name="phone" class="in" type="text" required value="'.$prof['phone'].'">
                            <span class="form-error"></span>
                        </div>

                       <input style="display:none" name="id" class="in" type="text" required value='.$prof['id'].'>

                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%" type="submit" value="Submit">Сохранить</button>
                        </fieldset>
                      </div>
                    </form>               
                </div>
			
            </div>'); 
	}
	elseif($role==2 && ($_SESSION['id']==$_GET['id'] or $_SESSION['role']==0)) {	
	  $prof1 = mysql_query("SELECT * FROM users INNER JOIN student ON (users.id = student.id)
	  where users.id = '$id'");
	  $prof = mysql_fetch_assoc($prof1);
	  $group = $prof['group'];
	  $res = mysql_query("SELECT number FROM `group` WHERE id = $group");
	  $group = mysql_result($res, 0);	  
	  print_r('
            <div>
                <a class="accordion-title shade">Профиль</a>
				<div class="regi" >
                    <form id="student" action="save_change_student.php" method="post" data-abide style="display: block;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row">
                        <div class="small-12 columns">
                          <label class="reg">Логин</label>
                            <input name="login" class="in" type="text" required value='.$prof['login'].'>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Пароль</label>
                            <input name="password" class="in" type="password" id="password" required >
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Повторите пароль</label>
                            <input name="checkPassword" class="in" type="password" required data-equalto="password">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">ФИО</label>
                            <input  name="fullName" class="in" type="text" required value="'.$prof['fio'].'">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">E-mail</label>
                            <input name="email" class="in" type="text" required value='.$prof['email'].'>
                            <span class="form-error"></span>                      
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Группа</label>
                            <input name="group" class="in" type="text" required value='.$group.'>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Номер телефона</label>
                            <input name="phone" class="in" type="text" required value='.$prof['phone'].'>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                            <label class="reg">Номер зачётной книжки</label>
                            <input name="num" class="in" type="text" required value='.$prof['num'].'>
                            <span class="form-error"></span>
                        </div>
						<input style="display:none" name="id" class="in" type="text" required value='.$prof['id'].'>
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%" type="submit" value="Submit">Сохранить</button>
                        </fieldset>
                      </div>
                    </form>               
                </div>
			
            </div>

	');
	}
	elseif($role==3 && ($_SESSION['id']==$_GET['id'] or $_SESSION['role']==0)) {	
	$prof1 = mysql_query("SELECT * FROM users INNER JOIN company ON (users.id = company.id)
	where users.id = '$id'");
	$prof = mysql_fetch_assoc($prof1);
	print_r('
		<div>
                <a class="accordion-title shade">Профиль</a>
				<div class="regi" >
                    <form id="student" action="save_change_company.php" method="post" data-abide style="display: block;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row">
                        <div class="small-12 columns">
                          <label class="reg">Логин</label>
                            <input name="login" class="in" type="text" required value='.$prof['login'].'>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Пароль</label>
                            <input name="password" class="in" type="password" id="password" required >
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Повторите пароль</label>
                            <input name="checkPassword" class="in" type="password" required data-equalto="password">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Наименование предприятия</label>
                            <input  name="fullName" class="in" type="text" required value="'.$prof['name'].'">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">E-mail</label>
                            <input name="email" class="in" type="text" required value='.$prof['email'].'>
                            <span class="form-error"></span>                      
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Номер телефона</label>
                            <input name="phone" class="in" type="text" required value='.$prof['phone'].'>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">ИНН</label>
                            <input name="inn" class="in" type="text" required value='.$prof['inn'].'>
                            <span class="form-error"></span>
                        </div>
						<div class="small-12 columns">
                          <label class="reg">Описание предприятия</label>
                            <input name="description" class="in" type="text" required value="'.$prof['description'].'">
                            <span class="form-error"></span>
                        </div>
						<div class="small-12 columns">
                          <label class="reg">Договор с ДВФУ(1 если есть или 0 если нет)</label>
                            <input name="contract" class="in" type="text" required value='.$prof['contract'].'>
                            <span class="form-error"></span>
                        </div>
						<input style="display:none" name="id" class="in" type="text" required value='.$prof['id'].'>
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%" type="submit" value="Submit">Сохранить</button>
                        </fieldset>
                      </div>
                    </form>               
                </div>
			
            </div> ');
	}				
    include ("footer.php");?>
    <script>
        function is_clicked(but,id){
            switch (id){
                case 'student': 
                    document.getElementById('leader').style.display='none';
                    document.getElementById('company').style.display='none';
                break;
                case 'leader': 
                    document.getElementById('student').style.display='none';
                    document.getElementById('company').style.display='none';
                break;
                case 'company': 
                    document.getElementById('student').style.display='none';
                    document.getElementById('leader').style.display='none';
                break;
            }
            document.getElementById(id).style.display='block'; 
            document.getElementById(previous).style['background-color']='#31c0b2';
            document.getElementById(previous).style['color']='#fefefe';
            document.getElementById(previous).style['box-shadow']='0px 2px 2px rgba(0,0,0,0.3)'; 
            document.getElementById(but).style['background-color']='#d8d8d8';
            document.getElementById(but).style['color']='#858585';
            document.getElementById(but).style['box-shadow']='inset 0px 1px 2px rgba(0,0,0,0.5)'; 
            previous=but;
            
         }
    window.onload = function(){
        previous='but_s';
        is_clicked('but_s','student');
    }
    </script>
  </body>
</html>
