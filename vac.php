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
  <script type="text/javascript">
  jQuery(function()
  {
    jQuery('textarea').autoResize({
     extraSpace :80
    });
  });
</script>
  <body>
      <?php include ("menu.php");?>
            <div>
                <a class="accordion-title shade">Создание вакансии</a>
                <div class="regi" >
                    <form id="student" action="save_user.php" method="post" data-abide style="display: block;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row">
                        <div class="small-12 columns">
                          <label class="reg">Наименование</label>
                            <input style="font-size: 0.7rem;" name="login" class="in" type="text" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Описания деятельности студента на вакансии</label>
                            <textarea style="resize: none; overflow-y: hidden; position: absolute; top: 0px; left: -9999px; height: 70px; width: 400px; line-height: normal; text-decoration: none; letter-spacing: normal;" tabindex="-1"></textarea>
                            <textarea style="font-size: 0.7rem; resize:none; overflow-y: hidden;" name="password" class="in" type="password" id="password" required ></textarea>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Договор с ДВФУ</label>
                            <select style="font-size: 0.7rem;" name="checkPassword" class="in" type="password" required data-equalto="password"><option>Да</option><option>Нет</option></select>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Условие приема</label>
                            <textarea style="resize: none; overflow-y: hidden; position: absolute; top: 0px; left: -9999px; height: 70px; width: 400px; line-height: normal; text-decoration: none; letter-spacing: normal;" tabindex="-1"></textarea>
                            <textarea style="font-size: 0.7rem; resize:none; overflow-y: hidden;" name="fullName" class="in" type="text" required></textarea>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Количество мест для практики</label>
                            <input style="font-size: 0.7rem;" name="number" class="in" type="number" value="1" required>
                            <span class="form-error"></span>                      
                        </div>
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%" type="submit" value="Submit">Записаться</button>
                        </fieldset>
                      </div>
                    </form>
                </div>
            </div>
    </div>
    <?php include ("footer.php");?>
  </body>
</html>
