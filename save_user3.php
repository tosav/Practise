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
    $description = $_POST['description'];
	$inn = $_POST['inn'];
	$contract = $_POST['contract'];
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
	$role = 3;
	$activate = 0; 
    $result2 = mysql_query ("INSERT INTO users (login,password,email,phone,role,activate) 
	VALUES('$login',md5('$password'),'$email','$phone','$role','$activate')");
	$result3 = mysql_query ("INSERT INTO company (id, inn, name, description, contract)
	SELECT id, '$inn','$fullName','$description','$contract' FROM users WHERE login='$login'");
    // ���������, ���� �� ������
    if ($result2=='TRUE' and $result3=='TRUE')
    {
		echo "�� ������� ����������������! �������� ������������� �� �������������� <a href='index.php'>������� ��������</a>";		
    }
 else {
    echo "������! �� �� ����������������.";
    }
    ?>