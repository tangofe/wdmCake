<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="./css/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/jquery2.14.min.js"></script>
    <script src="./js/script.js"></script>
<script type="text/javascript">
//取全部用户信息
//数据格式
//{"code":"u010","msg":"\u53d6\u5168\u90e8\u7528\u6237\u4fe1\u606f\u6210\u529f\uff01","resultData":[{"roleId":"1","roleName":"\u7f16\u8f91\u7ec4","userId":"4","userName":"user01","pwd":"123456","thumbImg":"","time":""},{},{}]}
function getAllUser(){
	$.get("../Api/checkUserApi.php",{'act':'getAllUser'},function(data){
		//alert(data);
		//alert(data.resultData);
		if(data.resultData){
			var rows=data.resultData;
			var tab="<tr><td>操作</td><td>用户ID</td><td>用户账号</td><td>角色</td></tr>";
			for(var i in rows){
				var row=rows[i];
					 tab+="<tr><td><a href='./editUser.php?lid=6&id="+row['id']+"' >编辑</a><a  style='margin-left:10px;' href='../Api/checkUserApi.php?act=deleteUser&id="+row['id']+"' >删除</a></td><td >"+row['id']+"</td><td >"+row['userId']+"</td><td >"+row['roleName']+"</td></tr>";
			}
			$("#userTab").html(tab);
		}

	},'json')
}
$(getAllUser)
</script>

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
		<div id="updata_menu"><!--管理菜单-->
				<div class="title">用户设置---&gt;管理用户</div>
<table width="803" border="0" cellspacing="0" cellpadding="0" id="userTab">

</table>
		
 <!-- <div id="fpage"><?php  echo $link; ?></div> -->
			</div><!---updatamenu---->
			
		
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
