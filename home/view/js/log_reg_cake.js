//登录注册切换效果
// function log_or_reg(){
// 	var x=$("#form_name_log li").eq(4);
// 	x.click(function(){
// 		$("#log_box").fadeOut(0);
// 		$("#reg_box").fadeIn(0);
// 	})
// }
// $(log_or_reg)

//登录方式切换效果
function name_phnum_log(){
	$("#type_log_box li").eq(0).click(function(){
		$("#form_name_log").fadeIn(0);
		$("#box_float_phone").fadeOut(0);
		$("#form_phone_log").fadeOut(0);
	})
	$("#type_log_box li").eq(1).click(function(){
		$("#form_name_log").fadeOut(0);
		$("#form_phone_log").fadeIn(0);
		$("#box_float_phone").fadeOut(0);
	})
}
$(name_phnum_log)

//获取验证码效果
function get_phletter_box(y){
	if (y.css("display")=="none") {
		y.css("display","block");
	}else{
		y.css("display","none");
	}
}
function button_get_log() {
	var x=$("#form_phone_log li").eq(1).children().eq(1);
	var y=$("#form_box_reg li").eq(1).children().eq(1);
	x.click(function(){
		var z=$("#box_float_phone");
		get_phletter_box(z);
	})
	y.click(function(){
		var z=$("#box_float2_phone");
		get_phletter_box(z);
	})
}
$(button_get_log)

//验证码
function confirm_fun(obj){
			var x=$(obj).parent().siblings().eq(1).children().eq(0).val();
			var y=$(obj).parent().siblings().eq(1).children().eq(0);
			//alert(x);
			//alert(x.length);
			if(x.length<1){
				alert("请输入验证码");
				y.focus();
				return true;
			}
			$.get('../api/checkcodeApi.php',{code:x},function(data){
				var msg=data;
				if (msg) {
					alert(msg);
				}
				$(obj).parent().parent().css('display','none');
			},'html');
	}

