﻿<!doctype html>
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
            <div>
                <a class="accordion-title shade">Регистрация</a>
                <div class="regi" >
                    <div class="grid-x" style="padding: 25px 0 5px; ">
                        <div class="large-12 cell">
                            <div class="grid-x grid-margin-x">
                                <div class="medium-4 cell">
                                    <a id="but_s" class="button role shade" onclick="is_clicked('but_s','student')">Студент</a>
                                </div>
                                <div class="medium-4 cell">
                                    <a id="but_l" class="button role shade" onclick="is_clicked('but_l','leader')">Руководитель</a>
                                </div>
                                <div class="medium-4 cell">
                                    <a id="but_c" class="button role shade" onclick="is_clicked('but_c','company')">Предриятие</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="student" data-abide style="display: block;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row">
                        <div class="small-12 columns">
                          <label class="reg">Логин</label>
                            <input class="in" type="text" required pattern="text">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Пароль</label>
                            <input class="in" type="password" id="password" required >
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Повторите пароль</label>
                            <input class="in" type="password" aequired pattern="alpha_numeric" data-equalto="password">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">ФИО</label>
                            <input class="in" type="text" required pattern="text">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">E-mail</label>
                            <input class="in" type="text" required pattern="url">
                            <span class="form-error"></span>                      
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Группа</label>
                            <input class="in" type="text" required pattern="text">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Номер телефона</label>
                            <input class="in" type="text" required pattern="number">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                            <label class="reg">Номер зачётной книжки</label>
                            <input class="in" type="text" required pattern="number">
                            <span class="form-error"></span>
                        </div>
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%"type="submit" value="Submit">Записаться</button>
                        </fieldset>
                      </div>
                    </form>
                    <form id="leader" data-abide style="display: none;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row">
                        <div class="small-12 columns">
                          <label class="reg">Логин</label>
                            <input class="in" type="text" required pattern="text">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Пароль</label>
                            <input class="in" type="password" id="password" required >
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Повторите пароль</label>
                            <input class="in" type="password" aequired pattern="alpha_numeric" data-equalto="password">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">ФИО</label>
                            <input class="in" type="text" required pattern="text">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">E-mail</label>
                            <input class="in" type="text" required pattern="url">
                            <span class="form-error"></span>                      
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Группа</label>
                            <input class="in" type="text" required pattern="text">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Номер телефона</label>
                            <input class="in" type="text" required pattern="number">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                            <label class="reg">Номер зачётной книжки</label>
                            <input class="in" type="text" required pattern="number">
                            <span class="form-error"></span>
                        </div>
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%"type="submit" value="Submit">Записаться</button>
                        </fieldset>
                      </div>
                    </form>
                    <form id="company" data-abide style="display: none;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row">
                        <div class="small-12 columns">
                          <label class="reg">Логин</label>
                            <input class="in" type="text" required pattern="text">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Пароль</label>
                            <input class="in" type="password" id="password" required >
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Повторите пароль</label>
                            <input class="in" type="password" aequired pattern="alpha_numeric" data-equalto="password">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">ФИО</label>
                            <input class="in" type="text" required pattern="text">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">E-mail</label>
                            <input class="in" type="text" required pattern="url">
                            <span class="form-error"></span>                      
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Группа</label>
                            <input class="in" type="text" required pattern="text">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Номер телефона</label>
                            <input class="in" type="text" required pattern="number">
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                            <label class="reg">Номер зачётной книжки</label>
                            <input class="in" type="text" required pattern="number">
                            <span class="form-error"></span>
                        </div>
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%"type="submit" value="Submit">Записаться</button>
                        </fieldset>
                      </div>
                    </form>
                </div>
            </div>
    </div>
    <?php include ("footer.php");?>
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
