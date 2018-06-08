// 菜单效果
// function menu_Center_Choise(){
// 	$(".left_menu_title div a").click(function(){
// 		var u=$(this).parent().parent().index();//[0,1,2]
// 		var t=$(this).parent().index();//[1,2]
// 		var num=u*2+t;
// 		//左边菜单红色原点变化
// 		$(".dot").css({'display':'none'});
// 		$(this).siblings().css({'display':'block'});
// 		//右边内容显示
// 		$("#right_menu_myCenter").children().eq(num).css({'display':'block'}).siblings().css({'display':'none'});
// 	})
// }
$(menu_Center_Choise);
//订单/收藏/地址跳转效果
function order_collect_adress(obj){
	var row=$(obj).text();
	if (row=="所有的订单") {
		$("#user_order").css({'display':'block'}).siblings().css({'display':'none'});
	}else if(row=="所有的收藏"){
		$("#user_collect").css({'display':'block'}).siblings().css({'display':'none'});
	}else{
		alert("该功能未实现,敬请期待！")
	}
}
