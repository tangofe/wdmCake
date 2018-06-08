<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>商品_味美多蛋糕官网</title>
</head>
<link rel="shortcut icon" href="./images/animated_favicon.gif"/>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="./css/category.css">
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<style>
	.active {
		color: red;
	}
</style>
<body>
	<?php
			include('../api/GoodsApi.php');
	?>
<?php include './header.php' ?>
<main>
	<section id="detail_box_cake">
		<div id="float_pic">
				<h4 style="color:#676767">蛋糕口味</h4>
				<?php 
					if($rets){
						$tab='<a href="category.php?id=2&act=getCategoryGoods&name=天然奶油蛋糕"><span id="butter" class="taste">天然奶油</span></a>
						<a href="category.php?id=5&act=getCategoryGoods&name=慕斯蛋糕"><span id="mousse" class="taste">慕斯</span></a>
						<a href="category.php?id=11&act=getCategoryGoods&name=乳酪蛋糕"><span id="cheese" class="taste">芝士</span></a>
						<a href="category.php?id=6&act=getCategoryGoods&name=巧克力风味蛋糕"><span id="chocolate" class="taste">巧克力</span></a>
						<a href="detail_cake.php?id=4"><span class="taste">2小时闪送</gifspan></a>';
						}
					echo $tab;
			 ?>
				<!-- <a href="category.php?id=&act=getCategoryGoods&name='.$row['name'].'"><span style="color:#A41E34;">天然奶油</span></a>
				<a href=""><span>慕斯</span></a>
				<a href=""><span>芝士</span></a>
				<a href=""><span>巧克力</span></a>
				<a href=""><span>2小时闪送</span></a> -->
		</div>
        <?php
        	if(isset($_GET['cateId'])){
            $cateId = $_GET['cateId'];
        }else{
        	$cateId=1;
        }
            if ($cateId == 1) {
        ?>
		<div id="cakepage" class="detail_box" >
			<div id="current_position_detail">当前位置:<a href="indexcake.php">首页</a> <code>></code> <a href="category.php">蛋糕</a>
				<?php
				if(isset($_GET['name'])){
				 echo '<code>></code><a href="">'.$_GET['name'].'</a>';

				}
			 ?>  
			 
			</div>
			<div id="type_detail">
				<span>蛋糕分类:</span>
				<ul>
					<?php 
					if($rets){
						$tab='';
						foreach ($rets as $row){
							$tab.='<a href="category.php?id='.$row['id'].'&act=getCategoryGoods&name='.$row['name'].'"><li id="'.$row['name'].'">'.$row['name'].'</li></a>';
						}
					}
					echo $tab;
			 ?>
					<!-- <a href="#"><li style="background:red;color: #fff ">天然奶油蛋糕</li></a>
					<a href="#"><li>法式蛋糕</li></a>
					<a href="#"><li>乳酪蛋糕</li></a>
					<a href="#"><li>慕斯蛋糕</li></a>
					<a href="#"><li>巧克力风味蛋糕</li></a>
					<a href="#"><li>大型庆典蛋糕</li></a> -->
				</ul>
			</div>
		<ul id="list_goods_box" class="list_box">
			<?php 
				if($rows){
					$tab='';
					$n=0;
					foreach ($rows as $row){
						if($row['cid']==12||$row['cid']==13||$row['cid']==15||$row['cid']==16){}else{
						$n++;
						if($row['img']!=""){
							// echo "a";
							$a=htmlspecialchars_decode($row['img']);
							preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
						// 	echo "<pre>";
						// print_r($match[1][0]);
						// echo "<pre>";
						$tab.='<li>
				<div class="goods_img">
					<a id="goodsimg" href="./detail_cake.php?id='.$row['id'].'"><img src="/'.$match[1][0].'"></a>
				</div>
				<div class="goods_box">
					<div class="goods_body_text">
						<div class="goods_name">
							<a id="good_name" class="gn_color" href="./detail_cake.php?id='.$row['id'].'" target="_blank">'.$row['name'].'</a>
						</div>
						<div class="goods_depict">'.$row['depict'].'</div>
						<div class="goods_summary">
							<span style="color:#bc002d; font-size:12px;">'.$row['summary'].'</span>
						</div>
					</div>
					<div class="goods_operate">
						<div class="like_red">
							<a href="#" class="like" onclick="return false">
								<img src="./images/product/0.gif" alt="">
							</a>
							<span class="like_num">'.$row['likenum'].'</span>
							<input type="hidden" id="like_status" name="like_status" value="1"/>
							人喜欢
						</div>
						<div class="clear"></div>
						<div id="price">
							<span id="symbol_price">￥</span>
							<span id="number_price">'.$row['price'].'</span>
							<div id="other_price"><span>.00</span>/<span id="pcs">'.$row['pcs'].'</span></div>
						</div>
						<div class="sub">
							<input type="hidden" id="goods_id" value="'.$row['id'].'" >
							<div class="submit_goods" onclick="buyGoods(this)">
								立即购买
							</div>
							<div class="submit_goods">
								<a href="./detail_cake.php?id='.$row['id'].'">查看详情</a>
							</div>
						</div>
					</div>
				</div>	
			</li>';
					}
				}
				}
				}
				if(isset($res)){
					$tab='';
					$n=0;
					foreach ($res as $row){
						$n++;
						if(isset($row['img'])&&($row['img']!="")){
							$ret=$row['img'];
							$a=htmlspecialchars_decode($ret);
							preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
							$row['img']=$match[1][0];
						}
						$tab.='<li>
				<div class="goods_img">
					<a id="goodsimg" href="./detail_cake.php?id='.$row['id'].'"><img src="/'.$row['img'].'"></a>
				</div>
				<div class="goods_box">
					<div class="goods_body_text">
						<div class="goods_name">
							<a id="good_name" class="gn_color" href="./detail_cake.php?id='.$row['id'].'" target="_blank">'.$row['name'].'</a>
						</div>
						<div class="goods_depict">'.$row['depict'].'</div>
						<div class="goods_summary">
							<span style="color:#bc002d; font-size:12px;">'.$row['summary'].'</span>
						</div>
					</div>
					<div class="goods_operate">
						<div class="like_red">
							<a href="#" class="like" onclick="return false">
								<img src="./images/product/0.gif" alt="">
							</a>
							<span class="like_num">'.$row['likenum'].'</span>
							<input type="hidden" id="like_status" name="like_status" value="1"/>
							人喜欢
						</div>
						<div class="clear"></div>
						<div id="price">
							<span id="symbol_price">￥</span>
							<span id="number_price">'.$row['price'].'</span>
							<div id="other_price"><span>.00</span>/<span id="pcs">'.$row['pcs'].'</span></div>
						</div>
						<div class="sub">
							<input type="hidden" id="goods_id" value="'.$row['id'].'" >
							<div class="submit_goods" onclick="buyGoods(this)">
								立即购买
							</div>
							<div class="submit_goods">
								<a href="./detail_cake.php?id='.$row['id'].'">查看详情</a>
							</div>
						</div>
					</div>
				</div>	
			</li>';
					}
				}
					echo $tab;
				
			 ?>
			<!-- <li>
				<div class="goods_img">
					<a href="#"><img src="./images/product/1.gif" alt=""></a>
				</div>
				<div class="goods_box">
					<div class="goods_body_text">
						<div class="goods_name">
							<a class="gn_color" href="#" target="_blank">经典100%蛋糕 Classical Natural Cream</a>
						</div>
						<div class="goods_depict">/100%使用进口天然稀奶油；奶油丰富，简约时尚，享受经典原味。/</div>
					</div>
					<div class="goods_operate">
						<div class="like_red">
							<a href="#">
								<img src="./images/product/0.gif" alt="">
							</a>
							<span class="like_num">307721</span>
							人喜欢
						</div>
						<div class="clear"></div>
						<div id="price">
							<span id="symbol_price">￥</span>
							<span id="number_price">198</span>
							<div id="other_price"><span>.00</span>/Φ20cm</div>
						</div>
						<div class="sub">
							<div class="submit_goods">
								<a href="#">立即购买</a>
							</div>
							<div class="submit_goods">
								<a href="#">查看详情</a>
							</div>
						</div>
					</div>
				</div>	
			</li> -->
		</ul>
		<div class="page">
			<div class="page_count">总计：<?php echo $n; ?>  |  共1页</div>
		</div>
	</div>
        <?php } else if ( $cateId == 2) {?>

	<div id="goodcard" class="detail_box">
			<div id="current_position_detail">当前位置:<a href="indexcake.php">首页</a> <code>></code> <a href="">提货卡券</a>   
			</div>
		<ul class="list_box">
			<?php 
				if($rows){
					$tab='';
					$n=0;
					foreach ($rows as $row){
						if($row['cid']==12){
						$n++;
						if($row['img']!=""){
							// echo "a";
							$a=htmlspecialchars_decode($row['img']);
							preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
						// 	echo "<pre>";
						// print_r($match[1][0]);
						// echo "<pre>";
						$tab.='<li>
				<div class="goods_img">
					<a id="goodsimg" href="./detail_cake.php?id='.$row['id'].'"><img src="/'.$match[1][0].'"></a>
				</div>
				<div class="goods_box">
					<div class="goods_body_text">
						<div class="goods_name">
							<a id="good_name" class="gn_color" href="./detail_cake.php?id='.$row['id'].'" target="_blank">'.$row['name'].'</a>
						</div>
						<div class="goods_depict">'.$row['depict'].'</div>
						<div class="goods_summary">
							<span style="font-size:12px;">'.$row['summary'].'</span>
						</div>
					</div>
					<div class="goods_operate">
						<div class="like_red">
							<a href="#" class="like" onclick="return false">
								<img src="./images/product/0.gif" alt="">
							</a>
							<span class="like_num">'.$row['likenum'].'</span>
							<input type="hidden" id="like_status" name="like_status" value="1"/>
							人喜欢
						</div>
						<div class="clear"></div>
						<div id="price">
							<span id="symbol_price">￥</span>
							<span id="number_price">'.$row['price'].'</span>
							<div id="other_price"><span>.00</span><span id="pcs">'.$row['pcs'].'</span></div>
						</div>
						<div class="sub">
							<input type="hidden" id="goods_id" value="'.$row['id'].'" >
							<div class="submit_goods" onclick="buyGoods(this)">
								立即购买
							</div>
							<div class="submit_goods">
								<a href="./detail_cake.php?id='.$row['id'].'">查看详情</a>
							</div>
						</div>
					</div>
				</div>	
			</li>';
					}}
				}
					echo $tab;
				}
			 ?>
			<!-- <li>
				<div class="goods_img">
					<a href="#"><img src="./images/product/1.gif" alt=""></a>
				</div>
				<div class="goods_box">
					<div class="goods_body_text">
						<div class="goods_name">
							<a class="gn_color" href="#" target="_blank">100元提货卡</a>
						</div>
						<div class="goods_depict">/订购提示<br>
1、下单并在线支付成功后，提货卡卡号及密码会以短信形式发送到订货人手机上。凭卡号及密码到味多美北京任意门店换取等额实体卡后，即可持卡消费；<br>
2、在门店换取实体卡时按订单实际支付金额开具发票，发票不支持邮寄。/</div>
					</div>
					<div class="goods_operate">
						<div class="like_red">
							<a href="#">
								<img src="./images/product/0.gif" alt="">
							</a>
							<span class="like_num">4991</span>
							人喜欢
						</div>
						<div class="clear"></div>
						<div id="price">
							<span id="symbol_price">￥</span>
							<span id="number_price">97</span>
							<div id="other_price"><span>.00</span></div>
						</div>
						<div class="sub">
							<div class="submit_goods">
								<a href="#">立即购买</a>
							</div>
							<div class="submit_goods">
								<a href="#">查看详情</a>
							</div>
						</div>
					</div>
				</div>	
			</li>-->
		</ul>
		<div class="page">
			<div class="page_count">总计：<?php echo $n; ?>  |  共1页</div>
		</div>
	</div>
        <?php }else if ( $cateId == 3) {?>
	
	<div id="distribute" class="detail_box">
			<div id="current_position_detail">当前位置:<a href="indexcake.php">首页</a> <code>></code> <a href="">全国配送</a>   
			</div>
		<ul class="list_box">
			<?php 
				if($rows){
					$tab='';
					$n=0;
					foreach ($rows as $row){
						if($row['cid']==13){
						$n++;
						if($row['img']!=""){
							// echo "a";
							$a=htmlspecialchars_decode($row['img']);
							preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
						// 	echo "<pre>";
						// print_r($match[1][0]);
						// echo "<pre>";
						$tab.='<li>
				<div class="goods_img">
					<a id="goodsimg" href="./detail_cake.php?id='.$row['id'].'"><img src="/'.$match[1][0].'"></a>
				</div>
				<div class="goods_box">
					<div class="goods_body_text">
						<div class="goods_name">
							<a id="good_name" class="gn_color" href="./detail_cake.php?id='.$row['id'].'" target="_blank">'.$row['name'].'</a>
						</div>
						<div class="goods_depict">'.$row['depict'].'</div>
						<div class="goods_summary">
							<span style="color:#bc002d; font-size:12px;">'.$row['summary'].'</span>
						</div>
					</div>
					<div class="goods_operate">
						<div class="like_red">
							<a href="#" class="like" onclick="return false">
								<img src="./images/product/0.gif" alt="">
							</a>
							<span class="like_num">'.$row['likenum'].'</span>
							<input type="hidden" id="like_status" name="like_status" value="1"/>
							人喜欢
						</div>
						<div class="clear"></div>
						<div id="price">
							<span id="symbol_price">￥</span>
							<span id="number_price">'.$row['price'].'</span>
							<div id="other_price"><span>.00</span><span id="pcs">'.$row['pcs'].'</span></div>
						</div>
						<div class="sub">
							<input type="hidden" id="goods_id" value="'.$row['id'].'" >
							<div class="submit_goods" onclick="buyGoods(this)">
								立即购买
							</div>
							<div class="submit_goods">
								<a href="./detail_cake.php?id='.$row['id'].'">查看详情</a>
							</div>
						</div>
					</div>
				</div>	
			</li>';
					}}
				}
					echo $tab;
				}
			 ?>
			<!-- <li>
				<div class="goods_img">
					<a href="#"><img src="./images/product/1.gif" alt=""></a>
				</div>
				<div class="goods_box">
					<div class="goods_body_text">
						<div class="goods_name">
							<a class="gn_color" href="#" target="_blank">阿拉棒饼干</a>
						</div>
						<div class="goods_depict">/阿拉棒饼干，为“吃货”而生，咔哧咔哧超享受！/</div>
						<div class="goods_summary">订购提示：订购全国邮寄产品，满99元顺丰包邮，不满99元收取10元/单运费（港澳台及偏远地区除外，新疆、西藏、内蒙古地区收取20/单运费）。</div>
					</div>
					<div class="goods_operate">
						<div class="like_red">
							<a href="#">
								<img src="./images/product/0.gif" alt="">
							</a>
							<span class="like_num">5996</span>
							人喜欢
						</div>
						<div class="clear"></div>
						<div id="price">
							<span id="symbol_price">￥</span>
							<span id="number_price">12</span>
							<div id="other_price"><span>.00</span></div>
						</div>
						<div class="sub">
							<div class="submit_goods">
								<a href="#">立即购买</a>
							</div>
							<div class="submit_goods">
								<a href="#">查看详情</a>
							</div>
						</div>
					</div>
				</div>	
			</li> -->
		</ul>
		<div class="page">
			<div class="page_count">总计：<?php echo $n; ?>  |  共1页</div>
		</div>
	</div>
        <?php } else if ($cateId == 4) {?>

	<div id="integral" class="detail_box">
			<div id="current_position_detail">当前位置:<a href="indexcake.php">首页</a> <code>></code> <a href="">积分商城</a>   
			</div>
		<ul class="list_box">
			<?php 
				if($rows){
					$tab='';
					$n=0;
					foreach ($rows as $row){
						if($row['cid']==15){
						$n++;
						if($row['img']!=""){
							// echo "a";
							$a=htmlspecialchars_decode($row['img']);
							preg_match_all("/src=\"\/?(.*?)\"/",$a,$match);
						// 	echo "<pre>";
						// print_r($match[1][0]);
						// echo "<pre>";
						$tab.='<li>
				<div class="goods_img">
					<a href="./detail_cake.php?id='.$row['id'].'"><img src="/'.$match[1][0].'"></a>
				</div>
				<div class="goods_box">
					<div class="goods_body_text">
						<div class="goods_name">
							<a class="gn_color" href="./detail_cake.php?id='.$row['id'].'" target="_blank">'.$row['name'].'</a>
						</div>
						<div class="goods_depict">'.$row['depict'].'</div>
						<div class="goods_summary">
							<span style="color:#bc002d; font-size:12px;">'.$row['summary'].'</span>
						</div>
					</div>
					<div class="goods_operate">
						<div class="like_red">
							<a href="#" class="like" onclick="return false">
								<img src="./images/product/0.gif" alt="">
							</a>
							<span class="like_num">'.$row['likenum'].'</span>
							<input type="hidden" id="like_status" name="like_status" value="1"/>
							人喜欢
						</div>
						<div class="clear"></div>
						<div id="price">
							<span id="symbol_price"></span>
							<span id="number_price">'.$row['price'].'</span>
							<div id="other_price" ><span>积分</span><span>'.$row['pcs'].'</span></div>
						</div>
						<div class="sub">
							<input type="hidden" id="goods_id" value="'.$row['id'].'" >
							<div class="submit_goods" onclick="buyGoods(this)">
								立即购买
							</div>
							<div class="submit_goods">
								<a href="./detail_cake.php?id='.$row['id'].'">查看详情</a>
							</div>
						</div>
					</div>
				</div>	
			</li>';
					}}
				}
					echo $tab;
				}
			 ?>
			<!-- <li>
				<div class="goods_img">
					<a href="#"><img src="./images/product/1.gif" alt=""></a>
				</div>
				<div class="goods_box">
					<div class="goods_body_text">
						<div class="goods_name">
							<a class="gn_color" href="#" target="_blank">老婆饼1枚电子兑换券（口味随机）</a>
						</div>
						<div class="goods_depict">/金黄酥松的外皮，内馅软滑，微甜而不腻，老少皆宜。相传是丈夫为爱妻精心研制成一款酥饼，从此流传下来，称作“老婆饼”。/</div>
						<div class="goods_summary">
							<span style="color:#bc002d; font-size:12px;">订购提示：下单并在线支付成功后，兑换券券号及密码会以短信形式发送到订货人手机上，兑换券使用说明详见【温馨提示】。
							</span>
						</div>
					</div>
					<div class="goods_operate">
						<div class="like_red">
							<a href="#">
								<img src="./images/product/0.gif" alt="">
							</a>
							<span class="like_num">0</span>
							人喜欢
						</div>
						<div class="clear"></div>
						<div id="price">
							<span id="symbol_price"></span>
							<span id="number_price">1000</span>
							<div id="other_price" style="margin-top: 20px;">积分+<span style="font-size: 37px;">5</span>元</div>
						</div>
						<div class="sub">
							<div class="submit_goods">
								<a href="#">立即购买</a>
							</div>
							<div class="submit_goods">
								<a href="#">查看详情</a>
							</div>
						</div>
					</div>
				</div>	
			</li> -->
		</ul>
		<div class="page">
			<div class="page_count">总计：<?php echo $n; ?>  |  共1页</div>
		</div>
	</div>
    <?php } ?>

	</section>
	<?php include './footer.php';?>
<?php 
 	if(isset($_GET['name'])){
 		$tab='<script>
			$("#'.$_GET['name'].'").css({background:"#CF0F25",color:"#fff"});
 		</script>>';
 		echo $tab;
 	if(isset($_GET['id'])&&$_GET['id']==2){
 		 $tab='<script>$("#butter").css("color","#A41E34").addClass("active").siblings().css("color","#242C29").removeClass("active")</script>';
 		 echo $tab;
 	}
 	if(isset($_GET['id'])&&$_GET['id']==5){
 		 $tab='<script>$("#mousse").css("color","#A41E34").addClass("active").siblings().css("color","#242C29")</script>';
 		 echo $tab;
 	}
 	if(isset($_GET['id'])&&$_GET['id']==11){
 		 $tab='<script>$("#cheese").css("color","#A41E34").addClass("active").siblings().css("color","#242C29")</script>';
 		 echo $tab;
 	}
 	if(isset($_GET['id'])&&$_GET['id']==6){
 		 $tab='<script>$("#chocolate").css("color","#A41E34").addClass("active").siblings().css("color","#242C29")</script>';
 		 echo $tab;
 	}
 	}
  ?>
  <script>
  	function changeColor(){
  		$(".taste").mouseover(function(){
  			$(this).css("color","#A41E34");
  		});
  		$(".taste").mouseout(function(){
  			$(this).css("color","#242C29");
  			$("span.active").css("color","#A41E34");
  		});
  	}
  	$(changeColor);
  </script>
</body>
<script src="js/category.js"></script>
</html>



