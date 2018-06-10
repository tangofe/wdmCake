<?php
if (!isset($_SESSION)) {
    session_start();
}
//session_start();
header("content-type:text/html;charset=utf-8;");
require ('../model/Db.class.php');
require ('../controller/GetMessage.class.php');
require ('../controller/OrderForm.class.php');



$db = new Db;
$g = new GetMessage($db);
//print_r($_SESSION);
$o = new OrderForm($db);

if (isset($_SESSION)) {
    $rows = $g->getMessage();
    $goodMsg = $o->getCarGoodBySession();
    //$g->getMessage();
}
//print_r($_GET); 可以获取
if (isset($_GET['act'])) {
   if($_GET['act']=='upGetMsg') {
       $res = $g->upMessage();
      // $g->upMessage();
           echo json_encode($res);
       exit;
   }
   if ($_GET['act']=='editGetMsg') {
       $res = $g->editMessage();
       echo json_encode($res);
       exit;
   }
   if ($_GET['act']=='delGetMsg') {
       $res = $g->delMessage();
       echo json_encode($res);
       exit;
   }
}

//print_r('go wrong!');