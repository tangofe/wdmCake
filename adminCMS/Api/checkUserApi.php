<?php
session_start();
header("content-type:text/html;charset=utf-8;");
include(dirname(__DIR__).'/Common/Fpage.class.php');
include('../Model/Db.class.php');
include('../Controller/User.class.php');
if(isset($_GET['act'])){
	$db=new Db();
	$u=new User($db,'user');
	if($_GET['act']=='login'){		
		$res=$u->loginUser();
		if($res){
			if($res['code']=='u004'){//用户成功登录，实现跳转
				echo "<script>window.location.href='../View/addCategory.v.php?lid=1'</script>";
			}else{
				echo "<script>alert('".$res['msg']."');window.history.go(-1)</script>";
			}			
		}
	}
	// if($_GET['act']=='reg'){
	// 	echo "用户注册";
	// }
	if($_GET['act']=='out'){
		//echo "安全退出";
		$res=$u->userSafeOut();
		if($res){
			echo "<script>alert('".$res['msg']."');window.location.href='../View/login.php'</script>";
		}
	}


	if($_GET['act']=='addUser'){
		//echo "添加用户";
		$res=$u->addUser();		
		if($res){echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";}
	}
	if($_GET['act']=='getAllUser'){//ajax返回
		//echo "取全部用户信息";
		$res=$u->getAllUser();	
		//print_r($res);
		echo json_encode($res);
	}

	if($_GET['act']=='getInfoById'){
		//echo "取单个用户信息";
		$res=$u->getInfoById();
		//print_r($res);
		echo json_encode($res);
	}
	if($_GET['act']=='deleteUser'){
		//echo "删除用户信息";
		//print_r($_GET);
		$res=$u->deleteUser();
		if($res){echo "<script>alert('".$res['msg']."');window.location.href='../View/upUser.php';</script>";}
	}
	//更新用户信息
	if($_GET['act']=='updateUser'){
		/*echo "更新用户信息";
		print_r($_POST);*/
		$res=$u->updateUser();
		if($res){echo "<script>alert('".$res['msg']."');window.location.href='../View/upUser.php';</script>";}
	}

}




/*echo $_SESSION['code'];
print_r($_POST);
//Array ( [name] => phpcms [pwd] => phpcms [code] => aswe 
if(strtolower($_POST['code'])== strtolower($_SESSION['code'])){
	echo "验证通过!";
}else{
	echo "验证失败!";
}*/