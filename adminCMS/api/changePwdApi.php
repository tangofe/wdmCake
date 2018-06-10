<?php 
include("../controller/User.class.php");
include("../model/Db.class.php");
//创建user对象，获取数据，对象定义在User.class.php 中
$db=new Db();
$u=new User($db);
//简单检验


$res=$u->changePwdIntoCheck();
if ($res) {
	echo "<script>alert('".$res['msg']."');window.location.href='../view/myCenter.php?id=6';</script>";
	exit;
}

$res=$u->changePwdIntoUser();

if($res['state']==118){
	echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
}
if($res['state']==119){
	echo "<script>alert('".$res['msg']."');window.location.href='../view/myCenter.php?id=0';</script>";
}
exit;




?>