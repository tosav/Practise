<?
session_start();?>
<?php
require_once 'Classes/PHPExcel.php';
$phpexcel = new PHPExcel();
$page = $phpexcel->setActiveSheetIndex(0);
$id = $_SESSION['id'];
$grnname = $_GET['grnname'];
//$page->setCellValue("B2", "123");
$page->setCellValue("A1", "Группа");
$page->setCellValue("B1", $grnname);
$page->setCellValue("A2", "№");
$page->setCellValue("B2", "ФИО");
$page->setCellValue("C2", "Вакансия");
    $db = mysql_connect ("Practise","root","");
    mysql_select_db ("practice",$db);
$query = "SELECT * FROM `student` LEFT OUTER JOIN `group` ON student.`group`=group.id where group.number = '$grnname' ORDER BY student.fio";
$res = mysql_query( $query );

$i = 1;
while( $prd = mysql_fetch_assoc($res) ) {
    $page->setCellValue('A'.($i+2), $i);
    $page->setCellValue('B'.($i+2), $prd['fio']);
	$page->setCellValue('C'.($i+2), $prd['vacancy']);
    $i++;
}

$page->setTitle("Group");
$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
$objWriter->save("Group.xlsx");
header("Location: Group.xlsx");
?>