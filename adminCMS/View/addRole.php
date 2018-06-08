<?php  
session_start();
header('content-type:text/html;charset=utf-8;');
if (isset($_SESSION['roleId'])&&($_SESSION['roleId']!='3')) {
	echo "<script>alert('您不存在该权限！');window.location.href='../view/addCategory.v.php';</script>";
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="./css/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/jquery2.14.min.js"></script>
    <script src="./js/script.js"></script>
<script>
</script>
<style type="text/css">
<!--
.STYLE1 {font-size: 18px}
-->
</style>
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
	<div id="cnt"><!--cnt-->
		<div class="menu" id="menu">
			<div id="add_base"><!--add_base-->
					<div class="title">角色设置---&gt;添加角色</div>
					<form action="../Api/role.Api.php?act=addrole" method="post" id="roleForm">			
						<table width="470" border="0" cellspacing="0" cellpadding="0">	
							<tr>
								<td width="146" class="align_r" >角色名称:</td>
								<td width="181" class="align_l"><input type="text" name="rolename" id="rolename" /></td>
								<td width="475" class="align_l" >角色名,由字母、数字、下划线等组成</td>
							</tr>
							<tr>
								<td class="align_r">
									<input type="button" id="addRoleBtn" name="adduserbtn" class="btn" value="添加角色" />
								</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</form>	
			</div>
		</div><!--menu-->	
	</div><!---cnt-->
</div><!--list-->
<?php
include('./footer.php');
?>
<script>
function addRole(){
	$("#addRoleBtn").click(function(){
		var str=$("#rolename").val();
		if(str.length<1){alert('请输入角色名！');}else{
			$("#roleForm").submit();
		}
	});//$()
}
$(addRole);//focus

//异步检查角色名是否被注册
function checkRole(){
	$("#rolename").blur(function(){
		var rolename=$("#rolename").val();
		if(rolename.length<1){
			alert('请输入角色名！');
			return true;
		}else{
			//ajax方法中的get方法.(post \get)
			//$.ajax();
			//$.post('地址','数据','结果','数据格式')
			//$.get()
			//{'user':'boss','pwd':'123'}
			//回调函数    function(data){}
			//数据返回格式{"code":"u007","msg":"\u89d2\u8272\u53ef\u7528\uff01","data":"fsdfs"}
			$.get('../Api/role.Api.php',{'act':'checkRole','roleName':rolename},function(data){
					//alert(data.msg);
					//alert(data.code+'--'+data.msg);
					alert(data.msg);
					//json格式的数据
			},'json')
		}
		
	});
}
$(checkRole);
//$(addRole);
</script>
</body>
</html>
