<?php
/*header("content-type:text/html;charset=utf-8;");*/
//include(dirname(__DIR__).'/Common/Fpage.class.php');
class Prototype{
	protected $db;
	protected $tab;
	protected $pid;
	protected $name;
	protected $img;
	public function __construct($db,$tab='goods_prototype',$size=1,$nums=5){
		$this->db=$db;
		$this->tab=$tab;
		// parent::__construct($db,$tab,$size,$nums);		
	}
	//从goods_category选取全部分类内容
	public function getAllCategory(){
		$sql="select * from goods_category";	
		return $this->db->selectRows($sql);
	}


	//检验表单数据
	public function checkForm(){
		// echo "<pre>";
		// print_r($_POST);
		$this->pid=$_POST['pid'];
		$this->name=$_POST['proName'];
		$this->type=$_POST['pro_value_type'];//属性输入方式
		$this->val=$_POST['pro_value'];//属性值
		if(empty($this->name)){return array('code'=>102,'msg'=>"请输入属性名称！",'data'=>'') ;exit;}
		if($this->type==2){
			if(empty($this->val)){return array('code'=>105,'msg'=>"请输入属性值！",'data'=>'') ;exit;}
		}
	}
	//将属性加入数据库
	public function addPrototype(){

		$sql="insert into {$this->tab}(cid,name,type,value) values('{$this->pid}','{$this->name}','{$this->type}','{$this->val}')";
		if($this->db->otherData($sql)>0){
			return array('code'=>104,'msg'=>"添加属性成功！",'data'=>'') ;exit;
		}else{
			return array('code'=>103,'msg'=>"添加属性失败！",'data'=>'') ;exit;
		};
	}
	

	//根据分类id取其属性
	public function getPrototype(){
		$cid=$_GET['cid'];
		$sql="select * from {$this->tab} where cid={$cid}";
		return $this->db->selectRows($sql);
	}

	//根据指定id删除属性
	public function delPrototype(){
		$res=array('code'=>105,'msg'=>"删除属性失败！",'data'=>'') ;
		$id=$_GET['id'];
		$sql="delete from {$this->tab} where id={$id}";
		if($this->db->otherData($sql)>0){
			$res=array('code'=>106,'msg'=>"删除属性成功！",'data'=>'') ;
		}
		return $res;
	}
	//更新属性
	public function upPrototype(){
		$cid=$_POST['cid'];
		$area=array();//包括id 与 name id 与value
		$input=array();//包括id 与 name
		foreach($_POST as $key=>$val){
			if($key!='cid'&&$key!='btn'){
				if($key>0){
					$input[$key]=$val;
				}else{
					$area[$key]=$val;
				}				
			}			
		}
		$value=array();
		if($area){
			foreach ($area as $key => $val) { //$key形式start_11
				$t=explode('_',$key);
				if($t[0]=='start'){
					$input[$t[1]]=$val;
				}
				if($t[0]=='end'){
					$value[$t[1]]=$val;
				}
			}
		}
		// echo "<pre>";
		// print_r($input);//数据库中的name字段
		// print_r($area);
		// print_r($value);//数据库中的value字段
		$n=0;
		//更新数据
		if($value){
			foreach ($value as $id => $val) {
				$sql="update {$this->tab} set value='{$val}' where id={$id} ";
				if($this->db->otherData($sql)>0){
					$n++;
				};
			}
		}
		if($input){
			foreach ($input as $id => $val) {
				$sql="update {$this->tab} set name='{$val}' where id={$id} ";
				if($this->db->otherData($sql)>0){
					$n++;
				};
			}
		}
		$res=array('code'=>106,'msg'=>"更新属性失败！",'data'=>'') ;
		if($n>0){
			$res=array('code'=>107,'msg'=>"更新属性成功！",'data'=>'') ;
		}
		return $res;
	}

}//类结束
