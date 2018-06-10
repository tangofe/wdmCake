<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录注册_味美多蛋糕官网</title>
	<link rel="shortcut icon" href="./images/animated_favicon.gif"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="../view/css/login_register_cake.css">
	<script  src="../view/js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
<?php include './header.php' ?>
<main>
	
<section id="log_reg_cake">
		<div id="log_reg_box">
			<?php 
				if (!isset($_GET['act'])) {
					$_GET['act']="login";
				}else{
					$act = $_GET['act'];
				}
            	if (!isset($act)||($act == "login")) {
	 		?>
			<!-- 登录部分代码 -->
			<div id="log_box" style="display: block;">
				<ul id="type_log_box">
					<li><input type="radio" id="log_1" name="log" value="普通会员登录" checked><label for="log_1">普通会员登录</label></li>
					<li><input type="radio" id="log_2" name="log" value="手机动态码登录"><label for="log_2">手机动态码登录</label></li>
				</ul>
				<form id="form_box_log" action="../api/userlogApi.php" method="post">
					<div id="box_float_phone">
						<p>请输入以下验证码</p>
						<div> 
							<input type="text" id="letter_check_log" name="letter_check_log" value placeholder="验证码">
							<img src="../api/codeApi.php" onclick="this.src='../api/codeApi.php?t='" + Math.random() alt=""/>
						</div>
						<div class="confirm_box"><a href="#" onclick="confirm_fun(this)">确认</a></div>
					</div>
					<!-- 账号登录 -->
					<ul id="form_name_log">
						<li><input type="text" name="log_name" placeholder="用户名/手机/邮箱"></li>
						<li><input type="password" name="password" placeholder="输入密码"></li>
						<li class="type_li_log">
							<a href="./find_password.php?act=findPwd">忘记密码？</a>
							<input type="checkbox" id="checkbox_log" checked="true"><label for="checkbox_log"> 7天内自动登录</label>
						</li>
						<li class="type_li_log"><input type="submit" id="submit_log" name="submit_1" value="登录"></li>
						<li><a href="./login_register_cake.php?act=register">没有账号？立即注册</a></li>
					</ul>
					<!-- 手机号码登录 -->
					<ul id="form_phone_log">
						<li><input type="text" id="log_phnum1" name="log_phnum" placeholder="请输入你的手机号"></li>
						<li >
							<input type="text" id="log_phnum" name="log_phonenum" placeholder="请输入短信验证码">
							<input type="button" id="button_log" name="button_log" value="获取短信验证码">
						</li>
						<li class="type_li_log"><input type="submit" id="submit_log" name="submit_2" value="登录"></li>
					</ul>
				</form>
				<p>温馨提示：<br>成功注册会员，登录后首次完善个人信息，即可获赠官网会员20积分</p>
			</div>
			<?php }elseif ($act == "register") { ?>
			<!-- 注册部分 -->
			<div id="reg_box" style="display: block;">
				<h4>用户注册</h4>
				<form action="../api/userregApi.php" method="post">
					<div id="box_float2_phone">
						<p>请输入以下验证码</p>
						<div>
							<input type="text" name="letter_check_log" placeholder="验证码">
							<img src="../api/codeApi.php" onclick="this.src='../api/codeApi.php?t='" + Math.random() alt=""/>
						</div>
						<div class="confirm_box"><a href="#" onclick="confirm_fun(this)">确认</a></div>
					</div>
					<ul id="form_box_reg">
						<li><input type="text" name="reg_phoen_num" placeholder="请输入你的手机号"></li>
						<li>
							<input type="text" id="reg_phnum" name="reg_phnum" placeholder="请输入短信验证码">
							<a href="#">获取短信验证码</a>
						</li>
						<li><input type="password" name="reg_password" placeholder="请输入6位以上密码"></li>
						<li><input type="password" name="reg_repassword" placeholder="确认密码"></li>
						<li><input type="submit" id="submit_reg" name="reg_submit" value="注册"></li>
					</ul>

				</form>
				<p>温馨提示：<br>成功注册会员，登录后首次完善个人信息，即可获赠官网会员20积分</p>
			</div>
			<?php } ?>
		</div>
	</section>
	 <?php include './footer.php'?>
	<script type="text/javascript" src="../view/js/log_reg_cake.js"></script>
</body>
</html>