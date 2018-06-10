
<?php  
header("content-type:text/html;charset=utf-8;");
session_start();
if (!isset($_SESSION['userId'])) {
	echo "<script>alert('请先登录！');window.location.href='../view/login_register_cake.php';</script>";
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>购物流程_味美多蛋糕官网</title>
	<link rel="shortcut icon" href="./images/animated_favicon.gif"/>
</head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="./css/category.css">
<link rel="stylesheet" href="./css/shopcar.css">
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<body>
<?php include './header.php' ?>
<main>
<section id="detail_box_cake">
		<div class="shopcar_main">
			<div class="order_step">
				<div class="step1">我的购物车</div>
				<div class="step2">填写核对订单信息</div>
				<div class="step3">成功提交订单</div>
			</div>
			<div class="order_info">
				<div class="order_bill">
					<div class="order_title">
						<div class="lump"></div>
						我的购物车
					</div>
					<div class="order_text">
						<div class="address">
							<table>
								<tbody id="shopcar_product">
									<!-- <tr>
										<th>商品名称</th>
										<th>规格</th>
										<th>数量</th>
										<th>单机</th>
										<th>小计</th>
										<th width="50">操作</th>
									</tr> -->
									
									<!-- <tr>
										<td align="left">
											<div class="goods_name">
												<a href="">
													<img src="./images/shopcar/1.jpg" alt="">
												</a>
												<a href="" class="name">经典100%蛋糕</a>
												<div class="clear"></div>
											</div>
										</td>
										<td>Φ20cm</td>
										<td>
											<div style="width:123px;height:29px;margin:0 auto;">
												<input type="text" class="minus" value="-" onclick="delnum(this)" readonly="">
												<input type="text" class="number" value="1" readonly="">
												<input type="text" class="plus" value="+" onclick="addnum(this)" readonly="">
											</div>
										</td>
										<td>￥198.00</td>
										<td id="subtotal_1">￥<span id="pricesum">198.00</span></td>
										<td>
											<div class="del">
												<a href=""></a>
											</div>
										</td>
									</tr> -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="order_operate">
				<div class="order_text">
					<div class="cost">购物金额小计 ￥<span id="price_sum">0.00</span></div>
					<button class="submit_left">
						<a href="./category.php">继续购物</a>
					</button>
					<button class="submit">
						<a href="">下单结算</a>
					</button> 
					<div class="clear"></div>
				</div>
			</div>
			<div class="order_history" style="display: block">
				<!-- <div class="order_title">
					<div class="lump"></div>
					配件
				</div>
				<div class="history_text">
					<div>

						<img src="./images/shopcar/2.jpg" alt="">
						<div class="name_price">音乐蜡烛 ￥10.00</div>
						<button class="submit">
							<a href="">加入购物车</a>
						</button>
					</div>
				</div> -->
			</div>
		</div>
	</section>
	<?php include './footer.php';?>
</body>
<script>
function initShopCar(){
			$.get('../api/shopCarApi.php',{act:'initShopCar'},function(data){
				if(data.code==100){//用户未登录
					window.location.href="../view/login_register_cake.php";
				}
				if(data.code==105){
					var tab='<tr><th>商品名称</th><th>规格</th><th>数量</th><th>单机</th><th width="101">小计</th><th width="50">操作</th></tr>';
					var money=0;
					var shopcarnum=0;
					var newdata=data.data;
					for(var i in newdata){
						var row=newdata[i];
						money+=(parseFloat(row.price)*parseInt(row.num));
						var moneysum=parseFloat(row.price)*parseInt(row.num);
						moneysum=moneysum.toFixed(2);
						tab+='<tr><td align="left"><div class="goods_name"><a href="./detail_cake.php?id='+row.goodid+'">'+row.img+'</a><a href="./detail_cake.php?id='+row.goodid+'" class="name">'+row.goodname+'</a><div class="clear"></div></div></td><td>'+row.pcs+'</td><td><div style="width:123px;height:29px;margin:0 auto;"><input type="text" class="minus" value="-" onclick="delnum(this)" readonly=""><input type="text" class="number" value="'+row.num+'" readonly=""><input type="text" class="plus" value="+" onclick="addnum(this)" readonly=""></div></td><td>￥'+row.price+'</td><td id="subtotal_1">￥<span id="pricesum">'+moneysum+'</span></td><td><div class="del" onclick="delGoods(this)"><a href=""></a></div></td><input type="hidden" id="'+row.goodid+'" name="'+row.goodid+'" value="'+row.goodid+'" /></tr>';
						}
					money=money.toFixed(2);
					$("#price_sum").text(money);
					$("#shopcar_product").html(tab);
					$(".submit a").attr("href","orderForm.php?all="+money);

				}
				if (data.code==104){
					order_history();
					return true;
				}
			},'json')
			$.get('../api/GoodsApi.php',{act:'add_order_history'},function(data){
				// var tab=data[0]['img'];
				// $(".order_history").html(tab);
				var tab="";
				for(var i in data){
					var row=data[i];
					tab+='<div class="order_title"><div class="lump"></div>配件</div><div class="history_text"><div><input type="hidden" id="goods_id" value="'+row.id+'"><span>'+row.img+'</span><div class="name_price"><span>'+row.name+'</span> ￥<span>'+row.price+'</span></div><button class="submit" onclick="buyGoods1(this)"><a href="">加入购物车</a></button></div></div>';
				}
				$(".order_history").html(tab);
			},'json')
		}
		$(initShopCar);
</script>
<script src="js/category.js"></script>
</html>