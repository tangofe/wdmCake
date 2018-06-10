<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/9
 * Time: 16:04
 */
class Article {
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }

    public function getArticle() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $sql = "select * from article where id = {$id}";
        $res = $this->db->selectRow($sql);
        if ($res) {
            return $res;
        }
    }
}