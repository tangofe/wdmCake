function email_phnum_findpwd(){
	$("#find_type input").eq(0).click(function(){
		$("#find_by_phone").css("display","block");
		$("#find_by_email").css("display","none");
		$("#verific_code_box").css("display","none");
	})
	$("#find_type input").eq(1).click(function(){
		$("#find_by_phone").css("display","none");
		$("#find_by_email").css("display","block");
		$("#verific_code_box").css("display","none");
	})
}
$(email_phnum_findpwd);

function verific_phnum_findpwd(){
	$("#phone_num_button").click(function(){
		if ($("#verific_code_box").css("display")=="none"){
			$("#verific_code_box").css("display","block");
		}else{
			$("#verific_code_box").css("display","none");
		}
	})
}
$(verific_phnum_findpwd);


function check_box(){
			var x=$('#verific_box').val();
			if(x.length<1){
				alert("请输入验证码");
				$('#phone_num').focus();
				$("#verific_code_box").css("display","none");
				return false;
			}
			$.get('../api/checkcodeApi.php',{code:x},function(data){
				var msg=data;
				if (msg) {
					alert(msg);
				}
				$("#verific_code_box").css("display","none");
			},'html')	
	}