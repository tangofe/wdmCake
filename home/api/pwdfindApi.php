<?php 
include("../controller/User.class.php");
include("../model/Db.class.php");
//创建user对象，获取数据，对象定义在User.class.php 中
$db=new Db();
$u=new User($db);
//简单检验
$tab=$_GET['tab'];
// echo "<script>alert('".$tab."');</script>";
// exit;
if ($tab=='pwd') {
	$res=$u->findInfoCheck();
	if ($res) {
		echo "<script>alert('".$res['msg']."');window.location.href='../view/find_password.php?act=findPwd';</script>";
		exit;
	}

	$res=$u->selectFromUser();

	if($res['state']==116){
		echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
	}
	if($res['state']==117){
		echo "<script>window.location.href='../view/find_password.php?act=rePwd';</script>";
	}
	exit;
}
if ($tab=='re_pwd') {
	$res=$u->refindInfoCheck();
	if ($res) {
		echo "<script>alert('".$res['msg']."');window.location.href='../view/find_password.php?act=rePwd';</script>";
		exit;
	}
	$res=$u->updateIntoUser();
	//$u->userOut();//注销$_SESSION['Id']；	
	if($res['state']==118){
		echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
	}
	if($res['state']==119){
		echo "<script>alert('".$res['msg']."');window.location.href='../view/login_register_cake.php';</script>";
		$u->userOut();
	}
	exit;
}


?>