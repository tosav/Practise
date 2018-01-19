<?php
   session_start();
    $login = $_POST['login'];
    $password=$_POST['password'];
	
	$fullName = $_POST['fullName'];
	$email = $_POST['email'];

	$phone = $_POST['phone'];

	$gropus = $_POST['gropus'];
    $id = $_POST['id'];
    $checkPassword = $_POST['checkPassword'];
	if ($password != $checkPassword)
	{
		exit ("Пароли не совпадают <a href='reg.php?id=$id'>Вернуться</a>");
	}
 if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }

	$db = mysql_connect ("Practise","root","");
    mysql_select_db ("practice",$db);

 // если такого нет, то сохраняем данные
	$stds=explode(" ",$gropus);
    foreach($stds as $gr){

	$sql11=mysql_query("SELECT `group`.id FROM `group` WHERE number='$gr'");

                $group = mysql_result($sql11, 0);

                $gropus1 = "$gropus1" . "$group" . ";";	
	}
	$gropus1 = substr($gropus1, 0, -1);
	
    $result2 = mysql_query ("UPDATE users  SET login='$login', password=md5('$password'), email='$email', phone='$phone' 
	WHERE id='$id'");


	$result3 = mysql_query ("UPDATE leader
	SET fio = '$fullName', `gropus` = '$gropus1' WHERE id='$id'");
	//INSERT INTO student (id, fio, num, `group`, `leader`)
//SELECT id, 'lName', 'um', '1', '2' FROM users WHERE login='44'
    // Проверяем, есть ли ошибки
    if ($result2 and $result3)
    {
		if ($_SESSION['id'] == $id){
		$_SESSION['login'] = $login;	
		$_SESSION['password'] = md5($password);}
		header("Location: reg.php?id=$id");
    }
 else {
    echo "Ошибка!";
    }
    ?>