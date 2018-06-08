<?php
header('content-type:text/html;charset=utf-8;');
///include(dirname(__DIR__).'/Common/Fpage.class.php');
include('../Model/Db.class.php');
include('../Controller/Role.class.php');
$db=new Db();
$r=new Role($db,'role');
$act=$_GET['act'];//get提交
if($act=='checkRole'){//检测角色
	$name=$_GET['roleName'];
	//echo $name.'ok';
	$res= $r->checkRole();//ajax返回
	//print_r($res);
	//array('code'=>'u008','msg'=>'角色已经存在！');
	echo json_encode($res);//php数组转换成json对象
}
if($act=='addrole'){//添加角色,非ajax返回
	//echo "添加角色";
	$res=$r->addRole();
	//$res=array('code'=>'u010','msg'=>'添加角色成功！');
	//echo "<script>alert('".$res['msg']."');window.history.go(-1)</script>";
	echo "<script>alert('".$res['msg']."');window.location.href='../View/upRole.php?lid=5';</script>";
	
}

if($act=='getAllRoles'){//取全部角色
	//echo "取全部角色";
	//array('code'=>'u011','msg'=>'取全部角色失败！','resultData'=>'');
	$res=$r->getAllRoles();//ajax返回
	echo json_encode($res);
}
if($act=='getCntById'){//根据传递的id 值取相关信息
	//echo $_GET['id'];
	//array('code'=>'u011','msg'=>'取全部角色失败！','resultData'=>'');
	$res=$r->getCntById();//ajax返回
	echo json_encode($res);
}
if($act=='upRole'){//更新角色信息,ajax返回
	//echo $_GET['id'].$_GET['role'];
	//array('code'=>'u011','msg'=>'取全部角色失败！','resultData'=>'');
	$res=$r->upRole();//ajax返回
	echo json_encode($res);
}
if($act=='deleteRole'){//删除角色信息
	//echo $_GET['id'];
	$res=$r->deleteRole();
	echo "header('content-type:text/html;charset=utf-8;')<script>alert('".$res['msg']."');window.location.href='../View/upRole.php?lid=5'</script>";
}

