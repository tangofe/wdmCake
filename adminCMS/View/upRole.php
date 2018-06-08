<?php 
	session_start();header('content-type:text/html;charset=utf-8;');
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
//取全部角色
function getAllRoles(){
	//返回数据格式
	//{"code":"u012","msg":"\u53d6\u5168\u90e8\u89d2\u8272\u6210\u529f\uff01","resultData":[{"roleId":"1","roleName":"\u7f16\u8f91\u7ec4"},{"roleId":"2","roleName":"\u7ba1\u7406\u5458\u7ec4"},{"roleId":"3","roleName":"\u8d85\u7ea7\u7ba1\u7406\u5458\u7ec4"},{"roleId":"9","roleName":"b"},{"roleId":"8","roleName":"a"},{"roleId":"10","roleName":"x"},{"roleId":"11","roleName":"x"},{"roleId":"12","roleName":"m"},{"roleId":"13","roleName":"r"},{"roleId":"14","roleName":"ff"},{"roleId":"15","roleName":"ff"}]}
	$.get('../Api/role.Api.php',{'act':'getAllRoles'},function(data){
		//alert(data);
		//alert(data.resultData);
		if(data.resultData){
			var rows=data.resultData;
			var tab='<tr><td>操作</td><td>角色ID</td><td>角色名</td></tr>';
			for(var i in rows){//for(var i=0;i<rows.length;i++){}
				//alert(data[i].roleName)
				var row=rows[i];
				tab+="<tr><td><a href='./editRole.php?lid=5&id="+row.roleId+"' >编辑</a></td>";
				tab+="<td >"+row.roleId+"</td>";
				tab+="<td >"+row.roleName+"</td></tr>";
			}
			$("#rolesTab").html(tab);
		}
	},'json')
}
$(getAllRoles);

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
	<div id="cnt"><!--cnt-->
		<div class="menu" id="menu">
			<div id="updata_menu"><!--管理菜单-->
					<div class="title">角色设置---&gt;管理角色</div>
					<table id="rolesTab" width="803" border="0" cellspacing="0" cellpadding="0"></table>	
			</div>
		</div>
	</div>
</div><!--list-->
	<?php
include('./footer.php');
?>
</body>
</html>
