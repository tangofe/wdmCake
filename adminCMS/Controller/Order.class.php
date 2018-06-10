<?php
/*header("content-type:text/html;charset=utf-8;");*/
include(dirname(__DIR__).'/Common/Fpage.class.php');
class Order extends Fpage{
	protected $db;
	protected $tab;
	protected $pid;
	protected $name;
	protected $img;
	public function __construct($db,$tab='goods_order',$size=1,$nums=5){
		$this->db=$db;
		$this->tab=$tab;
		 parent::__construct($db,$tab,$size,$nums);		
	}
	//订单明细
	public function orderDetail(){
		$orderid=$_GET['orderid'];
		$uid=$_GET['uid'];
		$sql="select * from goods_shopcar where uid='{$uid}' and orderid='{$orderid}'";
		//echo $sql;and orderid='{$orderid}'
		$rows=$this->db->selectRows($sql);	
		//echo $sql;
		//print_r($rows);
		return $rows;	
	}
	
	// 更新订单状态
	// 'type':type,'val': statusVal,'orderid':orderid
	public function changeStatus(){
		
		$type=$_GET['type'];//商品状态(goods_shopcar)、支付状态(goods_order)、订单状态(goods_order)
		$val=intval($_GET['val'])+1;
		$orderid=$_GET['orderid'];
		$uid=$_GET['uid'];
		$res=array("msg"=>"更新失败！","code"=>100,"data"=>$val);
		switch($type){
			case 'pay_status': 
				$sql="update {$this->tab} set pay_status='{$val}' where   orderid='{$orderid}' and uid='{$uid}'";
				if($this->db->otherData($sql)>0){
					$res=array("msg"=>"支付状态更新成功！即时更新商品、订单状态","code"=>101,"data"=>'');
				}
			case 'order_status': 
				$sql="update {$this->tab} set order_status='{$val}' where orderid='{$orderid}' and uid='{$uid}'";
				if($this->db->otherData($sql)>0){
					$res=array("msg"=>"订单状态更新成功！即时更新商品、支付状态","code"=>102,"data"=>'');
				}
			case 'good_status': 
				$sql="update goods_shopcar set good_status='{$val}' where orderid='{$orderid}' and uid='{$uid}'";
				if($this->db->otherData($sql)>0){
					$res=array("msg"=>"商品状态更新成功！即时更新订单、支付状态","code"=>103,"data"=>'');
				}

		}
		
		return $res;
	}

	//good_status:商品状态  1:待处理,2：末发货,3:已发货,4:已退货
	//order_status:订单状态 1:待处理,2：已提交,3:已发货,4:已退货
	//pay_status:支付状态   1:待处理, 2:末付款,3：已付款,4:已退款
	

}//类结束
