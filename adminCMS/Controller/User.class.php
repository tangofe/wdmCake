<?php
//header("content-type:text/html;charset=utf-8;");
//include(dirname(__DIR__).'/Common/Fpage.class.php');
class User extends Fpage{
	protected $db;
	protected $tab;
	protected $user;
	protected $pwd;
	protected $res;//返回的结果
	public function __construct($db,$tab){
		$this->db=$db;
		$this->tab=$tab;
		parent::__construct($db,$tab);
		
	}
	//检查登录用户信息
	public function checkLoginUserInfo(){
		//Array ( [name] => phpcms [pwd] => phpcms [code] => aswe 
		$this->user=$_POST['name'];
		$this->pwd=$_POST['pwd'];
		// $code=$_POST['code'];
		if(empty($this->user)){return array('code'=>'u001','msg'=>'请输入用户名！');exit;}
		if(empty($this->pwd)){return array('code'=>'u002','msg'=>'请输入密码！');exit;}
		// if(strtolower($code)!=strtolower($_SESSION['code'])){return array('code'=>'u003','msg'=>'验证码错误！');exit;}
	}
	//用户登录
	public function loginUser(){
		$res=$this->checkLoginUserInfo();
		if($res){
			return $res;exit;
		}else{
			if(isset($_SESSION['user'])){//用户重复登录的处理
				//return array('code'=>'u006','msg'=>'请不要重复登录！');exit;
				//return array('code'=>'u004','msg'=>'用户成功登录！');exit;
			}
			$sql="select * from $this->tab where userId='{$this->user}' and pwd='{$this->pwd}' ";
			$row=$this->db->selectRow($sql);
			if($row){
				if ($row['roleId']!='1') {
					$_SESSION['user']=$this->user;//将用户信息保存到session中
					$_SESSION['roleId']=$row['roleId'];
					return array('code'=>'u004','msg'=>'用户成功登录！');exit;
				}else{
					return array('code'=>'u005','msg'=>'该用户没有登录权限');exit;
				}
				
			}else{

				return array('code'=>'u005','msg'=>'用户登录失败！');exit;
			}
		}
	}
	//用户退出
	public function userSafeOut(){
		setcookie(session_name(),'',time()-1,'/');
		$_SESSION=array();
		session_destroy();
		return array('code'=>'u006','msg'=>'用户退出成功！');exit;
	}

	//获取用户权限
	public function getUserAccess(){
		$userName="user01";
		$sql="select * from user,access where user.roleId=access.roleId and user.userName='{$userName}'";
		$row=$this->db->selectRow($sql);
		echo "<pre>";
		print_r($row);
	}

	//添加用户
	public function addUser(){
		$res=array('code'=>'u007','msg'=>'添加用户失败！','resultData'=>'');
		$role=$_POST['role'];
		$name=$_POST['username'];
		$pwd=$_POST['pwd'];
		$sql="insert into {$this->tab}(roleId,userId,pwd)  values('{$role}','{$name}','{$pwd}')";
		//echo $sql;
		if($this->db->otherData($sql)>0){
			$res=array('code'=>'u008','msg'=>'添加用户成功！','resultData'=>'');
		}
		//print_r($res);
		return $res;
	}
	//取全部用户信息
	public function getAllUser(){
		$res=array('code'=>'u009','msg'=>'取全部用户信息失败！','resultData'=>'');
		$sql="select * from role,user where user.roleId=role.roleId";
		$rows=$this->db->selectRows($sql);
		if($rows){
			$res=array('code'=>'u010','msg'=>'取全部用户信息成功！','resultData'=>$rows);
		}
		return $res;
	}
	//删除用户
	public function deleteUser(){
		$res=array('code'=>'u011','msg'=>'删除用户信息失败！','resultData'=>'');
		$id=$_GET['id'];
		$sql="delete from {$this->tab} where id='{$id}'";		
		if($this->db->otherData($sql)>0){
			$res=array('code'=>'u012','msg'=>'删除用户信息成功！','resultData'=>'');
		}
		//print_r($res);
		return $res;
	}
	//取单个用户的信息
	public function getInfoById(){
		$res=array('code'=>'u013','msg'=>'取用户信息失败！','resultData'=>'');
		$id=$_GET['id'];
		$sql="select * from role,user where user.roleId=role.roleId and id='{$id}'";
		$row=$this->db->selectRow($sql);
		if($row){
			$res=array('code'=>'u014','msg'=>'取用户信息成功！','resultData'=>$row);
		}
		return $res;
	}
	//根据id更新用户信息
	public function updateUser(){
		//Array ( [role] => 3 [userId] => 6 [username] => phpcms [pwd] => a [repwd] => a ) 
		$res=array('code'=>'u015','msg'=>'更新用户信息失败！','resultData'=>'');
		$roleId=$_POST['role'];
		$id=$_POST['userId'];
		$userId=$_POST['username'];
		$pwd=$_POST['pwd'];
		$time=time();
		$sql="update {$this->tab}  set roleId='{$roleId}',userId='{$userId}',pwd='{$pwd}',time='{$time}'  where id='{$id}'";
		//echo $sql;
		if($this->db->otherData($sql)>0){
			$res=array('code'=>'u016','msg'=>'更新用户信息成功！','resultData'=>'');
		}
		return $res;
	}
}//类结束