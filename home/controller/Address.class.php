<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/11
 * Time: 10:32
 */
class Address {
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function getAddress() {
        $id = $_GET['id'];
        if ($id=='') {
            return array();
            exit;
        }
        $sql = "select * from address where fid={$id}";
        $res = $this->db->selectRows($sql);
        if ($res) {
            return $res;
        }
    }
}