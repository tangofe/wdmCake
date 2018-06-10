<?php
header("content-type:text/html;charset=utf-8;");
// include(dirname(__DIR__).'/Common/Fpage.class.php');
require('../Model/Db.class.php');
require('../Controller/Prototype.class.php');
require('../Common/function.php');
$db=new Db();
$p=new Prototype($db,'goods_prototype');
if(isset($_GET['act'])){//根据分类id取其属性
	
	$rows=$p->getPrototype();
	echo json_encode($rows);
	
}