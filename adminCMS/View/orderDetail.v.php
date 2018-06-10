<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="./css/css.css" rel="stylesheet" type="text/css" />
    <script  src="./js/jquery2.14.min.js"></script>
    <script  src="./js/fun.js"></script>
    <script src="./js/script.js"></script>
</head>

<body>
  <?php
include('./head.php');
?>
<div id="list">
  <?php
include('./link.php');
?>
<!--link-->
  <div id="cnt"><!--cnt--->
  	<div class="menu" id="menu">
    <!----------------------->
    <div id="updata_lanmu"><!--管理栏目-->
      	<div class="title">销售订单---&gt;订单统计</div>
      	<?php
      		include('../Api/orderApi.php');
      	 ?>
	<table width="803" border="0" cellspacing="0" cellpadding="0">
		
		<tr>
		  	<td>编号</td>
		  	<td>订单id</td>
		  	<td>用户id</td>
			<td>商品id</td>
			<td width="120px">商品名称</td>
			<td>商品价格</td>	
			<td>商品数量</td>	
			<td>商品状态</td>
            <td>祝福对象</td>
            <td>祝福语</td>
			<td>购买时间</td>	
		</tr>
		<!-- <tr>
		  	<td>订单编号</td>	
			<td>收货人</td>
			<td>总金额</td>
			<td>应付金额</td>	
			<td>已收货/待确认/已完成/已取消</td>	
			<td>未支付/已支付</td>	
			<td>未发货/已发货</td>		
			<td>下单时间</td>	
		</tr> 
		

	-->
		<?php


			if(!$rows){exit;}
			$tab='';
			foreach($rows as $row){
				//print_r($row);
				$time=date('Y-n-d',$row['time']);
				
				$good='';
				$temp=array('待处理','末发货','已发货','已退货');
				for($i=0;$i<4;$i++){
					if(($row['status']-1)==$i){
						$good=$temp[$i];
					}
				}
				
				$tab.='<tr> 
					<td >'.$row['id'].'</td>
					<td >'.$row['orderid'].'</td>
					<td >'.$row['uid'].'</td>
					<td >'.$row['goodid'].'</td>
					<td >'.$row['goodname'].'</td>
					<td >'.$row['price'].'</td>
					<td >'.$row['num'].'</td>
					<td >'.$good.'</td>
					<td>'.$row['wish_person'].'</td>
					<td>'.$row['good_wish'].'</td>
					<td >'.$time.'</td>
					
				 </tr>';
			 }
			 echo $tab;
		?>
		<!-- <select name="order_status" id="order_status">
			<option value="1">待处理</option>
			<option value="2">已提交</option>
			<option value="3">已发货</option>
			<option value="4">已退货</option>
		</select> -->
		<!-- //good_status:商品状态  1:待处理,2：已提交,3:已发货,4:已退货
		//order_status:订单状态 1:待处理,2：已提交,3:已发货,4:已退货
		//pay_status:支付状态   1:待处理, 2:末付款,3：已付款,4:已退款 -->
	</table>

      </div><!---updatalanmu---->
	
    <!--------------------------------->  
  	</div>
  	<!--menu-->
  
  </div><!---cnt---->
</div><!--list-->
  <?php
include('./footer.php');
?>
</body>
</html>
