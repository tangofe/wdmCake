<?php
// include(dirname(__DIR__).'/Common/Fpage.class.php');
require('../Model/Db.class.php');
require('../Controller/Category.class.php');
require('../Common/function.php');
$db=new Db();
$c=new Category($db,'goods_category');

if(isset($_GET['act'])){
	//输出全部分类内容
	$rows=$c->getAllCategory();
	$rows=getTree($rows);
	//根据id、pid获取分类内容
	if($_GET['act']=='getCategory'){
		$row=$c->getCategoryById();
	}
	//更新分类内容
	if($_GET['act']=='upCategory'){
        header("content-type:text/html;charset=utf-8;");
		$res=$c->upCategory();
		if($res['code']==106){//分类名为空
			echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
		}else{
			echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
		}
		//print_r($res);
	}
	//删除分类
	if($_GET['act']=='deleteCategory'){
        header("content-type:text/html;charset=utf-8;");
		$res=$c->deleteCategory();
		if($res){
			echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
		}
		//print_r($res);
	}
}