<?php
header("Content-Type:text/html;charset=utf-8");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script src="./js/jquery2.14.min.js"></script>
<script src="./js/jquery.cookie.js"></script>

<script>
//刷新cookie中的计数器清零
function freshen(){
	$.cookie('clickCount',0);
}
//$(freshen);
//单击图片重新生成验证码
// function mdImg(){
// 	$("#reflash").click(function(){
// 		//alert('ppp');
// 		//$("#img").css('cursor','pointer');
// 		$.cookie('clickCount',0);
// 		$("#imgs").attr('src',"../Api/bgCodeApi.php?t="+Math.random());
// 		setTimeout(getChars,200);
// 	})
// }
// $(mdImg);
// //失去焦点提交验证码
// function checkCode(){
// 	$("#txt").blur(function(){
// 			$.post("{:U('Index/checkCode')}",{"codes":$("#txt").val()},function(data){
// 			//alert(data)
// 				if(data=="check_code_ok"){
// 						//$("#tishi").html("<img src='__PUBLIC__/images/ok.png' >");
// 						$("#tishi").css("background","url('__PUBLIC__/images/ok.png') no-repeat center");
// 				}else{		
// 						//$("#tishi").html("<img src='__PUBLIC__/images/ng.png' >");
// 						$("#tishi").css("background","url('__PUBLIC__/images/ng.png') no-repeat center");
// 				}
			
// 			});
// 	})

// }
// $(checkCode)
</script>
<style>
body{
	
	background: url("./images/loginBg.jpg") no-repeat;
	background-size:cover;
}
#regbox{
	box-sizing: border-box;
	width:350px;
	min-height:400px;
	padding:0 40px 0 30px;
	margin:0 auto;
	margin-top:150px;
	color: #A41E34;
	/*background: #F5FFFA;*/
	border: #FFFFF0 solid 8px;
	background:#ddd;
}
h1{
	width: 300px;
	margin-left: -8px;
	color:#A41E34;
	font-size:25px;
	margin-top:50px;
}
h3{
	margin-left:75px;
}
#txt{
	width:120px;

}

#img ,#txt{
	margin-top:12px;
	float:left;
}
input{
	margin:15px 0px;
	color: #A41E34;
	background-color: transparent;
}
input[type='submit'] {
    color: #fff;
}
#sub{
	clear:both;
	width:100px;
	height:32px;
	line-height:22px;
	font-size:20px;
	cursor:pointer;
}
</style>
<link href="__PUBLIC__/css/css.css" rel="stylesheet" type="text/css" />
</head>

<body>

<form method="post" name="form" action="../Api/checkUserApi.php?act=login"}>
<div id="regbox">
	<h1>味多美蛋糕后台管理系统</h1><br>
	<h3>管理员登录</h3>
	&nbsp;&nbsp;&nbsp;&nbsp;用户名：<input type="text" name="name"/><br/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码：<input type="password" name="pwd"/><br/>
	<!-- <div id="ctxt">验&nbsp;&nbsp;证&nbsp;&nbsp;码：</div> -->
	<!-- <input type="text" name="code" id='txt'/><div id="tishi">&nbsp;</div>
	
	<img src="../Api/codeApi.php" id="img" /><br/>
	<div id="tishi" width="1000px" height='32px'></div> -->
	<!-- <img src="../Api/bgCodeApi.php" id="imgs"/>
	
	<span id="reflash" style="cursor:move;">换一张</span>
	<br/> -->
	<div style="width: 75px;height: 1px;float: left;"></div><input type="submit" name="sub" id="sub" value="登录" style="background: #A41E34"/>
	<!-- <div id="tishicnt">&nbsp;</div> -->
</div>
</form>
<script>
function checkCode(){
	$("#imgs").click(function(e){
		if(!$.cookie('clickCount')){
			$.cookie('clickCount',1);
			//alert('刚开始的'+$.cookie('clickCount'));
		}else{
			var old=parseInt($.cookie('clickCount'));
			if(old>=3){
				$.cookie('clickCount',1);
				//alert('清除后的'+$.cookie('clickCount'));
			}else{
				$.cookie('clickCount',old+1);
				//alert('单击次数'+$.cookie('clickCount'));
			}
			
		}
		var pX=e.pageX-$(this).offset().left;
		var pY=e.pageY-$(this).offset().top;
		var click=$.cookie('clickCount');//单击次数
		alert(pX+'--'+pY+'--'+click);
		$.post("../Api/checkBgCodeApi.php",{'x':pX,'y':pY,'click':click},function(data){
			//alert(data)
			if(data){
				$("#tishi").html('<font color=#f00>'+data+'</font>');
			}
		})
	})
}
//$(checkCode);

function getChars(){
	$.post("../Api/checkBgCodeApi.php",{'act':'read'},function(data){
			//alert(data)
			$("#tishicnt").html('请从左往右单击汉字：   <font color=#f00>'+data+'</font>   完成验证');
	})
}
//setTimeout(getChars,200);
</script>

<include file="./Public/tpl/foot.html" />
</body>
</html>
