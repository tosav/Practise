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

	$phone = $_POST['phone'];

	$gropus = $_POST['gropus'];
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

	$role = 1;
	$activate = 0; 
    $result2 = mysql_query ("INSERT INTO users (login,password,email,phone,role,activate) 
	VALUES('$login',md5('$password'),'$email','$phone','$role','$activate')");
	$result3 = mysql_query ("INSERT INTO leader (id, fio, gropus) SELECT id, '$fullName', '$gropus'  FROM users WHERE login='$login'");
    // ���������, ���� �� ������
    if ($result2=='TRUE')
    {
		echo "�� ������� ����������������! �������� ������������� �� �������������� <a href='index.php'>������� ��������</a>";	
    }
 else {
    echo "������! �� �� ����������������.";
    }
    ?>