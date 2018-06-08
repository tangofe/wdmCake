<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品详情_味美多蛋糕官网</title>
	<link rel="shortcut icon" href="./images/animated_favicon.gif"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="../view/css/detail_cake.css">
	<script  src="../view/js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
<?php include './header.php' ?>
<?php include('../api/jsDetailApi.php');  ?>
		 <?php  
		$tab="";
		if ($rows) {
			$tab.='<input type="hidden" id="good_cid" name="good_cid" value='.$rows['cid'].' />';
			echo $tab;
		}
	?>
	<main>
	<section id="detail_box_cake">
		<div id="float_pic">
				<h4 style="color:#A41E34">蛋糕口味</h4>
				<?php 
					if($rets){
						$tab='<a href="category.php?id=2&act=getCategoryGoods&name=天然奶油蛋糕"><span id="butter" class="taste">天然奶油</span></a>
						<a href="category.php?id=5&act=getCategoryGoods&name=慕斯蛋糕"><span id="mousse" class="taste">慕斯</span></a>
						<a href="category.php?id=11&act=getCategoryGoods&name=乳酪蛋糕"><span id="cheese" class="taste">芝士</span></a>
						<a href="category.php?id=6&act=getCategoryGoods&name=巧克力风味蛋糕"><span id="chocolate" class="taste">巧克力</span></a>
						<a href="detail_cake.php?id=4"><span class="taste">2小时闪送</span></a>';
						}
					echo $tab;
			 ?>
				<!-- <a href=""><span style="color:#A41E34;">天然奶油</span></a>
				<a href=""><span>慕斯</span></a>
				<a href=""><span>芝士</span></a>
				<a href=""><span>巧克力</span></a>
				<a href=""><span>2小时闪送</span></a> -->
		</div>
		
		<div id="detail_box" >
			<div id="current_position_detail">
				<!-- <code>></code> <a href="">蛋糕</a> <code>></code> <a href="">天然奶油蛋糕</a> <code>></code> 俏皮萌宝蛋糕    Cute Bears  -->
			</div>
			<div id="type_detail">
				<span>蛋糕分类:</span>
				<ul> 
				   <?php 
					if($rets){
						$tab='';
						foreach ($rets as $row){
							$tab.='<a href="category.php?id='.$row['id'].'&act=getCategoryGoods&name='.$row['name'].'">';
							if ($rows['cid']==$row['id']) {
								$tab.='<li style="background:#CF0F25;color:#fff" id="'.$row['name'].'">'.$row['name'].'</li></a>';
							}else{
								$tab.='<li id="'.$row['name'].'">'.$row['name'].'</li></a>';	
							}
						}
					}
					echo $tab;
			 ?> 
					<!-- <a href=""><li>不限</li></a>
					<a href=""><li style="background:#cf0f25;color: #fff ">天然奶油蛋糕</li></a>
					<a href=""><li>法式蛋糕</li></a>
					<a href=""><li>乳酪蛋糕</li></a>
					<a href=""><li>慕斯蛋糕</li></a>
					<a href=""><li>巧克力风味蛋糕</li></a>
					<a href=""><li>大型庆典蛋糕</li></a> -->
				</ul>
			</div>

			 <div id="basic_detail">
				<div id="pic_detail">
					<ul id="pic_left_detail">
						<?php  
							if($rows){
								$tab='';
								$n=0;
								if($rows['img']!=""){
									$a=htmlspecialchars_decode($rows['img']);
									preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
									//print_r($match[1]); 
								}
								$rets=$match[1];
								foreach ($rets as $ret) {
									if ($ret==$rets[0]) {
										$tab.='<li><img src="/'.$ret.'"></li>';
									}else{
										$tab.='<li style="display:none;"><img src="/'.$ret.'"></li>';
									}
								}
								
								// $tab.='<li><img src="/'.$match[1][0].'"></li>
								// 			<li><img src="/'.$match[1][1].'"></li>
								// 			<li><img src="/'.$match[1][2].'"></li>
								// 			<li><img src="/'.$match[1][3].'"></li>';
							}
							echo $tab;	
						?>
						<!-- <li><img src="images/detail/detail_1.jpg"></li>
						<li><img src="images/detail/detail_2.jpg"></li>
						<li><img src="images/detail/detail_3.jpg"></li>
						<li><img src="images/detail/detail_4.jpg"></li> -->
					</ul>
					<ul id="pic_right_detail">
						<?php  
							if($rows){
								$tab='';
								$n=0;
								if($rows['img']!=""){
									$a=htmlspecialchars_decode($rows['img']);
									preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
									//print_r($match[1]); 
								}
								$rets=$match[1];
								foreach ($rets as $ret) {
									$tab.='<li><img src="/'.$ret.'"></li>';
								}
							}
							echo $tab;	
						?>
					</ul>
				</div>
				<div id="intruduction_detail">
					<div id="remark_intru">
						<div class="like_share">
							<a href="#" onclick="return false;"><div class="like"><span><?php if($rows){ echo $rows['likenum'];} ?></span>人喜欢</div></a>
							<a href="#" onclick="return false;"><div class="share">分享</div></a>
						</div>
					</div>
					<div id="left_intru">
						<div id="name_price_intru">
							<div id="name">
								<?php if($rows){ 
									$n=strpos($rows['name']," ");
									echo substr($rows['name'],0,$n);
									echo '<br>';
									echo substr($rows['name'],$n); 
								}?>
							</div>

							<div id="price">
								<div id="other_price">.00
									<?php  
										if($rows){
										$tab='';
										$n=0;
										if($rows['pcssum']!=""){
											$pcs_types=explode("/",$rows['pcssum']);
											$tab.='/'.$pcs_types[1].'';
										}elseif($rows['pcs']!=""){
											$tab.=$rows['pcs'];
										}
										}
										echo $tab;?>
								</div>
								<span id="number_price">
								<?php  if($rows){
									$tab='';
									if($rows['pricesum']!=""){
										$pcs_types=explode("/",$rows['pricesum']);
										if (count($pcs_types)==1) {
											$tab.=$pcs_types[0];
										}else{
											$tab.=$pcs_types[1];
										}
									}else{
										$tab.=$rows['price'];
									}
									echo $tab;	
								}?>
								</span>
								<span id="symbol_price">￥</span>
							</div>
						</div>
						<div id="word_intru">
							<?php  if($rows){ 
								if ($rows['depict']!="") {
									echo str_ireplace('/','', $rows['depict']);
								}
							}?>
							<br>
							<?php  
								if ($rows['summary']!="") {
									    echo '<div style="color:#CD002D;">';
										echo str_ireplace('/','', $rows['summary']);
										echo "</div>";
									}
							?>
						</div>
					</div>

					<div id="right_intru">
						<div id="unit_intru">
							<?php  
							if($rows){
								$tab='';
								$n=0;
								if($rows['pcssum']!=""){
									//echo $rows['pcssum'];
									$pcs_types=explode("/",$rows['pcssum']);
									foreach($pcs_types as $pcs){
										$tab.='<div class="type_unit_intru">'.$pcs.'</div>';
									}
									//print_r($pcs_types);
								}
							}
							echo $tab;	
							?>
						</div>
						<div id="number_intru">
							<input type="botton" name="reduce" class="reduce_number_intru" value="-" readonly>
							<input type="text" name="number_cake" id="number_cake" class="text_number_intru"  value="1" readonly>
							<input type="botton" name="add" class="add_number_intru" value="+" readonly>
						</div>
						<div id="botton_intru">
							<input type="submit" name="botton_intru" value="加入购物车">
							<?php 
								if ($rows) {
									$tab="";
									if ($rows['id']!="") {
										$tab.='<input type="hidden" name="good_id" id="good_id" value="'.$rows['id'].'" /><input type="hidden" name="good_name" id="good_name" value="'.$rows['name'].'" />';
									}
									echo $tab;
								}
							 ?>
						</div>
					</div>
				</div>
			</div>

			<div id="more_detail">
				<div id="left_more_detail" >
					<img src="images/detail/detail_5.jpg">
					<div id="content_left_more">
						<ul id="left_more_ul">        
							<!-- <li id="content_left_1">
								<a href="#"><span>缤纷盛果蛋糕</span></a>
								<a href="#"><img src="images/detail/detail_6.jpg"></a>
							</li>
							<li id="content_left_2">
								<a href="#"><span>经典100%蛋糕</span></a>
								<a href="#" style="display: none;"><img src="images/detail/detail_6.jpg"></a>
							</li>
							<li id="content_left_3">
								<a href="#"><span>华尔兹蛋糕</span></a>
								<a href="#" style="display: none;"><img src="images/detail/detail_6.jpg"></a>
							</li>
							<li id="content_left_4">
								<a href="#"><span>经典黑森林蛋糕</span></a>
								<a href="#" style="display: none;"><img src="images/detail/detail_6.jpg"></a>
							</li>
							<li id="content_left_5">
								<a href="#"><span>提拉米苏蛋糕</span></a>
								<a href="#" style="display: none;"><img src="images/detail/detail_6.jpg"></a>
							</li>
							<li id="content_left_6">
								<a href="#"><span>富贵天喜蛋糕</span></a>
								<a href="#" style="display: none;"><img src="images/detail/detail_6.jpg"></a>
							</li>
							<li id="content_left_7">
								<a href="#"><span>芒果慕斯蛋糕</span></a>
								<a href="#" style="display: none;"><img src="images/detail/detail_6.jpg"></a>
							</li>
							<li id="content_left_8">
								<a href="#"><span>蓝莓慕斯蛋糕</span></a>
								<a href="#" style="display: none;"><img src="images/detail/detail_6.jpg"></a>
							</li>
							<li id="content_left_9">
								<a href="#"><span>纽约芝士蛋糕</span></a>
								<a href="#" style="display: none;"><img src="images/detail/detail_6.jpg"></a>
							</li>
							<li id="content_left_10">
								<a href="#"><span>俏皮萌宝蛋糕</span></a>
								<a href="#" style="display: none;"><img src="images/detail/detail_6.jpg"></a>
							</li> -->
						</ul>
					</div>
				</div>
				<div id="right_more_detail">
					<!-- 产品属性表格 -->
					<?php  
						if (isset($rows)) {
							if ($rows['prototype']!="") {
								$res=unserialize($rows['prototype']);
								$tab='';
								foreach ($res as $key => $val) {
									if (strlen($val)>0) {
										$tab.=$key;
										//$tab.='<span >'.$key.'</span><p>'.$val.'</p>';
									}
								}
								if($tab!=""){
									$tab="";
									$tab.='<div id="more_detail_1">
											<div class="title_1_more"> 
												<div class="symbol_title_detail"></div>
												<span>产品属性</span>
											</div>
											<div id="box_1_more">';
									foreach ($res as $key => $val) {
										if (strlen($val)>0) {
											$tab.='<span >'.$key.':</span><p>'.$val.'</p>';
										}
									}
									$tab.='</div>';
								}
							}
							if ($rows['cnt']!="") {
								$a=htmlspecialchars_decode($rows['cnt']);
								preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
								foreach ($match[1] as $res) {
									$tab.='<img src="/'.$res.'">';
								}
								$tab.='</div>';
							}
						//echo $tab;
						}
						echo $tab;
					?> 
					<!-- 产品规格及配套餐具 -->
					<?php if (isset($rows)) {
						if ($rows['sizeimg']!='') {
							$tab="";
							$tab.='<div id="more_detail_2">
								<div class="title_1_more"> 
									<div class="symbol_title_detail"></div>
									<span>产品规格及配套餐具</span>
								</div>
								<div id="box_2_more">';
							$a=htmlspecialchars_decode($rows['sizeimg']);
							preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
							foreach ($match[1] as $res) {
								$tab.='<img src="/'.$res.'">';
							}
							$tab.='</div></div>';
							echo $tab;
						}
						
					} ?>
							<!-- <img src="images/detail/table_detail.jpg"> -->
						<!-- 温馨提示 -->
					<div id="more_detail_3">
						<!-- <div class="title_1_more"> 
							<div class="symbol_title_detail"></div>
							<span>温馨提示</span>
						</div>
						<div id="box_3_more"> -->
							<!-- <div class="article_3_more">
								<span>1、</span>
								<p>为保证您能及时收到订单商品，天然奶油蛋糕30cm（含）以下规格需要您至少提前4小时预订，30cm以上规格及大型庆典蛋糕，需要您提前两天16：00前预订，慕斯蛋糕、乳酪蛋糕、巧克力风味蛋糕及糖醇坯蛋糕，需要您提前一天16:00前预订，特殊款蛋糕预订时间以商品页面提示为准。</p>
							</div>
							<div class="article_3_more">
								<span>2、</span>
								<p>味多美官网及微信端可24小时自助在线订购，当您操作不便时，您可以拨打我们的客服电话，将您想购买的商品名称、规格、数量、详细配送地址、配送时间、收货人及要求等告诉我们的客服人员，客服人员会帮您完成商品订购。<br>客服热线电话：4001-170-170（服务时间08:00-21:00）</p>
							</div>
							<div class="article_3_more">
								<span>3、</span>
								<p>目前支持在线支付宝、网银及微信支付，货到现金付款、门店现金/银联/味多美充值卡等付款方式。</p>
							</div>
							<div class="article_3_more">
								<span>4、</span>
								<p>配送范围及费用：北京市五环内，订购蛋糕满188元/西点满268元免费配送，订单商品金额低于蛋糕188元/西点268元，需收取10元/单配送费；北京市五环外六环内，以五环为起点收取6元/公里配送费，具体以下单后客服确认的实际费用为准；通州区、亦庄开发区、大兴区政府、石景山区、昌平区政府、天通苑地区、朝阳区北苑、上地地区、清河地区、回龙观地区离店4公里范围内免费配送，离店4公里以上，从五环起收取6元/公里配送费；远郊区、县（房山、延庆、怀柔、密云、平谷及六环外）暂不支持配送；春节期间初一至初六暂停配送服务。</p>
							</div>
							<div class="article_3_more">
								<span>5、</span>
								<p>使用味多美充值卡及其他福利卡，订购蛋糕满188元且直径40cm以下/西点满268元且2000元以下，北京市五环内收取20元配送费；大型蛋糕（直径40cm以上或多层）/西点满2000元，五环内收取30元配送费。五环外六环内以五环为起点另加收6元/公里配送费。</p>
							</div>
							<div class="article_3_more">
								<span>6、</span>
								<p>配送时间：免费配送区域10:00-20:00，五环-六环收费配送区域11:00-19:00。</p>
							</div>
							<div class="article_3_more">
								<span>7、</span>
								<p>蛋糕价格变动以官网及门店价格为准，部分产品采用应季水果点缀，会随季节的变化有所调整，产品以实物为准。由于供货原因全球选购的原料产地会有所变化。</p>
							</div>
							<div class="article_3_more">
								<span>8、</span>
								<p>味多美官网代金券仅支持在线支付时（支付宝支付、网银支付、微信支付）使用。</p>
							</div>
							<div class="article_3_more">
								<span>9、</span>
								<p>味多美可提供蛋糕、粽子、月饼提货卡等产品的企事业单位团体订购及企业福利外包服务，期待与广大合作伙伴开放合作。 咨询热线：4001-170-170转2或5（北京），021-52277820（上海）</p>
							</div> -->
						<!-- </div> -->
					</div>
				</div> 
			</div>
		</div>
	</section>
	<?php include './footer.php'; ?>
		<?php 
		$tab="";
		$tab.='<script>
			function detail_pcs_chois(){
				$("#unit_intru div").click(function(){
					var t=$(this).index();';
		if($rows){
			if($rows['pcssum']!=""){
				$pcs_types=explode("/",$rows['pcssum']);
				$pcs_types_2=explode("/",$rows['pricesum']);
				if (isset($pcs_types[0])&&($pcs_types[0]!='')) {
					$tab.='
					if(t=="0"){
						$("#other_price").text(".00/'.$pcs_types[0].'");
						$("#number_price").text("'.$pcs_types_2[0].'");
					}';
				}
				if (isset($pcs_types[1])&&($pcs_types[1]!='')) {
					$tab.='
					if(t=="1"){
						$("#other_price").text(".00/'.$pcs_types[1].'");
						$("#number_price").text("'.$pcs_types_2[1].'");
					}';
				}
				if (isset($pcs_types[2])&&($pcs_types[2]!='')) {
					$tab.='
					if(t=="2"){
						$("#other_price").text(".00/'.$pcs_types[2].'");
						$("#number_price").text("'.$pcs_types_2[2].'");
					}';
				}
				if (isset($pcs_types[3])&&($pcs_types[3]!='')) {
					$tab.='
					if(t=="3"){
						$("#other_price").text(".00/'.$pcs_types[3].'");
						$("#number_price").text("'.$pcs_types_2[3].'");
					}';
				}
			}
		}
			
		
		
		$tab.='
			var x=parseInt($("#number_intru input").eq(1).val());//数量框数值
			var y=parseInt($("#number_price").text());
			var obj=parseInt(y*x);
			$("#number_price").text(obj);
			})
			}
			$(detail_pcs_chois);
		</script>';
		echo $tab;
	 ?>
	 <script>
  	function changeColor(){
  		$(".taste").mouseover(function(){
  			$(this).css("color","#A41E34");
  		});
  		$(".taste").mouseout(function(){
  			$(this).css("color","#242C29");
  		});
  	}
  	$(changeColor);
  </script>
	<script type="text/javascript" src="../view/js/detail_cake.js"></script>
	
</body>
</html>