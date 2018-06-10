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
<script type="text/javascript" src="./js/company.js"></script>
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
		  	<td>订单id</td>
		  	<td>订单流水号</td>	
		  	<td>用户id</td>
			<td>收货人</td>
			<td>总金额</td>	
			<td>订单状态</td>	
			<td>支付状态</td>	
			<td>发货状态</td>		
			<td>下单时间</td>
			<td>订单明细</td>	
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
				$order='<select name="order_status" id="order_status" onchange="changeStatus(this)">';
				$temp=array('待处理','已提交','已结清','已作废');
				for($i=0;$i<4;$i++){
					if(($row['order_status']-1)==$i){
						$order.='<option selected="selected" value="'.$i.'">'.$temp[$i].'</option>';
					}else{
						$order.='<option value="'.$i.'">'.$temp[$i].'</option>';
					}
				}
				$order.='</select>';
				$pay='<select name="pay_status" id="pay_status" onchange="changeStatus(this)">';
				$temp=array('待处理','末付款','已付款','已退款');
				for($i=0;$i<4;$i++){
					if(($row['pay_status']-1)==$i){
						$pay.='<option selected="selected" value="'.$i.'">'.$temp[$i].'</option>';
					}else{
						$pay.='<option value="'.$i.'">'.$temp[$i].'</option>';
					}
				}
				$pay.='</select>';
				$good='<select name="good_status" id="good_status" onchange="changeStatus(this)">';
				$temp=array('待处理','末发货','已发货','已退货');
				for($i=0;$i<4;$i++){
					if(($row['order_status']-1)==$i){
						$good.='<option selected="selected" value="'.$i.'">'.$temp[$i].'</option>';
					}else{
						$good.='<option value="'.$i.'">'.$temp[$i].'</option>';
					}
				}
				$good.='</select>';
				$tab.='<tr>
					<td >'.$row['id'].'</td>
					<td >'.$row['orderid'].'</td>
					<td >'.$row['uid'].'</td>
					<td >'.$row['user'].'</td>
					<td >'.$row['money'].'</td>
					<td >'.$order.'</td>
					<td >'.$pay.'</td>
					<td >'.$good.'</td>
					<td >'.$time.'</td>
					<td ><a href="orderDetail.v.php?lid=4&act=orderDetail&uid='.$row['uid'].'&orderid='.$row['orderid'].'">明细</a></td>
					<input type="hidden" value="'.$row['orderid'].'" id="'.$row['uid'].'"/>
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
	 <div id="fpage"><?php  echo $link; ?></div>
    <!--------------------------------->  
  	</div>
  	<!--menu-->
  
  </div><!---cnt---->
</div><!--list-->
  <?php
include('./footer.php');
?>
</body>
<script>
	function changeStatus(e){
		var type=$(e).attr('name');
		var val=$(e).find('option:selected').val();
		var orderid=$(e).parent().parent().find('input[type="hidden"]').val();
		var uid=$(e).parents().find('input[type="hidden"]').attr('id');
		alert(orderid)
		//alert(uid+type+orderid+uid);
		$.get("../Api/orderApi.php",{'act':'changeStatus','type':type,'orderid':orderid,'val':val,'uid':uid},function(data){
			alert(data.msg);
			//alert(data);
		},'json')

	}

</script>
</html>
