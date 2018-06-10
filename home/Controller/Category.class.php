<?php
include(dirname(__DIR__).'/Common/Fpage.class.php');
class Category extends Fpage{
	protected $db;
	protected $tab;
	protected $pid;
	protected $name;
	protected $img;
	public function __construct($db,$tab='goods_category',$size=1,$nums=5){
		$this->db=$db;
		$this->tab=$tab;
		 parent::__construct($db,$tab,$size,$nums);		
	}
	//检验表单数据
	public function checkForm(){
		$this->pid=$_POST['pid'];
		$this->name=$_POST['categoryName'];
		$this->img=htmlspecialchars($_POST['thumbImg']);
		if(empty($this->name)){return array('code'=>102,'msg'=>"请输入分类名称！",'data'=>'') ;exit;}
	}
	//将分类加入数据库
	public function addCategory(){
		$sql="insert into {$this->tab}(pid,name,img) values('{$this->pid}','{$this->name}','{$this->img}')";
		if($this->db->otherData($sql)>0){
			return array('code'=>104,'msg'=>"添加分类成功！",'data'=>'') ;exit;
		}else{
			return array('code'=>103,'msg'=>"添加分类失败！",'data'=>'') ;exit;
		};
	}
	//选取全部分类内容
	public function getAllCategory(){
		$sql="select * from {$this->tab}";	
		return $this->db->selectRows($sql);
	}

	
	//根据id pid 获取指定分类内容
	public function getCategoryById(){
		$id=$_GET['id'];
		$pid=$_GET['pid'];
		$sql="select * from {$this->tab} where id={$id} and pid={$pid}";
		return  $this->db->selectRow($sql);		
	}
	//根据id更新指定分类内容
	public function upCategory(){
		$res=array('code'=>105,'msg'=>"更新分类失败！",'data'=>'') ;
		$id=$_POST['id'];//当前分类
		$img=htmlspecialchars($_POST['thumbImg']);
		$name=$_POST['categoryName'];
		$time=time();
		if(empty($name)){
			$res=array('code'=>106,'msg'=>"分类名不能为空！",'data'=>'') ;
		}
		$sql="update {$this->tab} set  name='{$name}'  ,time='{$time}' ,img='{$img}' where id={$id}";
		//echo $sql;
		if($this->db->otherData($sql)>0){
			$res=array('code'=>107,'msg'=>"更新分类成功！",'data'=>'') ;
		}
		//print_r($_POST);
		return $res;
	}
	//根据id删除指定分类内容
	public function deleteCategory(){
		$res=array('code'=>108,'msg'=>"删除分类失败！",'data'=>'') ;
		$id=$_GET['id'];
		//echo $id;
		//根据$id判断其是否有子类如有则不能删除
		$sql="select id from {$this->tab} where pid='{$id}' ";
		if($this->db->selectRow($sql)){
			$res=array('code'=>109,'msg'=>"请先删除子分类！",'data'=>'') ;
		}else{
			$sql="delete from {$this->tab} where id='{$id}' ";
			if($this->db->otherData($sql)>0){
				$res=array('code'=>110,'msg'=>"删除分类成功！",'data'=>'') ;
			}
		}
		return $res;
	}

}//类结束
