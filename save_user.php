<?php
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
    //������� ��������� ������������� ������ � ���������� $password, ���� �� ������, �� ���������� ����������
 if (empty($login) or empty($password)) //���� ������������ �� ���� ����� ��� ������, �� ������ ������ � ������������� ������
    {
    exit ("�� ����� �� ��� ����������, ��������� ����� � ��������� ��� ����!");
    }

 // ������������ � ����

    $db = mysql_connect ("Practise","root","");
    mysql_select_db ("practice",$db);

 // �������� �� ������������� ������������ � ����� �� �������
    $result = mysql_query("SELECT id FROM users WHERE login='$login'",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
    exit ("��������, �������� ���� ����� ��� ���������������. ������� ������ �����.");
    }
 // ���� ������ ���, �� ��������� ������

	$role = 2;
	$activate = 0; 
    $result2 = mysql_query ("INSERT INTO users (login,password,email,phone,role,activate) 
	VALUES('$login',md5('$password'),'$email','$phone','$role','$activate')");
	$res1 = mysql_query("SELECT id FROM `group` WHERE number='$group'");
	$res = mysql_result($res1, 0);

	$result3 = mysql_query ("INSERT INTO student (id, fio, num,`group`, `leader`)
	SELECT id, '$fullName', '$num', '$res', '2' FROM users WHERE login='$login'");
	//INSERT INTO student (id, fio, num, `group`, `leader`)
//SELECT id, 'lName', 'um', '1', '2' FROM users WHERE login='44'
    // ���������, ���� �� ������
    if ($result2=='TRUE' and $result3=='TRUE')
    {
		echo "�� ������� ����������������! �������� ������������� �� �������������� <a href='index.php'>������� ��������</a>";	
    }
 else {
    echo "������! �� �� ����������������.";
    }
    ?>