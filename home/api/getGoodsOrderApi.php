<?php  
header("content-type:text/html;charset=utf8;");
include("../model/Db.class.php");
include('../controller/OrderForm.class.php');
$db=new Db();
$res=new OrderForm($db);
if (isset($_GET['act'])) {
	if ($_GET['act']=='delete') {
		$rows=$res->deleteFormOrder();
		if ($rows==1) {
			echo '<script>alert("删除成功");window.history.go(-1);</script>'; 
		}else{
			echo '<script>alert("数据库繁忙，请稍后再试");window.history.go(-1);</script>'; 
		}
	}
}else{
	$rows=$res->getOrderMessage();
}
// echo "<pre>";
// print_r($rows);
// echo "<pre>";
?>