<?session_start();?>
<?php
require_once 'Classes/PHPExcel.php';
$phpexcel = new PHPExcel();
$page = $phpexcel->setActiveSheetIndex(0);
$id = $_SESSION['id'];
$grnname = $_GET['grnname'];
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
	$res1 = "";
	if ($prd['vacancy']<>""){
	$vac = $prd['vacancy'];
	$query2 =
	mysql_query("SELECT vacancies.name FROM vacancies LEFT OUTER JOIN student ON student.vacancy=vacancies.id where vacancies.id = '$vac'");
	$res1 = mysql_result($query2, 0); 
	$page->setCellValue('C'.($i+2), $res1);
    $i++;
}}
if ($i == 1) {
	header("Location: profile.php");
	exit;
}
$page->setTitle("Group");
$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
$objWriter->save("Group.xlsx");
header("Location: Group.xlsx");
?>