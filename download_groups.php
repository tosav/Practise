<?
session_start();?>
<?php
require_once 'Classes/PHPExcel.php';
$phpexcel = new PHPExcel();
$page = $phpexcel->setActiveSheetIndex(0);
$id = $_SESSION['id'];
//$page->setCellValue("B2", "123");
$page->setCellValue("A1", "№");
$page->setCellValue("B1", "ФИО");
$page->setCellValue("C1", "Группа");
$page->setCellValue("D1", "Вакансия");
    $db = mysql_connect ("Practise","root","");
    mysql_select_db ("practice",$db);
	
	$leadgroup1 = mysql_query("SELECT gropus FROM `leader` WHERE id='$id'");
	$leadgroup = mysql_result($leadgroup1, 0); 
	$stds = explode(";",$leadgroup);
	$i = 1;
    foreach($stds as $gr){     
    $query = "SELECT * FROM `student` LEFT OUTER JOIN `group` ON student.`group`=group.id where student.`group` = '$gr' ORDER BY student.`group`";
    $res = mysql_query( $query );
while( $prd = mysql_fetch_assoc($res) ) {
    $page->setCellValue('A'.($i+1), $i);
    $page->setCellValue('B'.($i+1), $prd['fio']);
    $page->setCellValue('C'.($i+1), $prd['number']);
	$res1 = "";
	if ($prd['vacancy']<>""){
	$vac = $prd['vacancy'];
	$query2 =
	mysql_query("SELECT vacancies.name FROM vacancies LEFT OUTER JOIN student ON student.vacancy=vacancies.id where vacancies.id = '$vac'");
	$res1 = mysql_result($query2, 0);} 
	$page->setCellValue('D'.($i+1), $res1);
    $i++;
	}}
$page->setTitle("Groups");
$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
$objWriter->save("Groups.xlsx");
header("Location: Groups.xlsx");
?>