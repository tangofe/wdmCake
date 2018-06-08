<?php
session_start();
header("content-type:text/html;charset=utf-8;");
//include(dirname(__DIR__).'/Common/Fpage.class.php');
class ShopCar{
	protected $db;
	protected $tab;
	protected $pid;
	protected $name;
	protected $img;
	public function __construct($db,$tab='goods_shopcar',$size=1,$nums=5){
		$this->db=$db;
		$this->tab=$tab;
		// parent::__construct($db,$tab,$size,$nums);		
	}
	//检测用户身份与购物车
	public function checkUserInfo(){
		$res=array('msg'=>"用户还未登录",'code'=>100,'data'=>'');
		if(isset($_SESSION['userId'])&&isset($_SESSION['shopcar'])){
			$res=array('msg'=>"用户已登录",'code'=>101,'data'=>'');
		}
		return $res;
	}
	
	//添加商品到数据库
	public function addGoodsToShopCar(){
		$res=array('msg'=>"商品加入购物车失败！",'code'=>102,'data'=>'');
		$goodid=$_GET['id'];//商品id
		$name=$_GET['name'];
		$price=$_GET['price'];
		$num=1;
		if (isset($_GET['num'])) {
			$num=$_GET['num'];
		}
		$img=$_GET['img'];
		$pcs=$_GET['pcs'];
		$uid=$_SESSION['uid'];
		$time=time();//订购时间

		//先查询是否存在此商品，如果存在则更新，否则新添加。
		$sql="select goodid,num,price from {$this->tab} where status='1' and goodid={$goodid} and uid='{$uid}' and pcs='{$pcs}'";
		$row=$this->db->selectRow($sql);
		if($row){
			$newNum=$num+$row['num'];
			$sql="update {$this->tab} set num='{$newNum}' where status='1' and goodid={$goodid} and uid='{$uid}' and pcs='{$pcs}'";
		}else{
			$sql="insert into {$this->tab}(uid,goodid,goodname,price,num,time,img,pcs) values('{$uid}','{$goodid}','{$name}','{$price}','{$num}','{$time}','{$img}','{$pcs}')";
		}
		if($this->db->otherData($sql)){
			$res=array('msg'=>"商品加入购物车成功！",'code'=>103,'data'=>$sql);
		}
		return $res;
	}
	//添加商品到数据库
	public function addGoodsToShopCar1(){
		$res=array('msg'=>"商品加入购物车失败！",'code'=>102,'data'=>'');
		$goodid=$_GET['id'];//商品id
		$name=$_GET['name'];
		$price=$_GET['price'];
		$num=1;
		if (isset($_GET['num'])) {
			$num=$_GET['num'];
		}
		$img=$_GET['img'];
		$uid=$_SESSION['uid'];
		$time=time();//订购时间

		//先查询是否存在此商品，如果存在则更新，否则新添加。
		$sql="select goodid,num,price from {$this->tab} where status='1' and goodid={$goodid} and uid='{$uid}'";
		$row=$this->db->selectRow($sql);
		if($row){
			$newNum=$num+$row['num'];
			$sql="update {$this->tab} set num='{$newNum}' where status='1' and goodid={$goodid} and uid='{$uid}'";
		}else{
			$sql="insert into {$this->tab}(uid,goodid,goodname,price,num,time,img) values('{$uid}','{$goodid}','{$name}','{$price}','{$num}','{$time}','{$img}')";
		}
		if($this->db->otherData($sql)){
			$res=array('msg'=>"商品加入购物车成功！",'code'=>103,'data'=>$sql);
		}
		return $res;
	}
	//初始化购物车，从购物车数据表中取当前用户的购物记录
	public function initShopCar(){
		$uid=$_SESSION['uid'];
		
		$res=array('msg'=>"取商品失败！",'code'=>104,'data'=>$uid);

		$sql="select id,img,goodname,num,pcs,price,goodid from {$this->tab} where uid='{$uid}'
		and status='1' ";
		$rows= $this->db->selectRows($sql);
		if($rows){
			$res=array('msg'=>"取商品成功！",'code'=>105,'data'=>$rows);
		}
		return $res;
	}
	//更改购物车中的商品数量（通过购物车的加减按钮实现）
	public function changeNum(){
		$uid=$_SESSION['uid'];
		$res=array('msg'=>"更新商品数量失败！",'code'=>106,'data'=>'');
		$goodid=$_GET['goodid'];
		$pcs=$_GET['pcs'];
		$num=$_GET['num'];
		$sql="update {$this->tab} set num='$num' where goodid={$goodid} and status='1' and uid='{$uid}' and pcs='{$pcs}'";
		if($this->db->otherData($sql)){
			$res=array('msg'=>"更新商品数量成功！",'code'=>107,'data'=>'');
		}
		return $res;
	}

	//删除购物车中的商品
	public function delgoods(){
		$res=array('msg'=>"商品删除失败！",'code'=>110,'data'=>'');
		$uid=$_SESSION['uid'];
		$pcs=$_GET['pcs'];
		$goodid=$_GET['id'];
		$sql="delete from {$this->tab} where status='1' and uid='{$uid}' and goodid='{$goodid}' and pcs='{$pcs}'";
		if($this->db->otherData($sql)>0){
			$res=array('msg'=>"商品删除成功！",'code'=>111,'data'=>'');
		}
		return $res;
	}
	//提交订单
	public function pushOrder(){
		$res=array('msg'=>"商品订购支付失败！",'code'=>108,'data'=>'');
		// $orderid=uniqid();
		$orderid=uniqid().rand(10000,99999);
		$time=time();
		$uid=$_SESSION['uid'];
		$goodsid=$_POST;
		$n=0;
		$money=0;
		foreach ($goodsid as $goodid) {
			$sql_sel="select price,num from {$this->tab} where status='1' and uid='{$uid}' and goodid='{$goodid}'";
			$row=$this->db->selectRow($sql_sel);
			if($row){$money+=floatval($row['price'])*intval($row['num']);}
			$sql="update {$this->tab} set status='2', orderid='{$orderid}', time='{$time}' where status='1' and goodid='{$goodid}' and uid='{$uid}'";
			if($this->db->otherData($sql)>0){$n++;}
		}
		$sql_in="insert into goods_order(uid,orderid,money,order_status,pay_status,time) values('{$uid}','{$orderid}','{$money}','2','2','{$time}')";
		if($this->db->otherData($sql_in)>0){$n++;}
		if($n>0){
			$res=array('msg'=>"商品订购支付成功！",'code'=>109,'data'=>'');
		}
		return $res;
		//status:       商品状态 1:待处理 2:未提交 3:已发货 4:已退货
		//order_status: 订单状态 1:待处理 2:已提交 3:已发货 4:已退货
		//pay_status：  支付状态 1:待处理 2:未付款 3:已付款 4:已退款
	}
	
}//类结束