<?php 
include("../controller/User.class.php");
include("../model/Db.class.php");
//创建user对象，获取数据，对象定义在User.class.php 中
$db=new Db();
$u=new User($db);
//简单检验
$res=$u->userOut();
if ($res) {
	echo "<script>window.location.href='../view/indexcake.php';</script>";
	exit;
}
?>