<?php
//include(dirname(__DIR__).'/Common/Fpage.class.php');
require('../Model/Db.class.php');
require('../Controller/Category.class.php');
require('../Common/function.php');
$db=new Db();
$m=new Category($db,'goods_category',2,4);

if(isset($_GET['act'])){
    header("content-type:text/html;charset=utf-8;");
	//echo "删除栏目";
	$res=$m->deleteMenuById();
	if($res){
		if($res['code']==116){
			echo "<script>alert('".$res['msg']."');window.location.href='../View/editLanmu.php'</script>";
		}else{
			echo "<script>alert('".$res['msg']."');window.history.go(-1)</script>";
		}
		
	}
}else{
	//echo "取全部栏目内容";
	$m->init();
	$rows=$m->getCntByPage();
	$link=$m->makeNumLinks();
}

//print_r($rows);