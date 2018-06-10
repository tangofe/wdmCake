<?php
/*header("content-type:text/html;charset=utf-8;");*/
include(dirname(__DIR__).'/Common/Fpage.class.php');
class Goods extends Fpage{
	protected $db;
	protected $tab;
	protected $pid;
	protected $name;
	protected $img;
	public function __construct($db,$tab='goods_list',$size=1,$nums=5){
		$this->db=$db;
		$this->tab=$tab;
		 parent::__construct($db,$tab,$size,$nums);		
	}
	//从goods_category选取全部分类内容
	public function getAllCategory(){
		$sql="select * from goods_category";	
		return $this->db->selectRows($sql);
	}


	//检验表单数据
	public function checkForm(){
		$this->cid=$_POST['cid'];
		$this->name=$_POST['good_name'];
		$this->price=$_POST['good_price'];
		$this->pcs=$_POST['good_pcs'];
		$this->pricesum=$_POST['good_pricesum'];
		$this->pcssum=$_POST['good_pcssum'];
		$this->img=htmlspecialchars($_POST['thumbImg']);
		$this->depict=$_POST['good_depict'];
		$this->summary=$_POST['good_summary'];
		$this->type=$_POST['good_type'];
		$this->sizeImg=htmlspecialchars($_POST['good_sizeImg']);
		$this->cnt=htmlspecialchars($_POST['content']);
		//其它属性用于序列化
		$pro=array();
		$keys=array_keys($_POST);
		$vals=array_values($_POST);
		for($i=12;$i<count($_POST)-1;$i++){
				$pro[$keys[$i]]=$vals[$i];
		}
		$this->other_pro=serialize($pro);//序列化属性
		if(empty($this->name)){return array('code'=>100,'msg'=>"请输入商品名称！",'data'=>'') ;exit;}
		if(empty($this->price)){return array('code'=>101,'msg'=>"请输入商品价格！",'data'=>'') ;exit;}
		// if(empty($this->pcs)){return array('code'=>102,'msg'=>"请输入商品计价单位！",'data'=>'') ;exit;}
		// if(empty($this->cnt)){return array('code'=>103,'msg'=>"请输入商品的详细内容！",'data'=>'') ;exit;}
		
	}
	//将商品加入数据库
	public function addGoods(){
		$res=array('code'=>104,'msg'=>"添加商品失败！",'data'=>'') ;
		//$sql="insert into {$this->tab}(cid,name,img,price,pcs,cnt,prototype) values('{$this->cid}','{$this->name}','{$this->price}','{$this->pcs}','{$this->cnt}','{$this->other_pro}')";
		$sql="insert into {$this->tab}(cid,name,img,price,pcs,pricesum,pcssum,depict,summary,type,sizeImg,cnt,prototype) values('{$this->cid}','{$this->name}','{$this->img}','{$this->price}','{$this->pcs}','{$this->pricesum}','{$this->pcssum}','{$this->depict}','{$this->summary}','{$this->type}','{$this->sizeImg}','{$this->cnt}','{$this->other_pro}')";
		//echo $sql;
		if($this->db->otherData($sql)>0){
			$res=array('code'=>105,'msg'=>"添加商品成功！",'data'=>'') ;
		};
		return $res;

	}
	//根据商品id 取商品信息
	public function getGoodsById(){
		$id=$_GET['id'];
		$sql="select * from {$this->tab} where id={$id}";
		$good=$this->db->selectRow($sql);
		$cid=$_GET['cid'];//父类id用于取属性
		$sql="select * from goods_prototype where cid={$cid}";
		$pro=$this->db->selectRows($sql);
		// echo "<pre>";
		// print_r($pro);
		// echo "</pre>";
		return array('good'=>$good,'pro'=>$pro);
	}
	//更新商品
	public function upGoods(){
		$id=$_GET['id'];
		$cid=$_POST['cid'];
		$name=$_POST['good_name'];
		$img=htmlspecialchars($_POST['thumbImg']);
		$price=$_POST['good_price'];
		$pcs=$_POST['good_pcs'];
		$pricesum=$_POST['good_pricesum'];
		$pcssum=$_POST['good_pcssum'];
		$depict=$_POST['good_depict'];
		$summary=$_POST['good_summary'];
		$type=$_POST['good_type'];
		$sizeImg=htmlspecialchars($_POST['good_sizeImg']);
		$cnt=htmlspecialchars($_POST['content']);
		//其它属性用于序列化
		$pro=array();
		$keys=array_keys($_POST);
		$vals=array_values($_POST);
		for($i=12;$i<count($_POST)-1;$i++){
				$pro[$keys[$i]]=$vals[$i];
		}
		$other_pro=serialize($pro);//序列化属性
		//echo  $other_pro;
		$res=array('code'=>106,'msg'=>"更新商品失败！",'data'=>'') ;
		//$sql="insert into {$this->tab}(cid,name,img,price,pcs,cnt,prototype) values('{$this->cid}','{$this->name}','{$this->price}','{$this->pcs}','{$this->cnt}','{$this->other_pro}')";
		$sql="update {$this->tab}  set cid='{$cid}',name='{$name}',img='{$img}',price='{$price}',pcs='{$pcs}',pricesum='{$pricesum}',pcssum='{$pcssum}',depict='{$depict}',summary='{$summary}',type='{$type}',sizeimg='{$sizeImg}',cnt='{$cnt}',prototype='{$other_pro}' where id='{$id}'";
		//echo $sql;
		if($this->db->otherData($sql)>0){
			$res=array('code'=>107,'msg'=>"更新商品成功！",'data'=>'') ;
		};
		return $res;
	}
	//根据id删除商品
	public function deleteGoods(){
		$res=array('code'=>108,'msg'=>"删除商品失败！",'data'=>'') ;
		$id=$_GET['id'];
		//echo $id;
		//根据$id判断其是否有子类如有则不能删除
		$sql="delete from {$this->tab} where id='{$id}' ";
		if($this->db->otherData($sql)>0){
			$res=array('code'=>110,'msg'=>"删除商品成功！",'data'=>'') ;
		}
		return $res;
	}
	

}//类结束
