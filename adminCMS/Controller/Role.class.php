<?php
//header("content-type:text/html;charset=utf-8;");
//include(dirname(__DIR__).'/Common/Fpage.class.php');
class Role{
	protected $db;
	protected $tab;
	public function __construct($db,$tab){
		$this->db=$db;
		$this->tab=$tab;
		//parent::__construct($db,$tab);
		
	}
	//检测角色是否存在
	public function checkRole(){
		$res=array('code'=>'u007','msg'=>'角色可用！');
		$role=$_GET['roleName'];
		$sql="select roleId from $this->tab where roleName='{$role}' ";
		if($this->db->selectRow($sql)){
			$res=array('code'=>'u008','msg'=>'角色已经存在！');	
		}
		return $res;
	}
	//添加角色
	public function addRole(){
		$res=array('code'=>'u009','msg'=>'添加角色失败！');
		$role=$_POST['rolename'];
		$sql="insert into $this->tab set roleName='{$role}'";
		if($this->db->otherData($sql)>0){
			$res=array('code'=>'u010','msg'=>'添加角色成功！');
		}
		return $res;
	}
	//取全部角色
	public function getAllRoles(){
		$res=array('code'=>'u011','msg'=>'取全部角色失败！','resultData'=>'');
		$sql="select * from $this->tab";
		$rows=$this->db->selectRows($sql);
		if($rows){
			$res=array('code'=>'u012','msg'=>'取全部角色成功！','resultData'=>$rows);
		}
		return  $res;
	}
	//根据传递的id 值取相关信息
	public function getCntById(){
		$id=$_GET['id'];
		$res=array('code'=>'u013','msg'=>'取角色失败！','resultData'=>'');
		$sql="select * from $this->tab where roleId='{$id}'";
		$row=$this->db->selectRow($sql);
		if($row){
			$res=array('code'=>'u014','msg'=>'取角色成功！','resultData'=>$row);
		}
		return  $res;
	}
	//更新角色
	public function upRole(){
		$res=array('code'=>'u015','msg'=>'更新角色失败！','resultData'=>'');
		$id=$_GET['id'];
		$role=$_GET['role'];
		$sql="update {$this->tab} set roleName='{$role}'  where roleId={$id}";
		if($this->db->otherData($sql)>0){
			$res=array('code'=>'u016','msg'=>'更新角色成功！','resultData'=>'');
		}
		return  $res;
	}
	//删除角色
	public function deleteRole(){
		$res=array('code'=>'u017','msg'=>'删除角色失败！','resultData'=>'');
		$id=$_GET['id'];
		$sql="delete from {$this->tab}  where roleId={$id}";
		if($this->db->otherData($sql)>0){
			$res=array('code'=>'u018','msg'=>'删除角色成功！','resultData'=>'');
		}
		return  $res;
	}

}//类结束