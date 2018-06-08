<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/10
 * Time: 8:50
 */
header("content-type:text/html;charset=utf-8;");
require('../Model/Db.class.php');
require('../Controller/Articles.class.php');

$db = new Db();
$a = new Articles($db);

$res = $a->saveArticle();
if ($res) {
    echo "<script>alert('{$res['msg']}');window.history.go(-1)</script>";//
    exit;
}
