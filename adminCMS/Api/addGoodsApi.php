<?php
/*header("content-type:text/html;charset=utf-8;");*/
// include(dirname(__DIR__).'/Common/Fpage.class.php');
require('../Model/Db.class.php');
require('../Controller/Goods.class.php');
require('../Common/function.php');
$db=new Db();
$g=new Goods($db,'goods_list');

if(isset($_GET['act'])){
	$act=$_GET['act'];
	if($act=='addGoods'){
		// echo "<pre>";
		// print_r($_POST);
		$res=$g->checkForm();
		if($res){
			echo "<script>alert('{$res['msg']}');window.history.go(-1);</script>";//
			exit;
		}
		$res=$g->addGoods();
		if($res){
			echo "<script>alert('{$res['msg']}');window.history.go(-1);</script>";//
			exit;
		} 
	}
	
}else{//输出全部分类内容
	$rows=$g->getAllCategory();

	$rows=getTree($rows);
	
	// echo "<pre>";
	// print_r($rows);
}

// echo "<pre>";
// print_r($db);
// echo "</pre>";