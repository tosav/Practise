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

        <ul class="accordion" data-accordion>
            <li class="accordion-item is-active" data-accordion-item>
                <a class="accordion-title">Регистрация</a>
                <div class="accordion-content" data-tab-content>
                  <form data-abide novalidate>
                  <div data-abide-error class="alert callout" style="display: none;">
                    <p><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                  </div>
                  <div class="row">
                    <div class="small-12 columns">
                      <label>Логин
                        <input type="text" required pattern="text">
                        <span class="form-error"></span>
                      </label>
                    </div>
                    <div class="small-12 columns">
                      <label>Пароль
                        <input type="password" id="password" required >
                        <span class="form-error"></span>
                      </label>
                    </div>
                    <div class="small-12 columns">
                      <label>Повторите пароль
                        <input type="password" aequired pattern="alpha_numeric" data-equalto="password">
                        <span class="form-error"></span>
                      </label>
                    </div>
                    <div class="small-12 columns">
                      <label>ФИО
                        <input type="text" required pattern="text">
                        <span class="form-error"></span>
                      </label>
                    </div>
                    <div class="small-12 columns">
                      <label>E-mail
                        <input type="text" required pattern="url">
                        <span class="form-error"></span>
                      </label>
                    </div>
                    <div class="small-12 columns">
                      <label>Группа
                        <input type="text" required pattern="text">
                        <span class="form-error"></span>
                      </label>
                    </div>
                    <div class="small-12 columns">
                      <label>Номер телефона
                        <input type="text" required pattern="number">
                        <span class="form-error"></span>
                      </label>
                    </div>
                    <div class="small-12 columns">
                      <label>Номер зачётной книжки
                        <input type="text" required pattern="number">
                        <span class="form-error"></span>
                      </label>
                    </div>
                    <fieldset class="small-12 columns">
                      <button class="button float-right" type="submit" value="Submit">Записаться</button>
                    </fieldset>
                  </div>
                  </form>
                </div>
            </li>
        </ul>
    </div>
    <?php include ("footer.php");?>
  </body>
</html>
