<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/16
 * Time: 14:51
 */
if (!isset($_SESSION)) {
    session_start();
}
require ('../model/Db.class.php');
require ('../controller/OrderForm.class.php');

$db = new Db();
$o = new OrderForm($db);

if (isset($_GET['act'])) {
    if ($_GET['act']=='goodwish') {
        $o->addGoodWish();
        //echo json_encode($res);
        exit;
    }
    if ($_GET['act']=='wishPerson') {
        $o->addWishPerson();
        //echo json_encode($res);
        exit;
    }
}
$res = $o->upOrderForm();
if ($res['code'] == 200) {
   // echo "<script>alert('" . $res['msg'] . "'); window.location.href='../view/indexcake.php'</script>";
    echo "<script>alert('" . $res['msg'] . "');window.location.href='../view/indexcake.php'</script>";
} else{
    echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
}
