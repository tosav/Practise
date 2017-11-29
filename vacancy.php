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
    <div class="grid-container">    
      <?php include ("header.php");?>
      <?php include ("menu.php");?>
      <?
        //изменить удалить
      ?>
        <ul class="accordion" data-accordion>
            <li class="accordion-item is-active" data-accordion-item>
                <a class="accordion-title">Название компании</a>
                <div class="accordion-content" data-tab-content>
                    <?
                        echo '<p><b>Условие приема: </b></p>';
                        echo '<p><b>Договор с ДВФУ: </b></p>';
                        echo '<p><b>Описание деятельности студента: </b></p>';
                        echo '<p><b>Описание предприятия: </b></p>';
                        echo '<p><b>Номер телефона: </b></p>';
                        echo '<p><b>Почта: </b></p>';
                    ?>
                </div>
            </li>
        </ul>
    </div>
    </div>
    <?php include ("footer.php");?>
  </body>
</html>
