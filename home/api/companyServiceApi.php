<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/10
 * Time: 20:19
 */
require ('../model/Db.class.php');
require ('../controller/Company.class.php');

$db = new Db();
$c = new Company($db);
$res = $c->saveCompanyService();
if ($res) {
    echo "<script>alert('".$res['msg']."');window.history.go(-1);</script>";
}