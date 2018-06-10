<?php
//header("content-type:text/html;charset=utf-8;");
// include(dirname(__DIR__).'/Common/Fpage.class.php');
require('../Model/Db.class.php');
require('../Controller/Category.class.php');
require('../Common/function.php');
$db=new Db();
$c=new Category($db,'goods_category');
if(isset($_GET['act'])){//保存分类
	//
    header("content-type:text/html;charset=utf-8;");
	$res=$c->checkForm();
	if($res){
		echo "<script>alert('{$res['msg']}');window.history.go(-1);</script>";//
		exit;
	}
	$res=$c->addCategory();
	if($res){
		echo "<script>alert('{$res['msg']}');window.history.go(-1);</script>";//
		exit;
	}
	
}else{//输出全部分类内容
	$rows=$c->getAllCategory();
	$rows=getTree($rows);
}

// echo "<pre>";
// print_r($db);
// echo "</pre>";