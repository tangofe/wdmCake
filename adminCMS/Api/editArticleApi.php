<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/10
 * Time: 10:08
 */

require('../Model/Db.class.php');
require('../Controller/Articles.class.php');
$db = new Db;
$a = new Articles($db);
if (isset($_GET['act'])) {
    if ($_GET['act']=='editArticle') {
        $row  = $a->selectArticle();
    }
    if ($_GET['act']=='deleteArticle') {
        header("content-type:text/html;charset=utf-8;");
        $row = $a->deleteArticle();
        if ($row) {
            echo "<script>alert('{$row['msg']}');window.history.go(-1);</script>";//
            exit;
        }
    }

}else {
    $rows = $a->selectAllArticle();
}