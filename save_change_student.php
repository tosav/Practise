<?php
   session_start();
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //������� ��������� ������������� ����� � ���������� $login, ���� �� ������, �� ���������� ����������
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
	$checkPassword = $_POST['checkPassword'];
	if ($password != $checkPassword)
	{
		exit ("������ �� ���������");
	}
	$fullName = $_POST['fullName'];
	$email = $_POST['email'];
	$group = $_POST['group'];
	$phone = $_POST['phone'];
	$num = $_POST['num'];

 if (empty($login) or empty($password)) //���� ������������ �� ���� ����� ��� ������, �� ������ ������ � ������������� ������
    {
    exit ("�� ����� �� ��� ����������, ��������� ����� � ��������� ��� ����!");
    }

	$db = mysql_connect ("Practise","root","");
    mysql_select_db ("practice",$db);

 // ���� ������ ���, �� ��������� ������
    $id = $_SESSION['id'];
    $result2 = mysql_query ("UPDATE users  SET login='$login', password='$password' ,email='$email', phone='$phone' 
	WHERE id='$id'");
	$res1 = mysql_query("SELECT id FROM `group` WHERE number='$group'");
	$res = mysql_result($res1, 0);

	$result3 = mysql_query ("UPDATE student
	SET fio = '$fullName', num = '$num', `group` = '$res' WHERE id='$id'");
	//INSERT INTO student (id, fio, num, `group`, `leader`)
//SELECT id, 'lName', 'um', '1', '2' FROM users WHERE login='44'
    // ���������, ���� �� ������
    if ($result2=='TRUE' and $result3=='TRUE')
    {
		echo "��������� ��������� <a href='index.php'>������� ��������</a>";
		$_SESSION['login'] = $login;	
		$_SESSION['password'] = $password;		
    }
 else {
    echo "������!";
    }
    ?>