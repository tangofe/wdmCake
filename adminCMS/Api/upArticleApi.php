<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/10
 * Time: 11:41
 */
header("content-type:text/html;charset=utf-8;");
require('../Model/Db.class.php');
require('../Controller/Articles.class.php');

$db = new Db();
$a = new Articles($db);
$res = $a->upArticle();
echo "<script>alert('{$res['msg']}');window.history.go(-1);</script>";
exit;