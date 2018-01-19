<? session_start();
$dsn = 'mysql:dbname=practice;host=127.0.0.1;port=3306;charset=utf8';
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, 'root', '', $opt);
$id=$_SESSION["is_auth"]?$_SESSION['id']:-1;
if ($id && $id!=-1){//если пользователь авторизован
  if ($_POST['name']&&$_POST['description']&&$_POST['contract']&&$_POST['conditions']&&$_POST['num']){//если заданы данные отправки
    if ($_GET['id']){
        $allowed=array("name", "description", "contract", "conditions", "num");              
        $_POST['contract']= $_POST['contract']=="Да"?1:0;
        $sql = "UPDATE vacancies SET ".pdoSet($allowed,$values)." WHERE id = :id";
        $stmt = $pdo->prepare($sql);   
        $values["id"] = $_POST['id'];
        $stmt->execute($values);
    }
    else{
        $allowed=array("company", "name", "description", "contract", "conditions", "num");             
        $_POST['contract']= $_POST['contract']=="Да"?1:0;
        $sql = "INSERT INTO vacancies SET `company`=:company, ".pdoSet($allowed,$values);
        $stmt = $pdo->prepare($sql) or die(mysql_error());        
        $values["company"] = $id;  
        $stmt->execute($values);
    }
  }
  if ($_GET['id']){
    $sql="SELECT id
      FROM vacancies
      WHERE company=?";
      $stm = $pdo->prepare($sql);
      $stm->execute([$id]);
      $ides = $stm->fetchAll();
      $ids=array();
      foreach ($ides as $i => $id) {
          $ids[]=$id['id'];
      }
      if ($_SESSION['role']==0||in_array($_GET['id'], $ids)){//если он админ или у него есть эта вакансия
          $sql="SELECT *
            FROM vacancies
            WHERE id=?";
            $stm = $pdo->prepare($sql);
            $stm->execute([$_GET['id']]);
            $vacdt = $stm->fetch();//дать данные
      }
  }
}
function pdoSet($allowed, &$values, $source = array()) {
  $set = '';
  $values = array();
  if (!$source) $source = &$_POST;
  foreach ($allowed as $field) {
    if (isset($source[$field])) {
      $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
      $values[$field] = $source[$field];
    }
  }
  return substr($set, 0, -2); 
}
//надо чтоб он делал автовысоту при загрузке
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
  <script type="text/javascript">
  jQuery(function()
  {
    jQuery('textarea').autoResize({
     extraSpace :80
    });
  });
  function changethis(mykey){
    document.getElementById(mykey).onchange();
  }
</script>
  <body>
      <?php include ("menu.php");?>

            <div>
                <a class="accordion-title shade"><?if ($vacdt['num']) echo "Изменение " ; else echo 'Создание ';?> вакансии</a>
                <div class="regi" >
                    <form id="student" action="" method="post" data-abide style="display: block;">
                      <div data-abide-error class="alert callout" style="display: none;">
                        <p class="reg"><i class="fi-alert"></i> На этой странице присутствуют ошибки</p>
                      </div>
                      <div class="row" style="margin-top: 20px;">
                        <div class="small-12 columns" style="display:none">
                          <label class="reg">id</label>
                            <input style="font-size: 0.7rem;" name="id" class="in" type="text" value=<?echo $_GET['id']?>>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Наименование</label>
                            <input style="font-size: 0.7rem;" name="name" class="in" type="text" value="<?echo $vacdt['name']?>" required>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Описания деятельности студента на вакансии</label>
                            <textarea style="resize: none; overflow-y: hidden; position: absolute; top: 0px; left: -9999px; height: 70px; width: 400px; line-height: normal; text-decoration: none; letter-spacing: normal;" tabindex="-1"></textarea>
                            <textarea style="font-size: 0.7rem; resize:none; overflow-y: hidden;"   id="decriptiontext" onload='changethis(`decriptiontext`);' name="description" maxlength="2000" class="in" type="text" required><?echo $vacdt['description']?></textarea>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Договор с ДВФУ</label>
                            <select style="font-size: 0.7rem;" name="contract" class="in" required><option>Да</option><option>Нет</option></select>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Условие приема</label>
                            <textarea style="resize: none; overflow-y: hidden; position: absolute; top: 0px; left: -9999px; height: 70px; width: 400px; line-height: normal; text-decoration: none; letter-spacing: normal;" tabindex="-1"></textarea>
                            <textarea style="font-size: 0.7rem; resize:none; overflow-y: hidden;" name="conditions" maxlength="2000" class="in" type="text" required><?echo $vacdt['conditions']?></textarea>
                            <span class="form-error"></span>
                        </div>
                        <div class="small-12 columns">
                          <label class="reg">Количество мест для практики</label>
                            <input style="font-size: 0.7rem;" name="num" class="in" type="number" min="1" "value="<?echo $vacdt['num']?>" required>
                            <span class="form-error"></span>                   
                        </div>
                        <fieldset class="small-12 columns">
                          <button class="button float-right login shade" style="background-color: 269489; min-width:95px; width: 10%;" type="submit"><?if ($vacdt['num']) echo "Изменить" ; else echo 'Добавить';?></button>
                        </fieldset>
                      </div>
                    </form>
                </div>
            </div>
    </div>
    <?php include ("footer.php");?>
  </body>
</html>
