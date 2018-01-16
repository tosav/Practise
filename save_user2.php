<?php
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
	$checkPassword = $_POST['checkPassword'];
	if ($password != $checkPassword)
	{
		exit ("Пароли не совпадают");
	}
	$fullName = $_POST['fullName'];
	$email = $_POST['email'];

	$phone = $_POST['phone'];

	$gropus = $_POST['gropus'];
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }

 // подключаемся к базе

    $db = mysql_connect ("Practise","root","");
    mysql_select_db ("practice",$db);

 // проверка на существование пользователя с таким же логином
    $result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
 // если такого нет, то сохраняем данные

	$role = 1;
	$activate = 0; 
	$stds=explode(" ",$gropus);
    foreach($stds as $gr){

	$sql11=mysql_query("SELECT `group`.id FROM `group` WHERE number='$gr'");

                $group = mysql_result($sql11, 0);

                $gropus1 = "$gropus1" . "$group" . ";";	
	}
	$gropus1 = substr($gropus1, 0, -1);
    $result2 = mysql_query ("INSERT INTO users (login,password,email,phone,role,activate) 
	VALUES('$login',md5('$password'),'$email','$phone','$role','$activate')");
	$result3 = mysql_query ("INSERT INTO leader (id, fio, gropus) SELECT id, '$fullName', '$gropus1'  FROM users WHERE login='$login'");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE' and $result3=='True')
    {
		echo "Вы успешно зарегистрированы! Ожидайте подтверждения от администратора <a href='index.php'>Главная страница</a>";	
    }
 else {
    echo "Ошибка! Вы не зарегистрированы.";
    }
    ?>