<?php 
header("content-type:text/html;charset=utf-8;");
include("../model/Db.class.php");
include("../controller/ShopCar.class.php");
$db=new Db();
$s=new ShopCar($db);

$res=$s->checkUserInfo();

if($res['code']==100){//用户未登录
	echo json_encode($res);
	exit;
}

if(isset($_GET['act'])){
	//添加商品到购物车数据表
	if($_GET['act']=='addGoodsToShopCar'){
		$res=$s->addGoodsToShopCar();
		echo json_encode($res);
		exit;
	}
	if($_GET['act']=='addGoodsToShopCar1'){
		$res=$s->addGoodsToShopCar1();
		echo json_encode($res);
		exit;
	}
	//初始化购物车，从购物车数据表中取当前用户的购物记录
	if($_GET['act']=='initShopCar'){
		$res=$s->initShopCar();
		echo json_encode($res);
		exit;
	}
	//更改购物车中的商品数量（通过购物车的加减按钮实现）
	if ($_GET['act']=='changeNum'){
		$res=$s->changeNum();
		echo json_encode($res);
		exit;
	}
	//删除购物车中的商品
	if ($_GET['act']=='delgoods'){
		$res=$s->delgoods();
		echo json_encode($res);
		exit;
	}
	//提交订单
	if($_GET['act']=='pushOrder'){
		$res=$s->pushOrder();
		echo "<script>alert('".$res['msg']."');window.location.href='../view/index.v.php';</script>";
	}
	if ($_GET['act']=='getShopcarnum'){
		$res=$s->initShopCar();
		echo json_encode($res);
		exit;
	}
}
 ?>