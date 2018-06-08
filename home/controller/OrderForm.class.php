<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/16
 * Time: 14:51
 */
class OrderForm {
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function upOrderForm() {

        if (!isset($_POST['address'])||empty($_POST['address'])) { return array('msg'=>'未添加或未选择收货信息！','code'=>400,'data'=>''); exit;}
        if (!isset($_POST['goodsid'])||empty($_POST['goodsid'])) { return array('msg'=>'商品清单为空！','code'=>400,'data'=>'');exit; }
        if (!isset($_POST['date'])||empty($_POST['date'])) { return array('msg'=>'送货日期不能为空！','code'=>400,'data'=>''); exit;}
        if (!isset($_POST['time'])||empty($_POST['time'])) { return array('msg'=>'送货时间不能为空！','code'=>400,'data'=>'');exit; }
        $uid = $_SESSION['uid'];
        $msg_id = $_POST['address']; //地址id;
        $kuaidi = $_POST['kuaidi'];
        $date = $_POST['date'];
        $hour = $_POST['time'];
        $pay_style = $_POST['payStyle'];
        if (isset($_POST['intStyle'])) {
            $int_style = $_POST['intStyle'];
        }else {
            $int_style ='';
        }
        $invoice = $_POST['invoice'];
        $other_msg = $_POST['otherMsg'];
        $post_time = $date.' '.$hour;
        $goodsid = $_POST['goodsid'];
        $time = time();
        $orderid = uniqid().rand(10000,99999);
        $all = $_POST['all'];
        // print_r($post_time);
        //print_r($goodsid);
        $n = 0;
        $res = array('msg'=>'商品订购支付失败！','code'=>400,'data'=>'');

        foreach ($goodsid as $goodid) {
           // print_r($goodid);
            $sql = "update goods_shopcar set status='2', orderid='{$orderid}', time='{$time}' where goodid='{$goodid}' and uid='{$uid}' and status='1'";
            if ($this->db->otherData($sql)) {
                $n++;
            }
        }
        print_r($pay_style);

        if (!$pay_style) {
            $pay_sty = $int_style;
        } else {
            $pay_sty = $pay_style;
        }
        $sql = "insert into goods_order(uid,orderid,money,order_status,pay_status,time,post_time,other_msg,post_style,invoice,msg_id,pay_style) 
values('{$uid}','{$orderid}','{$all}','2','2','{$time}','{$post_time}','{$other_msg}','{$kuaidi}','{$invoice}','{$msg_id}','{$pay_sty}')";
        $n=0;
        if ($this->db->otherData($sql)>0) {
            $n++;
        }
        if ($n>0) {
            $res = array('msg'=>'商品订购支付成功！','code'=>200,'data'=>'');
        }
        return $res;
        //status: 商品状态         1:待处理，2:未发货，3:已发货，4:已退货
        //order_status: 订单状态   1:待处理，2:已提交，3:已发货，4:已退货
        //pay_status: 支付状态     1:待处理，2:未付款，3:已付款，4:已退款
    }
    function getCarGoodBySession() {
        $uid = $_SESSION['uid'];
        //$sql = "select * from {$this->tab} where uid={$uid}";
        $sql = "select s.id,s.goodid,s.goodname,s.img,s.pcs,s.num,s.price,s.good_wish,s.wish_person from goods_shopcar as s, goods_list as g where s.goodid=g.id and s.uid={$uid} and s.status='1'";
        $res = $this->db->selectRows($sql);
        if ($res) {
            return $res;
        }else {
            return '';
        }
    }
    function addGoodWish() {
        $id = $_GET['id'];
        $good_wish = $_GET['goodWish'];
        $sql = "select * from goods_shopcar where id={$id}";
        if ($this->db->selectRow($sql)) {
            $sql = "update goods_shopcar set good_wish='{$good_wish}' where id={$id}";
            $res = $this->db->otherData($sql);
            if ($res) {
               // return array('msg'=>'更新了goodWish');
            }
        }

    }
    function addWishPerson() {
        $id = $_GET['id'];
        $wish_person = $_GET['wishPerson'];
        $sql = "select * from goods_shopcar where id={$id}";
        if ($this->db->selectRow($sql)) {
            $sql = "update goods_shopcar set wish_person='{$wish_person}' where id={$id}";
            $res = $this->db->otherData($sql);
            if ($res) {
                // return array('msg'=>'更新了goodWish');
            }
        }

    }
    function getOrderMessage(){
        $uid = $_SESSION['uid'];
        $sql="select * from goods_order where uid='{$uid}'";
        $res=$this->db->selectRows($sql);
        return $res;
    }
    function deleteFormOrder(){
        $id=$_GET['id'];
        $sql="delete from goods_order where id='{$id}'";
        $res = $this->db->otherData($sql);
        $orderid=$res['orderid'];
        $new_sql="delete from goods_order where id='{$orderid}'";
        $ret=$this->db->otherData($sql);
        return $res;  
    }
}