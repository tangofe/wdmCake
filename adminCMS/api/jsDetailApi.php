<?php  
header("content-type:text/html;charset=utf8;");
include("../model/Db.class.php");
include("../controller/Goods.class.php");
include("../controller/Category.class.php");
$db=new Db();
$good=new Goods($db);
$c=new Category($db);
$rows=$good->getGoodsDetailById();
$rets=$c->getAllCategory();
// echo "<pre>";
// print_r($rows);
// echo "<pre>";
?>