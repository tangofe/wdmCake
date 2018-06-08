<?php
	session_start();
	include("../model/Db.class.php");
	include("../controller/Category.class.php");
	$db = new Db();
	$c=new Category($db);
	$act=$_GET['act'];
	//取全部一级分类
	// if($act=="getAllCategory"){
	// 	$rows=$c->getAllCategory();
	// 	echo json_encode($rows);//转换为json格式
	// }
	//根据父类id，取其子分类
	if($act){
		if($act=="getCategory"){
			$rows=$c->getCategory();
			echo json_encode($rows);//转换为json格式
		}
		//根据分类id，查找content
		if($act=="detail_tip"){
			$rows=$c->getContent();
			echo json_encode($rows);//转换为json格式
		}
		if($act=="getGoodsLocation"){
			$rows=$c->getGoodsLocation();
			echo json_encode($rows);//转换为json格式
		}
	}else{
		// $rets=$c->getAllCategory();
	}
?>