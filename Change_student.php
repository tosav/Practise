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
      <?php include ("menu.php");?>
	  <?
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
                            <input  name="fullName" class="in" type="text" required value='.$prof['fio'].'>
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
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%" type="submit" value="Submit">Сохранить</button>
                        </fieldset>
                      </div>
                    </form>               
                </div>
			
            </div>
    </div>
	');
	?>
    <?php include ("footer.php");?>
  </body>
</html>
