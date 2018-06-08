<?php
/*header("content-type:text/html;charset=utf-8;");*/
// include(dirname(__DIR__).'/Common/Fpage.class.php');
require('../Model/Db.class.php');
require('../Controller/Prototype.class.php');
require('../Common/function.php');
$db=new Db();
$p=new Prototype($db,'goods_prototype');
if(isset($_GET['act'])){//保存分类
	//
	$res=$p->checkForm();
	if($res){
        header("content-type:text/html;charset=utf-8;");
		echo "<script>alert('{$res['msg']}');window.history.go(-1);</script>";//
		exit;
	}
	$res=$p->addPrototype();
	if($res){
        header("content-type:text/html;charset=utf-8;");
		echo "<script>alert('{$res['msg']}');window.history.go(-1);</script>";//
		exit;
	}
	
}else{//输出全部分类内容
	$rows=$p->getAllCategory();
	$rows=getTree($rows);
}

// echo "<pre>";
// print_r($db);
// echo "</pre>";