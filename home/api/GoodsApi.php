<?php 
session_start();
header("content-type:text/html;charset=utf-8;");
include("../model/Db.class.php");
include("../controller/Goods.class.php");
include("../controller/Category.class.php");
$db=new Db();
$g=new Goods($db);
$c=new Category($db);
if (isset($_GET['act'])) {
	if($_GET['act']=='add_order_history'){
		$res=$g->add_order_history();
		$row=$res[0]['img'];
		$ret=htmlspecialchars_decode($row);
		$res[0]['img']=$ret;
		$row=json_encode($res);
		//$obj=$row['img'];
		echo $row;
		exit;
	}
	if($_GET['act']=='likenum_add') {
		$res=$g->addLikeNumToGoods();
		echo json_encode($res);
		exit;
	}
	if($_GET['act']=='getCategoryAllGoods') {
		$res=$g->getCategoryAllGoods();
		echo json_encode($res);
		//print_r($res);
		exit;
	}
	if($_GET['act']=="getCategoryGoods"){
		$res=$g->getCategoryGoodsByCid();
		// if(isset($res[0]['img'])&&($res[0]['img']!="")){
		// 	$row=$res[0]['img'];
		// 	$a=htmlspecialchars_decode($row);
		// 	preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
		// 	$res[0]['img']=$match[1][0];
		// }
		
		// echo json_encode($res);//转换为json格式
		// exit;
		}
}else{

}
	$rows=$g->getAllgoods();
	$rets=$c->getAllCategory();
	// $rets=$g->getCategoryGoodsByid

 ?>
