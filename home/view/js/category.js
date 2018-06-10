	//列表页的图片放大缩小特效
	function big_img(){
		var img = $(".goods_img").find('img');
		$w = img.width();
		$h = img.height();
		$w2= $w + 10;
		$h2= $h + 10;
		$(".goods_img").mouseenter(function(){
			$(this).find("img").stop().animate({width:$w2,height:$h2,left:'-5px',top:'-5px'},400);
		}) 
		$(".goods_img").mouseleave(function(){
			$(this).find("img").stop().animate({width:$w,height:$h,left:'0px',top:'0px'},400);
		})
	}
	big_img();

	//商品数量的加减
	function delnum(e){
		var numObj = $(e).parent().children().eq(1);
		var oldNum = parseInt(numObj.val());
		//当前数量
		if (numObj.val()<=1) {
			alert("购买商品数量不能小于1");
			return false;
		 }
		var num = oldNum-1;
		numObj.val(num);

		//获取当前商品的价格
		var str = $(e).parent().parent().siblings().eq(2).text();
		var price = parseFloat(str.substr(1));

		//商品总价格
		var AllPrice=parseFloat(price)*parseInt(numObj.val());
		AllPrice=AllPrice.toFixed(2);
		$(e).parent().parent().siblings().eq(3).children().text(AllPrice);

		//旧的总价格
		var oldAllPrice = parseFloat($("#price_sum").text());
		var newAllPrice = "";
		newAllPrice= oldAllPrice-price;
		newAllPrice= newAllPrice.toFixed(2);
		$("#price_sum").text(newAllPrice);
		$(".submit a").attr("href","orderForm.php?all="+newAllPrice);
		//取当前li中的商品id
		var goodid=$(e).parent().parent().siblings().eq(5).val();
		var pcs=$(e).parent().parent().siblings().eq(1).text();
		$.get('../api/shopCarApi.php',{'act':'changeNum','goodid':goodid,'num':num,'pcs':pcs},function(data){
		},'html')
	}
	function addnum(e){
		var numObj = $(e).parent().children().eq(1);
		var oldNum = parseInt(numObj.val());
		//当前数量
		var num = oldNum+1;
		numObj.val(num);

		//获取当前商品的价格
		var str = $(e).parent().parent().siblings().eq(2).text();
		var price = parseFloat(str.substr(1));

		//商品总价格
		var AllPrice=parseFloat(price)*parseInt(numObj.val());
		AllPrice=AllPrice.toFixed(2);
		$(e).parent().parent().siblings().eq(3).children().text(AllPrice);

		//旧的总价格
		var oldAllPrice = parseFloat($("#price_sum").text());
		var newAllPrice = "";
		newAllPrice= oldAllPrice+price;
		newAllPrice= newAllPrice.toFixed(2);
		$("#price_sum").text(newAllPrice);
		$(".submit a").attr("href","orderForm.php?all="+newAllPrice);
		// $("#pricesum").text(newAllPrice);
		//取当前li中的商品id
		var goodid=$(e).parent().parent().siblings().eq(5).val();
		var pcs=$(e).parent().parent().siblings().eq(1).text();
		$.get('../api/shopCarApi.php',{'act':'changeNum','goodid':goodid,'num':num,'pcs':pcs},function(data){
		},'html')
		
	}

	//列表页的立即购买按钮
	function buyGoods(e){
		var id=$(e).parent().children().eq(0).val();
		var price=$(e).parent().siblings().eq(2).children().eq(1).text();
		var name=$(e).parent().parent().siblings().eq(0).children().eq(0).children().text();
		var img=$(e).parent().parent().parent().siblings().eq(0).children().html();
		var pcs=$(e).parent().siblings().eq(2).children().eq(2).children().eq(1).text();
		var pricepcs=$(e).parent().siblings().eq(2).children().eq(2).children().eq(0).text();
		if(pricepcs=="积分"){
			price=parseInt(price)/100;
		}
		$.get('../api/shopCarApi.php',{'act':'addGoodsToShopCar','id':id,'name':name,'price':price,'img':img,'pcs':pcs},function(data){
			// alert(data.data);
			if(data.code==100){
				alert(data.msg);
				window.location.href="./login_register_cake.php";
			}else{
				// alert(data.msg);
				window.location.href="./shopcar.php";
			}
		},'json');
	}

	//删除商品
	function delGoods(e){
		var id=$(e).parent().siblings().eq(5).val();
		var pcs=$(e).parent().siblings().eq(1).text();
		$.get('../api/shopCarApi.php',{'act':'delgoods','id':id,'pcs':pcs},function(data){
			// alert(data.msg);
			window.location.href=" ";
		},'json')
	}

	//购物车蜡烛附件的板块设置
	function order_history(){
		$(".order_history").css('display','none');
	}
	//购物车蜡烛附件的立即购买功能
	function buyGoods1(e){
		var id=$(e).parent().children().eq(0).val();
		var price=$(e).parent().children().eq(2).children().eq(1).text();
		var name=$(e).parent().children().eq(2).children().eq(0).text();
		var img=$(e).parent().children().eq(1).html();
		$.get('../api/shopCarApi.php',{'act':'addGoodsToShopCar1','id':id,'name':name,'price':price,'img':img},function(data){
			// alert(data.data);
			if(data.code==100){
				alert(data.msg);
				window.location.href="./login_register_cake.php";
			}else{
				// alert(data.msg);
				window.location.href="./shopcar.php";
			}
		},'json');
	}

// 	function likenum_add(e){
// 	var status=1;
// 		if (status==1) {
// 			var id=$(e).parent().siblings().eq(2).children().eq(0).val();
// 			var num=$(e).siblings().eq(0).text();
// 			$.get('../api/GoodsApi.php',{'act':'likenum_add','num':num,'id':id},function(data){
// 			//alert(data.code)
// 			if (data.code==101) {
// 				alert(data.data);
// 			}
// 			if (data.code==102) {
// 				$(e).siblings().eq(0).text(data.data);
// 				status=0;
// 			}
// 		},"json");
// 		}else{
// 				alert("您已点击过");
// 		}
// }
function likenum_add(){
	$(".like").click(function(){
		var status=$(this).siblings().eq(1).val();
		if (status==1) {
			var id=$(this).parent().siblings().eq(2).children().eq(0).val();
			var num=$(this).siblings().eq(0).text();
			var new_num=parseInt(num)+1;
			status=0;
			$(this).siblings().eq(1).val(status);
			$(this).siblings().eq(0).text(new_num);
			$.get('../api/GoodsApi.php',{'act':'likenum_add','num':num,'id':id},function(data){
			if (data.code==101) {
				alert(data.data);
				window.history.go(0);
			}
			if (data.code==102) {
				
			}
			},"json");
		}else{
				alert("您已点击过");
		}
	})
}
$(likenum_add);