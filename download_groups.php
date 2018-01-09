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
$query = "SELECT * FROM `student` LEFT OUTER JOIN `group` ON student.`group`=group.id where student.leader = '$id' ORDER BY student.`group`";
$res = mysql_query( $query );

$i = 1;
while( $prd = mysql_fetch_assoc($res) ) {
    $page->setCellValue('A'.($i+1), $i);
    $page->setCellValue('B'.($i+1), $prd['fio']);
    $page->setCellValue('C'.($i+1), $prd['number']);
	$page->setCellValue('D'.($i+1), $prd['vacancy']);
    $i++;
}

$page->setTitle("Groups");
$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
$objWriter->save("Groups.xlsx");
header("Location: Groups.xlsx");
?>