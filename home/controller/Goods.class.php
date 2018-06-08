<?php
header("content-type:text/html;charset=utf-8;");
//include(dirname(__DIR__).'/Common/Fpage.class.php');
class Goods{
	protected $db;
	protected $tab;
	protected $pid;
	protected $name;
	protected $img;
	public function __construct($db,$tab='goods_list',$size=1,$nums=5){
		$this->db=$db;
		$this->tab=$tab;
		// parent::__construct($db,$tab,$size,$nums);		
	}
	//根据cid获取指定数量(默认全部)的商品
	public function getGoodsByCid($cid,$num='all'){
		$sql="select * from {$this->tab} where cid='{$cid}' order by id desc";
		if($num!='all'){
			$sql.="  limit 0 , {$num}";
		}
		return $this->db->selectRows($sql);
	}
	public function getCategoryGoodsByCid(){
			$id=$_GET['id'];
			//echo $id;
			$sql="select * from $this->tab where cid=$id";
			//echo $sql;
			return $this->db->selectRows($sql);
		}

	//从goods_clist选取全部分类内容
	public function getAllgoods(){
		$sql="select * from goods_list";	
		return $this->db->selectRows($sql);
	}

	//根据id获取商品的详细信息
	public function getGoodsDetailById(){
		$id=0;
		if(isset($_GET['id'])){
			$id=$_GET['id'];
		}
		if((int)$id<1){$id=1;}
		$sql="select * from {$this->tab} where id={$id}";
		return $this->db->selectRow($sql);
	}
	public function add_order_history(){
		$sql="select * from goods_list where id='50'";

		return $this->db->selectRows($sql);
	}
	public function addLikeNumToGoods(){
		$res=array('msg'=>"点击喜欢失败！",'code'=>101,'data'=>"系统繁忙，请刷新页面");
		if (!isset($_SESSION['userId'])) {
			return $res;
			exit;
		}
		$id=$_GET['id'];
		$num=$_GET['num'];
		$num++;
		$sql="update {$this->tab} set likenum='{$num}' where id='{$id}'";
		$row=$this->db->otherData($sql);
		if ($row>0) {
			$res=array('msg'=>"点击喜欢成功！",'code'=>102,'data'=>$num);
		}
		return $res;
	}
	public function getCategoryAllGoods(){
		$id=$_GET['id'];
		$sql="select * from $this->tab where id='{$id}'";
		$res=$this->db->selectRow($sql);
		$rot=$res['cid'];
		while($rot!=0){
			$pid=$rot;
			$sql="select * from goods_category where id='{$pid}'";
			$res=$this->db->selectRow($sql);
			$rot=$res['pid'];
		}
		$id=$res['id'];
		//获取最高级类别id成功		
		$sql="select * from goods_category where pid='{$id}'";
		$res=$this->db->selectRow($sql);
		if (!isset($res)) {
			$new_sql="select * from $this->tab where cid=$id";
			$res=$this->db->selectRows($new_sql);
			$res_array=array();
			foreach ($res as $re) {
				$a=htmlspecialchars_decode($re['img']);
				preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
				$re['img']=$match[1][0];
				array_push($res_array,$re);
			}	
			return $res_array;
		}else{
			$res_array=array();
			$sql="select * from goods_category where pid='{$id}'";
			$res=$this->db->selectRows($sql);
			foreach ($res as $ros) {
				$rot=$ros['id'];
				$new_sql="select * from $this->tab where cid='{$rot}'";
				$ret=$this->db->selectRows($new_sql);
				foreach ($ret as $re) {
					$a=htmlspecialchars_decode($re['img']);
					preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
					$re['img']=$match[1][0];
					array_push($res_array,$re);
				}				
			}
			return $res_array;
		}
	}

}//类结束