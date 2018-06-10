<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/9
 * Time: 16:09
 */
require ('../model/Db.class.php');
require ('../controller/Article.class.php');

$db = new Db();
$a = new Article($db);

$res = $a->getArticle();