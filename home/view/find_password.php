<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>密码找回_味美多蛋糕官网</title>
	<link rel="shortcut icon" href="./images/animated_favicon.gif"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="../view/css/find_password.css">
	<script  src="../view/js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
<?php include './header.php' ?>
<main>
	<?php 
		if (!isset($_GET['act'])) {
			$_GET['act']="findPwd";
		}else{
			$act = $_GET['act'];
		}
    	if (!isset($act)||($act == "findPwd")) {
	?>
	<section id="find_pwd_sec">
		<div id="find_pwd_title">找回帐户密码
			<img src="./images/find_pwd/find_pwd_1.png">
		</div>
		<div id="find_type">
			<input type="radio" id="find_1" name="find" value="手机找回" checked><label for="find_1">手机找回</label>
			<input type="radio" id="find_2" name="find" value="邮箱找回" ><label for="find_2">邮箱找回</label>
		</div>
		<!-- 手机找回 -->
		
		<div id="find_by_phone" class="find_pwd_box" >
			<h4>请输入您的手机号和验证码：</h4>
			<form id="find_phone_form" action="../api/pwdfindApi.php" method="get">
				<input type="hidden" value="pwd" name="tab"/>
				手机号：<input type="text" id="phone_num" name="phone_num">
				<input id="phone_num_button" type="button" value="获取手机验证码"><br>
				验证码：<input type="text" id="verific_code" name="verific_code"><br>
				<input type="submit" id="find_phone_submit" name="find_phone_submit">
				<div id="verific_code_box" style="display: none">
					<span>请输入以下验证码</span>
					<input type="text" id="verific_box" name="verific_box">
					<img src="../api/codeApi.php" onclick="this.src='../api/codeApi.php?t='" + Math.random() alt=""/>
					<a href="#" onclick ="check_box()">确认</a>
				</div>
			</form>
		</div>
		<!-- 邮箱找回 -->
		<div id="find_by_email" class="find_pwd_box"  style="display: none">
			<h4>请输入您的帐号和邮箱：</h4>
			<form id="find_email_form" action="../api/pwdfindApi.php" method="get">
				<input type="hidden" value="pwd" name="tab"/>
				账号：<input type="text" id="user_num" name="user_num" placeholder="账号"><br>
				邮箱：<input type="text" id="email_num" name="email_num" placeholder="邮箱"><br>
				<input type="submit" id="find_email_submit" name="find_email_submit">
			</form>
		</div>
	</section>
	<?php }elseif ($act == "rePwd") { ?>
	<section id="re_pwd_sec">
		<div id="re_pwd_title">修改帐户密码
			<img src="./images/find_pwd/find_pwd_1.png">
		</div>
		<div id="re_pwd_box">
			<form action="../api/pwdfindApi.php" method="get">
				<ul>
					<li>
						<div class="re_pwd_1">新密码</div>
						<input type="hidden" value="re_pwd" name="tab"/>
						<input type="password" id="new_Pwd" name="new_Pwd" size="25" class="re_pwd_2">
					</li>
					<li>
						<div class="re_pwd_1">确认密码</div>
						<input type="password" id="re_new_Pwd" name="re_new_Pwd" size="25" class="re_pwd_2">
					</li>
					<li>
						<div class="re_pwd_1"></div>
						<input type="submit" id="submit_new_Pwd" name="submit_new_Pwd" value="确定" class="re_pwd_3">
					</li>
				</ul>
			</form>
		</div>
	</section>
	<?php } ?>
	<?php include './footer.php'?>
	<script type="text/javascript" src="../view/js/find_password.js"></script>
</body>
</html>