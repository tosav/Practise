<?php
   session_start();
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
    $id = $_POST['id'];
 if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }

	$db = mysql_connect ("Practise","root","");
    mysql_select_db ("practice",$db);

 // если такого нет, то сохраняем данные
	
    $result2 = mysql_query ("UPDATE users  SET login='$login', password='$password' ,email='$email', phone='$phone' 
	WHERE id='$id'");


	$result3 = mysql_query ("UPDATE leader
	SET fio = '$fullName', `gropus` = '$gropus' WHERE id='$id'");
	//INSERT INTO student (id, fio, num, `group`, `leader`)
//SELECT id, 'lName', 'um', '1', '2' FROM users WHERE login='44'
    // Проверяем, есть ли ошибки
    if ($result2 and $result3)
    {
		echo "Изменения сохранены <a href='index.php'>Главная страница</a>";
		$_SESSION['login'] = $login;	
		$_SESSION['password'] = $password;
    }
 else {
    echo "Ошибка!";
    }
    ?>