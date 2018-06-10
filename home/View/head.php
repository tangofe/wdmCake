<?php  
if(!isset($_SESSION)){
	session_start();
}
if (!isset($_SESSION['roleId'])||($_SESSION['roleId']=='1')) {
	echo "<script>alert('您不存在该权限！');window.location.href='../view/login.php';</script>";
	exit;
}
?>
<div id="head"><!---head---->
    <img src="./images/logo_hou.png" alt="">
	<h1>味多美蛋糕后台管理系统</h1>
	<div id="welcome">
      	<span><?php if ($_SESSION['roleId']=='3') {
                echo "超级管理员：";
            }else{
                echo "管理员：";
            } ?>&nbsp;&nbsp;</span>
      	<span id="user" style="color: #A41E34">
		<?php 
		if(isset($_SESSION['user'])){
			echo $_SESSION['user'];
		}else{
			//echo "nouser";
			echo "游客";
			//echo "<script>window.location.href='login.php';</script>";
		}
		?>
		</span>
      	<span>&nbsp;&nbsp;欢迎你!&nbsp;&nbsp;</span>		  
      	<span id="login_out" ><a  href="../Api/checkUserApi.php?act=out" >[安全退出]</a></span>
	</div>
</div><!---head---->
