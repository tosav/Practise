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
        <ul class="accordion" data-accordion data-allow-all-closed="true">
            <li class="accordion-item" data-accordion-item>
                <a class="accordion-title">Узнай основную информацию о практике</a>
                <div class="accordion-content" data-tab-content>
                  <p>Panel 1. Lorem ipsum dolor</p>
                </div>
            </li>
        </ul>
        <ul class="accordion" data-accordion>
            <li class="accordion-item is-active" data-accordion-item>
                <a class="accordion-title">Название компании<p align="center">Дата</p></a>
                <div class="accordion-content" data-tab-content>
                  <p>Panel 1. Lorem ipsum dolor</p>
                  <a href="#" class="button float-right">Learn More</a>
                </div>
            </li>
        </ul>
        <div class="grid-x grid-margin-x">
          <div class="large-12 medium-2 cell">
            <img src="../9.png">
          </div>
        </div>
    </div>
    </div>
    <?php include ("footer.php");?>
  </body>
</html>
