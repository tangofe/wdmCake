<?php
session_start();
//定义对应的实体类	
class User{
	protected $name;
	protected $phone_num;
	protected $pwd;
	protected $repwd;
	protected $code;
	protected $em;
	protected $email;
	protected $roleId;
	protected $db;
	//定义构造方法，链接数据库
	function __construct($db,$tab='user'){
		$this->db=$db;
		$this->tab=$tab;
	}

	//注册方法
	public function regInfoCheck(){
		$this->phone_num=$_POST["reg_phoen_num"];
		$this->pwd=$_POST["reg_password"];
		$this->repwd=$_POST["reg_repassword"];
		if(strlen($this->phone_num)<1){return array("msg"=>"请输入手机号！","state"=>100,"date"=>"");exit;}
		if(!preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $this->phone_num)){
     		return array("msg"=>"请输入正确手机号码","state"=>101,"date"=>"");exit;
 		}
		if(strlen($this->pwd)<1){return array("msg"=>"请输入密码！","state"=>102,"date"=>"");exit;}
		if(strlen($this->pwd)>15){return array("msg"=>"密码长度不符合规定","state"=>103,"date"=>"");exit;}
		if(strlen($this->repwd)<1){return array("msg"=>"请再次输入密码！","state"=>104,"date"=>"");exit;}
		if($this->repwd!=$this->pwd){return array("msg"=>"两次输入密码不一致！","state"=>105,"date"=>"");exit;}
		if(strtoupper($_POST['letter_check_log'])!=strtoupper($_SESSION['code'])){
				return array("msg"=>"验证码有误!","state"=>106,"date"=>"");exit;
		}
	} 
	public function userReg(){
		$this->roleId=1;
		$this->phone_num=$_POST["reg_phoen_num"];
		$res=array("msg"=>"注册失败","state"=>107,"date"=>"");
		$time=time();
		$sql_check="select * from {$this->tab} where phoneNum='{$this->phone_num}'";
		$obj=$this->db->selectRow($sql_check);
		if (isset($obj)) {
			$res=array("msg"=>"该手机号已被注册！","state"=>107,"date"=>"");
			return $res;
		}
		$sql="insert into {$this->tab}(phoneNum,pwd,time,roleId) values('{$this->phone_num}','{$this->pwd}','{$time}','{$this->roleId}')";
		if($this->db->otherData($sql)>0){
			$res=array("msg"=>"注册成功","state"=>108,"date"=>"");
		}
		return $res;
	}


	//登录方法
	public function logInfoCheck(){
		if (isset($_POST["submit_1"])) {
			$this->name=$_POST["log_name"];
			$this->pwd=$_POST["password"];
			if(strlen($this->name)<1){return array("msg"=>"请输入用户名！","state"=>109,"date"=>"");exit;}
			if(strlen($this->pwd)<1){return array("msg"=>"请输入密码！","state"=>102,"date"=>"");exit;}
		}
		if (isset($_POST["submit_2"])) {
			$this->phone_num=$_POST["log_phnum"];
			$this->code=$_POST['letter_check_log'];
			if(strlen($this->phone_num)<1){return array("msg"=>"请输入手机号码！","state"=>100,"date"=>"");exit;}
			if(strlen($this->code)<1) {return array("msg"=>"请输入验证码","state"=>110,"date"=>"");exit;}
			if(!preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $this->phone_num)){
     		return array("msg"=>"请输入正确手机号码","state"=>101,"date"=>"");exit;
 			}
			if(strtoupper($this->code)!=strtoupper($_SESSION['code'])){
				return array("msg"=>"验证码有误!","state"=>106,"date"=>"");exit;
			}
		}
	} 
	public function userlog(){
		$res=array("msg"=>"登录失败","state"=>111,"date"=>"");
		if (isset($_POST["submit_1"])) {
			$sql="select * from {$this->tab} where (userId='{$this->name}' or phoneNum='{$this->name}' or email='{$this->name}') and pwd='{$this->pwd}'";
		}
		if (isset($_POST["submit_2"])) {
			$sql="select * from {$this->tab} where phoneNum='{$this->phone_num}'";
		}
		$row=$this->db->selectRow($sql);
		if(isset($row)){
			$res=array("msg"=>"登录成功","state"=>112,"date"=>"");
			$_SESSION['userId']=$row['userId'];
			$_SESSION['phoneNum']=$row['phoneNum'];
			$_SESSION['userName']=$row['userName'];
			//分配购物车id或标记
			$_SESSION['shopcar']=session_id();
			$_SESSION['uid']=$row['id'];
		}
		return $res;
	}
	
	// 找回账户密码方法
	public function findInfoCheck(){
		if (isset($_GET["find_phone_submit"])) {
			$this->phone_num=$_GET["phone_num"];
			$this->em=$_GET['verific_code'];
			$this->code=$_GET['verific_box'];
			if (strlen($this->phone_num)<1) {return array("msg"=>"请输入手机号码！","state"=>100,"date"=>"");exit;}
			if(!preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $this->phone_num)){
      		return array("msg"=>"请输入正确手机号码","state"=>101,"date"=>"");exit;
  			}
  			if (strlen($this->code)<1) {return array("msg"=>"请输入验证码！","state"=>110,"date"=>"");exit;}
  			if(strtoupper($this->code)!=strtoupper($_SESSION['code'])){
	 			return array("msg"=>"验证码有误!","state"=>106,"date"=>"");exit;
	 		}
  			if (strlen($this->em)<1) {return array("msg"=>"请输入手机验证码！","state"=>113,"date"=>"");exit;}
		}
		if(isset($_GET["find_email_submit"])){
			$this->name=$_GET["user_num"];
			$this->email=$_GET["email_num"];
			if (strlen($this->name)<1) {return array("msg"=>"请输入账号！","state"=>114,"date"=>"");exit;}
			if (strlen($this->email)<1){return array("msg"=>"请输入邮箱！","state"=>115,"date"=>"");exit;}
			if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i', $this->email)){
      		return array("msg"=>"请输入正确邮箱！","state"=>116,"date"=>"");exit;
  			}
		}
	}
	public function selectFromUser(){
		$res=array("msg"=>"该用户信息不存在！","state"=>116,"date"=>"");
		if (isset($_GET["find_phone_submit"])){
			$sql="select * from {$this->tab} where phoneNum='{$this->phone_num}'";
		}
		if(isset($_GET["find_email_submit"])){
			$sql="select * from {$this->tab} where userId='{$this->name}' and email='{$this->email}'";
		}
		$row=$this->db->selectRow($sql);
		if (isset($row)) {
			$res=array("msg"=>"用户存在！","state"=>117,"date"=>"");
			$_SESSION['Id']=$row['id'];
		}
		return $res;
	}
	public function refindInfoCheck(){
		$this->pwd=$_GET["new_Pwd"];
		$this->repwd=$_GET["re_new_Pwd"];
		if(strlen($this->pwd)<1){return array("msg"=>"请输入密码！","state"=>102,"date"=>"");exit;}
		if(strlen($this->pwd)>15){return array("msg"=>"密码长度不符合规定","state"=>103,"date"=>"");exit;}
		if(strlen($this->repwd)<1){return array("msg"=>"请再次输入密码！","state"=>104,"date"=>"");exit;}
		if($this->repwd!=$this->pwd){return array("msg"=>"两次输入密码不一致！","state"=>105,"date"=>"");exit;}
	}
		public function updateIntoUser(){
		$res=array("msg"=>"修改失败","state"=>118,"date"=>"");
		if (isset($_SESSION['Id'])) {
			$sql="select * from {$this->tab} where id='{$_SESSION['Id']}' and pwd='{$this->pwd}'";
			$rot=$this->db->selectRow($sql);
			if (!isset($rot)) {
				$sql="update {$this->tab} set pwd='{$this->pwd}' where id='{$_SESSION['Id']}'";
				if ($this->db->otherData($sql)) {
					$res=array('msg'=>"修改成功",'state'=>119,'data'=>"");
				}
			}else{
				$res=array("msg"=>"修改成功","state"=>119,"date"=>"");
			}
			
		}
		return $res;
	}
	//修改密码
	//
	public function changePwdIntoCheck(){
		$old_Pwd=$_POST["old_Pwd"];
		$this->pwd=$_POST["new_Pwd"];
		$this->repwd=$_POST["re_Pwd"];
		if(strlen($old_Pwd)<1){return array("msg"=>"请输入原密码！","state"=>120,"date"=>"");exit;}
		if(strlen($this->pwd)<1){return array("msg"=>"请输入新密码！","state"=>102,"date"=>"");exit;}
		if(strlen($this->repwd)<1){return array("msg"=>"请再次输入密码！","state"=>104,"date"=>"");exit;}
		if($this->repwd!=$this->pwd){return array("msg"=>"两次输入密码不一致！","state"=>105,"date"=>"");exit;}
	}
	public function changePwdIntoUser(){
		$res=array("msg"=>"修改失败！","state"=>118,"date"=>"");
		$sql="select * from {$this->tab} where id='{$_SESSION['uid']}' and pwd='{$this->pwd}'";
			$rot=$this->db->selectRow($sql);
			if (!isset($rot)) {
		
			$sql="update {$this->tab} set pwd='{$this->pwd}' where userId='{$_SESSION['userId']}'";
		
		if ($this->db->otherData($sql)) {
			$res=array('msg'=>"修改成功",'state'=>119,'data'=>"");
		}
	}else{
		$res=array('msg'=>"修改成功",'state'=>119,'data'=>"");
	}
		return $res;
	}
	

	//个人信息的修改
	//
	public function changeMessageInfoCheck(){
		$sql="select * from {$this->tab} where userId='{$_SESSION['userId']}'";
		$row=$this->db->selectRow($sql);
		if ($row["email"]!="") {
			return array("msg"=>"该用户信息已存在，不可修改","state"=>121,"date"=>"");exit;
		}
		$this->name=$_POST["userName"];
		$trust_name=$_POST["usertrustName"];
		if (!isset($_POST["userSex"])) {
			$_POST["userSex"]='0';
		}else{
			$userSex=$_POST["userSex"];
		}
		$this->phone_num=$_POST["userModile"];
		$this->email=$_POST["userEmial"];
		$year=$_POST["year"];
		$month=$_POST["month"];
		$day=$_POST["day"];
		$family=$_POST["family"];
		$family_year=$_POST["family_year"];
		$family_month=$_POST["family_month"];
		$family_day=$_POST["family_day"];
		$QQ=$_POST["userQQ"];
		$userLocation=$_POST["userLocation"];
		if(strlen($this->name)<1){return array("msg"=>"请输入昵称！","state"=>122,"date"=>"");exit;}
		if(strlen($trust_name)<1){return array("msg"=>"请输入姓名！","state"=>123,"date"=>"");exit;}
		if($userSex=='0'){return array("msg"=>"请选择性别！","state"=>124,"date"=>"");exit;}
		if (strlen($this->phone_num)<1) {return array("msg"=>"请输入手机号码！","state"=>100,"date"=>"");exit;}
		if(!preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $this->phone_num)){
  			return array("msg"=>"请输入正确手机号码","state"=>101,"date"=>"");exit;
		}
		if (strlen($this->email)<1){return array("msg"=>"请输入邮箱！","state"=>115,"date"=>"");exit;}
		if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i', $this->email)){
  			return array("msg"=>"请输入正确邮箱！","state"=>116,"date"=>"");exit;
		}
		if (($year=="年")||($month=="月")||($day=="日")){
			return array("msg"=>"请选择生日日期！","state"=>125,"date"=>"");exit;
		}
		if (($family=="")||($family_year=="年")||($family_month=="月")||($family_day=="日")){
			return array("msg"=>"请选择家人生日日期！","state"=>126,"date"=>"");exit;
		}
		if(strlen($QQ)<1){return array("msg"=>"请输入QQ号码！","state"=>127,"date"=>"");exit;}
		if(!preg_match('/^[1-9]\d{4,10}$/i',$QQ)){
  			return array("msg"=>"请输入正确邮箱！","state"=>116,"date"=>"");exit;
		}
	}
	public function changeMessageInfoUser(){
		$trust_name=$_POST["usertrustName"];
		if (!isset($_POST["userSex"])) {
			$_POST["userSex"]='0';
		}else{
			$userSex=$_POST["userSex"];
		}
		$year=$_POST["year"];
		$month=$_POST["month"];
		$day=$_POST["day"];
		$userDate=$year."-".$month."-".$day;
		$family=$_POST["family"];
		$family_year=$_POST["family_year"];
		$family_month=$_POST["family_month"];
		$family_day=$_POST["family_day"];
		$familyDate=$family_year."-".$family_month."-".$family_day;
		$QQ=$_POST["userQQ"];
		$userLocation=$_POST["userLocation"];
		$res=array("msg"=>"修改失败！","state"=>128,"date"=>"");
		if (isset($_POST["submit_message"])){
			$sql="update {$this->tab} set userName='{$this->name}',name='{$trust_name}',sex='{$userSex}',phoneNum='{$this->phone_num}',email='{$this->email}',QQ='{$QQ}',location='{$userLocation}',userFamily='{$family}',userBirth='{$userDate}',FamilyBirth='{$familyDate}' where userId='{$_SESSION['userId']}'";
		}
		$row=$this->db->otherData($sql);
		if ($row) {
			$res=array('msg'=>"修改成功",'state'=>129,'data'=>"");
		}
		return $res;
	}

	//用户安全退出
	public function userOut(){
		$_SESSION=array();
		setcookie(session_name(),'',time()-1,'/');
		session_destroy();
		return true;
	}


}
?>