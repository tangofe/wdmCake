<?php
/*header("content-type:text/html;charset=utf-8;");*/
//include(dirname(__DIR__).'/Common/Fpage.class.php');
require('../Model/Db.class.php');
require('../Controller/Order.class.php');
require('../Common/function.php');
$db=new Db();
$o=new Order($db,'goods_order',2,4);

if(isset($_GET['act'])){
    header("content-type:text/html;charset=utf-8;");
	//echo "ok";
	//订单明细
	if($_GET['act']=="orderDetail"){
		$rows=$o->orderDetail();
	}
	
	// echo "<pre>";
	// print_r($rows);
	// echo "</pre>";
	// 更新订单状态
	if($_GET['act']=="changeStatus"){
		$res=$o->changeStatus();
		echo json_encode($res);
		//echo "ok";
	}
	
}else{
	//echo "取全部订单内容";
	$o->init();
	$rows=$o->getCntByPage();
	$link=$o->makeNumLinks();
}

//print_r($rows);