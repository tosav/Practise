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
      $num=3;
      switch ($num){
        case 0:
            printf('
                <ul class="accordion" data-accordion>
                    <li class="accordion-item is-active" data-accordion-item data-allow-all-closed="true">
                        <a class="accordion-title">Название компании</a>
                        <div class="accordion-content" data-tab-content>
                            <p><b>Логин: </b></p>
                            <p><b>ФИО: </b></p>
                            <p><b>Номер телефона: </b></p>
                            <p><b>Почта: </b></p>
                            <p><b>Номер группы: </b></p>
                            <p><b>Номер зачетной книжки: </b></p>
                            <p><b>Руководитель практики: </b></p>
                            <fieldset class="small-12 columns">
                              <button class="button float-right">Изменить</button>
                            </fieldset>
                        </div>
                    </li>
                </ul>
            ');
        break;
        case 1:
            printf('
                <ul class="accordion" data-accordion>
                    <li class="accordion-item is-active" data-accordion-item data-allow-all-closed="true">
                        <a class="accordion-title">Название компании</a>
                        <div class="accordion-content" data-tab-content>
                            <p><b>Логин: </b></p>
                            <p><b>ФИО: </b></p>
                            <p><b>Номер телефона: </b></p>
                            <p><b>Почта: </b></p>
                            <p><b>Номер группы: </b></p>
                            <p><b>Номер зачетной книжки: </b></p>
                            <p><b>Руководитель практики: </b></p>
                            <fieldset class="small-12 columns">
                              <button class="button float-right">Изменить</button>
                            </fieldset>
                        </div>
                    </li>
                </ul>
                <ul class="accordion" data-accordion>
                    <li class="accordion-item is-active" data-accordion-item>
                        <a class="accordion-title">Отчёт</a>
                        <div class="accordion-content" data-tab-content>
                            <fieldset class="small-12 columns">
                              <p><b>Логин: </b></p>
                              <input type="text" required pattern="text">
                              <button class="button">Вывести</button>
                              <button class="button">Скачать .xls</button>
                              <button class="button">Скачать все группы .xls</button>
                            </fieldset>
                        </div>
                    </li>
                </ul>
            ');
        break;
        case 2:
            printf('
                <ul class="accordion" data-accordion>
                    <li class="accordion-item is-active" data-accordion-item data-allow-all-closed="true">
                        <a class="accordion-title">Название компании</a>
                        <div class="accordion-content" data-tab-content>
                            <p><b>Логин: </b></p>
                            <p><b>ФИО: </b></p>
                            <p><b>Номер телефона: </b></p>
                            <p><b>Почта: </b></p>
                            <p><b>Номер группы: </b></p>
                            <p><b>Номер зачетной книжки: </b></p>
                            <p><b>Руководитель практики: </b></p>
                            <fieldset class="small-12 columns">
                              <button class="button float-right">Изменить</button>
                            </fieldset>
                        </div>
                    </li>
                </ul>
                
                <ul class="accordion" data-accordion>
                    <li class="accordion-item is-active" data-accordion-item>
                        <a class="accordion-title">Занятость</a>
                    </li>
                </ul>
                
            ');
            //в цикле вывести вакансии
             printf('
                <ul class="accordion" data-accordion>
                    <li class="accordion-item is-active" data-accordion-item data-allow-all-closed="true">
                        <a class="accordion-title">Вакансия</a>
                        <div class="accordion-content" data-tab-content>
                            <button class="button float-right">Удалить вакансию</button>
                            <table>
                              <thead>
                                <tr>
                                  <th>ФИО</th>
                                  <th>Направление</th>
                                  <th>Номер группы</th>
                                  <th>Кнопка</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Иванов</td>
                                  <td>Прикладная информатика</td>
                                  <td>Б8419а</td>
                                  <td><button class="button">Исключить</button></td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
                
            ');   
             printf('      
                <ul class="accordion" data-accordion>
                    <li class="accordion-item is-active" data-accordion-item>
                        <a class="accordion-title">Заявки</a>
                    </li>
                </ul>
                
            '); 
            //в цикле вывести заявки
             printf('
                <ul class="accordion" data-accordion data-allow-all-closed="true">
                    <li class="accordion-item is-active" data-accordion-item>
                        <a class="accordion-title">Вакансия</a>
                        <div class="accordion-content" data-tab-content>
                            <table>
                              <thead>
                                <tr>
                                  <th>ФИО</th>
                                  <th>Направление</th>
                                  <th>Номер группы</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Иванов</td>
                                  <td>Прикладная информатика</td>
                                  <td>Б8419а</td>
                                  <td><button class="button">Принять</button></td>
                                  <td><button class="button">Отклонить</button></td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
                <ul class="accordion" data-accordion data-allow-all-closed="true">
                    <li class="accordion-item" data-accordion-item>
                        <a class="accordion-title">Вакансия</a>
                        <div class="accordion-content" data-tab-content>
                            <table>
                              <thead>
                                <tr>
                                  <th>ФИО</th>
                                  <th>Направление</th>
                                  <th>Номер группы</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Иванов</td>
                                  <td>Прикладная информатика</td>
                                  <td>Б8419а</td>
                                  <td><button class="button">Принять</button></td>
                                  <td><button class="button">Отклонить</button></td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
                
            ');              
        break;
        case 3:
            //студенты
            printf('
                    <a class="accordion-title shade main">Профиль</a>
                ');
            /*printf('
                <ul class="accordion" data-accordion data-allow-all-closed="true">
                    <li class="accordion-item" data-accordion-item>
                        <a class="accordion-title">Руководители</a>
                        <div class="accordion-content" data-tab-content>
                            <table>
                              <thead>
                                <tr>
                                  <th>ФИО</th>
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
            printf('
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
            ');   */
        break;
      }
      ?>
        
    </div>
    <!--если чужая страница
    </div>
    <?php include ("footer.php");?>
  </body>
</html>
