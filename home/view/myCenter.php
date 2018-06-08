<?php  
session_start();
if (!isset($_SESSION['userId'])) {
	echo "<script>window.location.href='../view/login_register_cake.php';</script>";
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户中心_味美多蛋糕官网</title>
	<link rel="shortcut icon" href="./images/animated_favicon.gif"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="../view/css/myCenter.css">
	<script  src="../view/js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
<?php include './header.php' ?>
<?php include '../api/getGoodsOrderApi.php';?>
	<main>
		<section id="myCenterBox">
			<div class="title_myCenter">首页  > <span>会员中心</span></div>
			<div id="main_box_myCenter">
				<div id="left_menu_myCenter">
					<?php 
						if (!isset($_GET['id'])) {
							$_GET['act']="0";
						}else{
							$act = $_GET['id'];
						} 
					?>
					<div class="left_menu_title">
						<h4>我的购物车</h4>
						<div>
							<?php if (isset($act)&&($act == "1")) { ?>
							<div class="dot" >·</div>
							<?php } ?>
							<a href="../view/myCenter.php?id=1">我的订单</a>
						</div>
						<div>
							<?php if (isset($act)&&($act == "2")) { ?>
							<div class="dot">·</div>
							<?php } ?>
							<a href="../view/myCenter.php?id=2">我的收藏</a>
						</div>
					</div>
					<div class="left_menu_title">
						<h4>我的账户</h4>
						<div>
							<?php if (isset($act)&&($act == "3")) { ?>
							<div class="dot">·</div>
							<?php } ?>
							<a href="../view/myCenter.php?id=3">我的积分</a>
						</div>
						<div>
							<?php if (isset($act)&&($act == "4")) { ?>
							<div class="dot">·</div>
							<?php } ?>
							<a href="../view/myCenter.php?id=4">我的代金券</a>
						</div>
					</div>
					<div class="left_menu_title">
						<h4>个人信息管理</h4>
						<div>
							<?php if (isset($act)&&($act == "5")) { ?>
							<div class="dot">·</div>
							<?php } ?>
							<a href="../view/myCenter.php?id=5">修改个人信息</a>
						</div>
						<div>
							<?php if (isset($act)&&($act == "6")) { ?>
							<div class="dot">·</div>
							<?php } ?>
							<a href="../view/myCenter.php?id=6">修改密码</a>
						</div>
						<div>
							<?php if (isset($act)&&($act == "7")) { ?>
							<div class="dot">·</div>
							<?php } ?>
							<a href="../view/myCenter.php?id=7">修改收货地址</a>
						</div>
						<div>
							<a href="../api/useroutApi.php" >退出</a>
						</div>
					</div>
				</div>
				<div id="right_menu_myCenter">
					<?php if (!isset($act)||($act == "0")) { ?>
					<!-- 个人中心主页面 -->
					<div id="user_info">
						<h4>亲爱的<span>13631788914</span>，欢迎进入会员中心！</h4>
						<div class="information">
							<div>您目前是:<span style="color:#cf0f25">注册会员</span></div>
							<div></div>
							<div>账户总积分：<span>0</span>积分</div>
							<div>预存款余额：<span>￥0.00</span></div>
							<div>交易提醒：未付款订单<span class="red"><?php if (!$rows=='') {
									$count=0;
			                        foreach ($rows as $row) {
			                        	if($row['order_status']==1){
			                        		$count++;
			                        	}
			                        }
			                        echo $count;
			                    }?>
				            </span></div>
						</div>
						<div class="userOrder">
							<div class="user_title">
								<div class="lump"></div>
								我的订单
								<a href="#" onclick="order_collect_adress(this)">所有的订单</a>
							</div>
							<div class="user_text">
								<table border=0 cellpadding=0 cellspacing=0>
									<tr>
										<th>订单编号</th>
										<th>金额</th>
										<th>下单时间</th>
										<th>订单状态</th>
										<th>操作</th>
									</tr>
									<?php if (!$rows=='') {
										$tab="";
				                        foreach ($rows as $row) {
				                        	$tab.='<tr><th>'.$row['orderid'].'</th>
												<th>'.$row['money'].'</th>
												<th>'.$row['post_time'].'</th>';
											if ($row['order_status']==1) {
												$tab.='<th>待处理</th><th><a href="#">去支付</a></th>';
											}elseif ($row['order_status']==2) {
												$tab.='<th>已提交</th><th><a href="#">查看状态</a></th>';
											}elseif ($row['order_status']==3) {
												$tab.='<th>已发货</th><th><a href="#">查看物流</a></th>';
											}else{
												$tab.='<th>已退货</th><th><a href="../api/getGoodsOrderApi.php?act=delete&id='.$row['id'].'">删除</a></th>';
											}
											$tab.='</tr>';
				                        }
				                        echo $tab;
				                    	}?>
								</table>
							</div>
						</div>
						<div class="userCollect">
							<div class="user_title">
								<div class="lump"></div>
								我的收藏
								<a href="#" onclick="order_collect_adress(this)">所有的收藏</a>
							</div>
							<div class="user_text">
								<table border=0 cellpadding=0 cellspacing=0>
									<tr>
										<th>商品名称</th>
										<th>商品价格</th>
										<th>是否有货</th>
										<th>操作</th>
									</tr>
								</table>
							</div>
						</div>
					</div><!-- 主页面代码结束 -->
					<?php }elseif ($act == "1") { ?>
					<!-- 我的订单 -->
					<div id="user_order">
						<div class="userOrder">
							<div class="user_title">
								<div class="lump"></div>
								我的订单
							</div>
							<div class="user_text">
								<table border=0 cellpadding=0 cellspacing=0>
									<tr>
										<th>订单编号</th>
										<th>金额</th>
										<th>下单时间</th>
										<th>订单状态</th>
										<th>操作</th>
									</tr>
									<?php if (!$rows=='') {
										$tab="";
				                        foreach ($rows as $row) {
				                        	$tab.='<tr><th>'.$row['orderid'].'</th>
												<th>'.$row['money'].'</th>
												<th>'.$row['post_time'].'</th>';
											if ($row['order_status']==1) {
												$tab.='<th>待处理</th><th><a href="#">去支付</a></th>';
											}elseif ($row['order_status']==2) {
												$tab.='<th>已提交</th><th><a href="#">查看状态</a></th>';
											}elseif ($row['order_status']==3) {
												$tab.='<th>已发货</th><th><a href="#">查看物流</a></th>';
											}else{
												$tab.='<th>已退货</th><th><a href="../api/getGoodsOrderApi.php?act=delete&id='.$row['id'].'">删除</a></th>';
											}
											$tab.='</tr>';
				                        }
				                        echo $tab;
				                    	}?>
								</table>
							</div>
						</div>
						<div class="page">
								<div class="page_count">总计：0  |  共：1页</div>
								<div class="page_number"><a href="">1</a></div>
						</div>
					</div><!-- 我的订单结束 -->
					<?php }elseif ($act == "2") { ?>
					<!-- 我的收藏 -->
					<div id="user_collect">
						<div class="userCollect">
							<div class="user_title">
								<div class="lump"></div>
								我的收藏
							</div>
							<div class="user_text">
								<table border=0 cellpadding=0 cellspacing=0>
									<tr>
										<th>商品名称</th>
										<th>商品价格</th>
										<th>是否有货</th>
										<th>操作</th>
									</tr>
								</table>
							</div>
						</div>
					</div><!-- 我的收藏结束 -->
					<?php }elseif ($act == "3") { ?>
					<!-- 我的积分 -->
					<div id="user_integral">
						<div class="user_title">
								<div class="lump"></div>
								我的积分
						</div>
						<div class="intergral_box">您当前可用积分： <span style="color: #cf0f25">0</span>  分
						</div>
					</div><!-- 我的积分结束 -->
					<?php }elseif ($act == "4") { ?>
					<!-- 我的代金券 -->
					<div id="user_voucher">
						<div class="user_title">
								<div class="lump"></div>
								我的代金券信息
						</div>
						<div class="type_voucher">
							<div class="type_sub1"><a href="">未用代金券</a></div>
							<div class="type_sub2"><a href="">已用代金券</a></div>
							<div class="type_sub2"><a href="">已过期代金券</a></div>
						</div>
						<div class="user_text">
							<table border=0 cellpadding=0 cellspacing=0>
								<tr>
									<th>代金券名称</th>
									<th>号码</th>
									<th>金额</th>
									<th>最小订单金额</th>
									<th>有效期</th>
									<th>状态</th>
								</tr>
							</table>
						</div>
						<div id="input_voucher">
							<form action="">
								代金券序列号
								<input type="text" id="input_voucher_box" name="input_voucher_box" size="30">
								<input type="submit" id="submit_voucher_box" name="submit_voucher_box" value="添加代金券">
							</form>
						</div>
						<div id="method_voucher">
							<div class="method_title">如何使用代金券</div>
							<img src="./images/myCenter/user_method.jpg" alt="">
						</div>
					</div><!-- 我的代金券结束 -->
					<?php }elseif ($act == "5") { ?>
					<!-- 修改个人信息 -->
					<div id="user_message">
						<div class="user_title">
								<div class="lump"></div>
								修改个人信息
						</div>
						<div id="user_message_box">
							<span>&nbsp&nbsp&nbsp  首次完善以下个人信息，即可获赠官网会员20积分。信息保存后不可修改，请准确填写，我们将会在您及您的家人生日时送上真挚的祝福。</span>
							<form action="../api/userinsertApi.php" method="post">
								<ul class="message_box_form">
									<li>
										<div class="message_li_1"><span>*</span>昵称: &nbsp</div>
										<input type="text" id="userName" name="userName" class="message_li_2">
									</li>
									<li>
										<div class="message_li_1"><span>*</span>真实姓名: &nbsp</div>
										<input type="text" id="usertrustName" name="usertrustName" class="message_li_2">
									</li>
									<li>
										<div class="message_li_1"><span>*</span>性别: &nbsp</div>
										<input type="radio" id="userSex_1" name="userSex" value="男" class="message_li_3" /><code>男</code>
										<input type="radio" id="userSex_2" name="userSex" value="女" class="message_li_3" /><code>女</code>
									</li>
									<li>
										<div class="message_li_1"><span>*</span>手机: &nbsp</div>
										<input type="text" id="userModile" name="userModile" class="message_li_2">
									</li>
									<li>
										<div class="message_li_1"><span>*</span>邮箱: &nbsp</div>
										<input type="text" id="userEmial" name="userEmial" class="message_li_2">
									</li>
									<li>
										<div class="message_li_1"><span>*</span>我的生日: &nbsp</div>
										<select class="message_li_4" id="year" name="year">
											<!-- <option value ="volvo">年</option>
  											<option value ="volvo">1995</option>
 											<option value ="saab">1996</option>
  											<option value="opel">1997</option>
  											<option value="audi">1997</option> -->
										</select>
										<select class="message_li_4" id="month" name="month">
											<!-- <option value ="volvo">月</option>
  											<option value ="volvo">1</option>
 											<option value ="saab">2</option>
  											<option value="opel">3</option>
  											<option value="audi">4</option> -->
										</select>
										<select class="message_li_4" id="day" name="day">
											<!-- <option value ="volvo">日</option>
  											<option value ="volvo">1</option>
 											<option value ="saab">2</option>
  											<option value="opel">3</option>
  											<option value="audi">4</option> -->
										</select>
									</li>
									<li>
										<div class="message_li_1"><span>*</span>我的家人生日: &nbsp</div>
										<select class="message_li_4" id="family" name="family">
											<option value =" "> </option>
  											<option value ="爸爸">爸爸</option>
 											<option value ="妈妈">妈妈</option>
  											<option value="兄弟">兄弟</option>
  											<option value="姐妹">姐妹</option>
  											<option value="男朋友">情侣</option>
										</select>
										<select class="message_li_4" id="family_year" name="family_year">
											<!-- <option value ="年">年</option>
  											<option value ="1995">1995</option>
 											<option value ="1996">1996</option>
  											<option value="1997">1997</option>
  											<option value="1997">1997</option> -->
										</select>
										<select class="message_li_4" id="family_month" name="family_month">
											<!-- <option value ="月">月</option>
  											<option value ="1">1</option>
 											<option value ="2">2</option>
  											<option value="3">3</option>
  											<option value="4">4</option> -->
										</select>
										<select class="message_li_4" id="family_day" name="family_day">
											<!-- <option value ="日">日</option>
  											<option value ="1">1</option>
 											<option value ="2">2</option>
  											<option value="3">3</option>
  											<option value="4">4</option> -->
										</select>
									</li>
									<script>
											function selectbox(){
												var tab='';
												//年
												tab+='<option value ="年">年</option>';
												for(var i=1960;i<2018;i++){
													tab+='<option value ="'+i+'">'+i+'</option>';
												}
												$("#year").html(tab);
												$("#family_year").html(tab);
												//月
												tab="";
												tab+='<option value ="月">月</option>';
												for(var i=1;i<13;i++){
													tab+='<option value ="'+i+'">'+i+'</option>';
												}
												$("#month").html(tab);
												$("#family_month").html(tab);
												//日
												tab="";
												tab+='<option value ="日">日</option>';
												for(var i=1;i<32;i++){
													tab+='<option value ="'+i+'">'+i+'</option>';
												}
												$("#day").html(tab);
												$("#family_day").html(tab);
											}
											$(selectbox);
										</script>
									<li>
										<div class="message_li_1"><span>*</span>QQ: &nbsp</div>
										<input type="text" id="userQQ" name="userQQ" class="message_li_2">
									</li>
									<li>
										<div class="message_li_1"><span>*</span>所在地: &nbsp</div>
										<select class="message_li_4" name="userLocation">
											<option value ="北京">北京</option>
										</select>
									</li>
									<li>
										<div class="message_li_1"></div>
										<input type="submit" id="submit_message" name="submit_message" value="保存信息" class="message_li_5">
									</li>
								</ul>
							</form>
						</div>
					</div><!-- 修改个人信息结束 -->
					<?php }elseif ($act == "6") { ?>
					<!-- 修改密码 -->
					<div id="user_changePwd">
						<div class="user_title">
								<div class="lump"></div>
								修改密码
						</div>
						<div class="revise_point">为了您的账户安全，请不要泄漏给他人使用</div>
						<form action="../api/changePwdApi.php" id="changePwd_form_ul" method="post">
							<ul class="message_box_form">
								<li style="margin-top:10px;">
									<div class="message_li_1">原密码: &nbsp</div>
									<input type="password" id="old_Pwd" name="old_Pwd" class="message_li_2">
								</li>
								<li style="margin-top:10px;">
									<div class="message_li_1">新密码: &nbsp</div>
									<input type="password" id="new_Pwd" name="new_Pwd" class="message_li_2">
								</li>
								<li style="margin-top:10px;">
									<div class="message_li_1">确认密码: &nbsp</div>
									<input type="password" id="re_Pwd" name="re_Pwd" class="message_li_2">
								</li>
								<li style="margin-top:10px;">
									<div class="message_li_1"></div>
									<input type="submit" id="submit_changePwd" name="submit_changePwd" value="确认修改" class="message_li_5">
								</li>
							</ul>
						</form>
					</div><!-- 修改密码结束 -->
					<?php }elseif ($act == "7") { ?>
					<!-- 修改收货地址 -->
					<div id="user_address">
						<div class="user_title">
								<div class="lump"></div>
								修改收货地址
								<span style="color:#cf0f25 ">+</span><a href="#" onclick="order_collect_adress(this)">&nbsp添加收货地址</a>
						</div>
						<div class="revise_point">已有<span style="color:#cf0f25">0</span>收货地址（最多添加10个收货地址）</div>
						<div class="user_text">
							<table border=0 cellpadding=0 cellspacing=0>
								<tr>
									<th>地址</th>
									<th>收货人</th>
									<th>联系电话</th>
									<th>操作</th>
								</tr>
							</table>
						</div>
					</div><!-- 修改收货地址结束 -->
					<?php } ?>
				</div>
			</div>
		</section>
		<div class="allAboutUs clearfix">
        <div class="container">
            <ul class="list-inline clearfix">
                <li><a href=""><h4>帮助中心</h4></a><a href="">购物帮助</a><a href="">支付方式</a><a href="">配送方式</a></li>
                <li><a href=""><h4>门店服务</h4></a><a href="">门店查询</a><a href="">购卡须知</a><a href="">提货卡/积分卡查询</a></li>
                <li><a href=""><h4>关于我们</h4></a><a href="">了解味多美</a><a href="">味多美新闻</a><a href="">加入味多美</a></li>
                <li><a href=""><h4>关注我们</h4></a><a href="">官方微博</a><a href="">美粉社区</a><a href="" style="height: 20px"></a></li>
                <li><img src="image/twoMa.jpg" alt=""><span>关注美味多微信</span><span>了解最新会员活动</span></li>
            </ul>
        </div>
        </div>
	</main>
	<script type="text/javascript" src="../view/js/myCenter.js"></script>
</body>
</html>