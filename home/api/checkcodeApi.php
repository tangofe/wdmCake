<?php  
session_start();
$res="check_no";
if(strtoupper($_GET['code'])==strtoupper($_SESSION['code'])){
	exit;
}
echo $res;
?>