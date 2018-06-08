<?php  
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="./css/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/jquery2.14.min.js"></script>
    <script src="./js/script.js"></script>
<script >
//获取全部角色//用于下拉列表
function getAllRoles(){
	//{"code":"u012","msg":"\u53d6\u5168\u90e8\u89d2\u8272\u6210\u529f\uff01","resultData":[{"roleId":"1","roleName":"\u7f16\u8f91\u7ec4"},{"roleId":"2","roleName":"\u7ba1\u7406\u5458\u7ec4"},{"roleId":"3","roleName":"\u8d85\u7ea7\u7ba1\u7406\u5458\u7ec4"},{"roleId":"9","roleName":"b"},{"roleId":"8","roleName":"a"},{"roleId":"10","roleName":"x"},{"roleId":"11","roleName":"x"},{"roleId":"12","roleName":"m"},{"roleId":"13","roleName":"r"},{"roleId":"14","roleName":"ff"},{"roleId":"15","roleName":"ff"}]}
	$.get('../Api/role.Api.php',{'act':'getAllRoles'},function(data){
		//alert(data);
		if(data.resultData){
			var rows=data.resultData;
			//var tab='<option value=0 selected="selected">----请选择角色----</option>';
			var tab='';
			for(var i in rows){
				var row=rows[i];
				if(row.roleName=="编辑组"){//默认角色是编辑组
					tab+="<option selected='selected' value="+row.roleId+">"+row.roleName+"</option>";
				}else{
					tab+="<option value="+row.roleId+">"+row.roleName+"</option>";
				}
				
			}
			//alert(tab)
			$("#role_group").html(tab);
		}
	},'json')
}
$(getAllRoles);

//表单元素检查
function checkForm(){	
	$("#username").blur(function(){
		if($(this).val().length<1){
			alert('请输入用户名！');
			return false;
		}
	})
	$("#pwd").blur(function(){
		if($(this).val().length<1){alert('请输入密码！');return false;}
	})
	$("#repwd").blur(function(){
		//alert('两次输入的密码不一致！');
		if($(this).val()<1||$(this).val()!=$("#pwd").val()){alert('两次输入的密码不一致！');return false;}
	})
}
//添加用户
function addUser(){
	$("#adduserbtn").click(function(){
		if($("#username").val().length<1){alert('请输入用户名！');return false;}
		if($("#pwd").val().length<1){alert('请输入密码！');return false;}
		if($("#repwd").val()<1||$("#repwd").val()!=$("#pwd").val()){alert('两次输入的密码不一致！');return false;}
		$("#addUserForm").submit();
	})	
}
$(checkForm);
$(addUser)
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
				<div class="title">用户设置---&gt;添加用户</div>
				<form action="../Api/checkUserApi.php?act=addUser" method='post' id="addUserForm">			
					<table width="470" border="0" cellspacing="0" cellpadding="0">
					<tr>
							<td width="146" class="align_r" >角色:</td>
							<td width="181" class="align_l">
								<select name="role" id="role_group"></select>
							</td>
							<td ></td>
							</tr>
					<tr>
					<tr>
							<td width="146" class="align_r" >用户Id:</td>
							<td width="181" class="align_l"><input type="text" name="username" id="username" /></td>
							<td width="475" class="align_l" >用户名由字母、数字、下划线等组成</td>
							</tr>
					<tr>
							<td class="align_r">用户密码:</td>
							<td class="align_l"><input type="password" name="pwd" id="pwd" /></td>
							<td width="475" class="align_l" >无限制，建议由6位以上字符组成</td>
							<tr>
							<td class="align_r">确认密码:</td>
							<td class="align_l"><input type="password" name="repwd" id="repwd" /></td>
							<td width="475" class="align_l" >&nbsp;</td>
					</tr>
					<tr>
							<td class="align_r"><input type="button" id="adduserbtn" name="adduserbtn" class="btn" value="添加用户" /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
					</tr>
					</table>
				</form>
			</div>	
	</div>
</div><!--list-->
<?php
include('./footer.php');
?>
</body>
</html>
