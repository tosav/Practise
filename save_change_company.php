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
	$phone = $_POST['phone'];
	$inn = $_POST['inn'];
	$description = $_POST['description'];
	$contract = $_POST['contract'];
    $id = $_POST['id'];
 if (empty($login) or empty($password)) //���� ������������ �� ���� ����� ��� ������, �� ������ ������ � ������������� ������
    {
    exit ("�� ����� �� ��� ����������, ��������� ����� � ��������� ��� ����!");
    }

	$db = mysql_connect ("Practise","root","");
    mysql_select_db ("practice",$db);

 // ���� ������ ���, �� ��������� ������
	
    $result2 = mysql_query ("UPDATE users  SET login='$login', password=md5('$password') ,email='$email', phone='$phone' 
	WHERE id='$id'");


	$result3 = mysql_query ("UPDATE company
	SET name = '$fullName', inn = '$inn', description = '$description', contract = '$contract' WHERE id='$id'");

    // ���������, ���� �� ������
    if ($result2 and $result3)
    {
		if ($_SESSION['id'] == $id){
		$_SESSION['login'] = $login;	
		$_SESSION['password'] = md5($password);}
		header("Location: reg.php?id=$id");
    }
 else {
    echo "������!";
    }
    ?>