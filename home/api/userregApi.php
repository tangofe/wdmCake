<?php 
include("../controller/User.class.php");
include("../model/Db.class.php");
//创建user对象，获取数据，对象定义在User.class.php 中
$db=new Db();
$u=new User($db);
//简单检验
$res=$u->regInfoCheck();
if ($res) {
	echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
	exit;
}
//更新数据并返回结果
$res=$u->userReg();
//添加失败的处理方法
if($res['state']==107){
	echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
}
//添加成功的处理方法
if($res['state']==108){
	echo "<script>alert('".$res['msg']."');window.location.href='../view/login_register_cake.php';</script>";
}

?>