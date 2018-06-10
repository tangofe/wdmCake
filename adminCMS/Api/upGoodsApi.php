<?php

// include(dirname(__DIR__).'/Common/Fpage.class.php');
require('../Model/Db.class.php');
require('../Controller/Goods.class.php');
require('../Common/function.php');
$db=new Db();
$g=new Goods($db,'goods_list');

if(isset($_GET['act'])){
	//输出全部分类内容
	$rows=$g->getAllCategory();
	$categorys=getTree($rows);
	$act=$_GET['act'];
	if($act=='getGoodsInfo'){
		
		$goodInfo=$g->getGoodsById();
		// echo "<pre>";
		// print_r($goodInfo);
		// echo "</pre>";
	}
	if($act=='upGoodsInfo'){
        header("content-type:text/html;charset=utf-8;");
		$res=$g->upGoods();
		echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
		// echo "<pre>";
		// print_r($res);
		// echo "</pre>";
	}
	if($_GET['act']=='deleteGoods'){
        header("content-type:text/html;charset=utf-8;");
		$res=$g->deleteGoods();
		if($res){
			echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
		}
		//print_r($res);
	}
	
}