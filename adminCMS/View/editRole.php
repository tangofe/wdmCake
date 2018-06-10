<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="./css/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/jquery2.14.min.js"></script>
    <script src="./js/script.js"></script>
<script type="text/javascript" >
//获取url中的参数(参数的值)
function getUrlParam(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
	var r = window.location.search.substr(1).match(reg);  //匹配目标参数  search: ?pwd=abc&id=6
	if (r != null) return unescape(r[2]); return null; //返回参数值
}
//根据传递的id 值取相关信息
function  getCntById(){
	var id=getUrlParam('id');
	if(id){
		//{"code":"u012","msg":"\u53d6\u89d2\u8272\u6210\u529f\uff01","resultData":{"roleId":"7","roleName":"c"}
		$.get('../Api/role.Api.php',{'act':'getCntById','id':id},function(data){
			//alert(data);
			if(data.resultData){
				var row=data.resultData;
				var tab='';
				tab+= '<tr><td><input type="button" name="editbtn" id="btn" class="btn" value="更新" onclick="updateRole(this)"/> <a href="../Api/role.Api.php?act=deleteRole&id='+row['roleId']+'">删除</a></td><td><input style="width:80px;" type="text" value="'+row['roleId']+'" name="id" readonly="true"></td><td><input style="width:80px;" type="text" value="'+row['roleName']+'" name="name"></td></tr>';
				$("#editRole").append(tab)
			}
		},'json'
		);
	}	
}
$(getCntById)
function updateRole(e){
	//var obj=$(e);
	//alert(obj.attr('id'))
	/*var objs=$(e).parent().siblings();
	alert(objs.length)*/
	var roleId=$(e).parent().siblings().eq(0).children('input').val();
	var roleName=$(e).parent().siblings().eq(1).children('input').val();
	//alert(roleId+'--'+roleName)
	if(roleName.length<1){alert('请输入角色名！');return false;}
	$.get('../Api/role.Api.php',{'act':'upRole','id':roleId,'role':roleName},function(data){
		alert(data.msg);
		//window.history.go(-1);
		window.location.href='../View/upRole.php';
		
	},'json');
}
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
		<div class="title">角色设置---&gt;篇辑角色</div>  
	<table  id="editRole" width="803" border="0" cellspacing="0" cellpadding="0">	 
		<tr>
			<td>操作</td>
			<td>角色id</td>
			 <td>角色名</td>	  
		</tr>
		
	</table>
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
