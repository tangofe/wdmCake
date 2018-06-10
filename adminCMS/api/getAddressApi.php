<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/11
 * Time: 10:26
 */
require ('../model/Db.class.php');
require ('../controller/Address.class.php');

$db = new Db;
$a = new Address($db);
$res = $a->getAddress();
echo json_encode($res);
