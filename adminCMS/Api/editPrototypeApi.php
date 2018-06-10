<?php
//header("content-type:text/html;charset=utf-8;");
// include(dirname(__DIR__).'/Common/Fpage.class.php');
require('../Model/Db.class.php');
require('../Controller/Prototype.class.php');
require('../Common/function.php');
$db=new Db();
$p=new Prototype($db,'goods_prototype');
if(isset($_GET['act'])){
	$act=$_GET['act'];
	//
	// $res=$p->checkForm();
	// if($res){
	// 	echo "<script>alert('{$res['msg']}');window.history.go(-1);</script>";//
	// 	exit;
	// }
	// $res=$p->addPrototype();
	// if($res){
	// 	echo "<script>alert('{$res['msg']}');window.history.go(-1);</script>";//
	// 	exit;
	// }
	//删除指定id的属性
	if($act=="delPrototype"){
		//echo "ok";
		$res=$p->delPrototype();
		echo json_encode($res);
	}
	//编辑属性
	if($act=="editPrototype"){
		// echo "<pre>";
		// print_r($_POST);
		$res=$p->upPrototype();
		if($res){
			echo "<script>alert('{$res['msg']}');window.history.go(-1);</script>";//
			exit;
		}
	}
	
}else{//输出全部分类内容
	$rows=$p->getAllCategory();
	$rows=getTree($rows);
}

// echo "<pre>";
// print_r($db);
// echo "</pre>";