<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/12
 * Time: 20:17
 */
header("content-type:text/html;charset=utf-8;");
class GetMessage {
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function  getMessage() {
        $uid = $_SESSION['uid'];
        $sql = "select * from getgood_message where uid={$uid}";
        $res = $this->db->selectRows($sql);
//        print_r($res);
        foreach ($res as $key=>$re) {
            $array = explode(",",$re['address']);;
            $address = '';
            foreach($array as $i=>$arr) {
                $sql = "select address_side from address where id={$arr}";
                $row = $this->db->selectRow($sql);
                $address.=$row['address_side'];
                if ($i==0) {
                    $address .= ' ';
                }
            }
          // print_r($re['address']);
           // $re['address'] = $address;
            $res[$key]['address'] = $address;
            //$re['address_zh'] = $address;
           // print_r($re['address']);
           // print_r($res[0]['address']);
        }
       // print_r($res);
       // print_r($res[0]['address']);
        return $res;
    }
    public function upMessage() {
        $id = $_GET['id']; //若为编辑，就为收货信息id;若为新增，就是0;
        $uid = $_GET['uid'];
        $src1=$_GET['src1'];
        $src2=$_GET['src2'];
        $src3=$_GET['src3'];
        $src4=$_GET['src4'];
        $srcD=$_GET['srcD'];
        $getPer=$_GET['getPer'];
        $orderPer=$_GET['orderPer'];
        $getPhone=$_GET['getPhone'];
        $orderPhone=$_GET['orderPhone'];
        $isAlway=$_GET['isAlway'];
        $address= $src1.','.$src2.','.$src3.','.$src4;

        $sql = "select * from user where uid={uid}";
        if($this->db->selectRow($sql)) {
            //print_r($id);
            if ($isAlway==1) {  //如果为1让数据库其他数据为0
                $sql = "update getgood_message set is_alway=0 where uid={$uid}";
                $this->db->otherData($sql);
            }
            if ($id == 0) {
                $sql = "insert into getgood_message( uid,address,address_detail,get_person,get_call,pay_person,pay_call,is_alway)
            value('{$uid}','{$address}','{$srcD}','{$getPer}','{$getPhone}','{$orderPer}','{$orderPhone}','{$isAlway}')";
                // print_r(11);
            } else {
                $sql = "update getgood_message set address='{$address}',address_detail='{$srcD}',get_person='{$getPer}',get_call='{$getPhone}',pay_person='{$orderPer}',pay_call='{$orderPhone}',is_alway='{$isAlway}'
                where id={$id} and uid={$uid}";
            }
            $this->db->otherData($sql);
            if (1) {
                $sql = "select * from getgood_message where uid={$uid}";
                $res = $this->db->selectRows($sql);
                foreach ($res as $key => $re) {
                    $array = explode(",", $re['address']);
                    $address = '';
                    foreach ($array as $i => $arr) {
                        $sql = "select address_side from address where id={$arr}";
                        $row = $this->db->selectRow($sql);
                        $address .= $row['address_side'];
                        if ($i == 0) {
                            $address .= ' ';
                        }
                    }
                    // $res[$key]['address'] = $array;
                    $res[$key]['address_zh'] = $address;
                }
                // print_r($res);
                return $res;
            }
        }
    }
    public function editMessage() {
        $id = $_GET['id'];
        $sql = "select * from getgood_message where id={$id}";
        $res = $this->db->selectRow($sql);
        if ($res) {
            $array = explode(",",$res['address']);
            $src1 = array();
            $src = array();
            foreach($array as $i=>$arr) {
                if ($i!=3) {
                    $sql = "select id,address_side from address where fid={$arr}";
                    $rows = $this->db->selectRows($sql);
                    foreach ($rows as $j => $row) { //将每个联动的地址id和名 存进一个数组
                        $src1[$j]['id'] = $row['id'];
                        $src1[$j]['address_side'] = $row['address_side'];
                    }
                    $src[$i] = $src1; //src数组
                }
            }
            $res['src'] = $src;
            return $res;
        }

    }
    public function delMessage() {
        $id = $_GET['id'];
        $sql = "delete from getgood_message where id={$id}";
        if ($this->db->otherData($sql)) {
            return array('msg'=>'删除成功','code'=>200,'data'=>'');
        } else {
            return array('msg'=>'删除失败','code'=>400,'data'=>'');
        }
    }
}