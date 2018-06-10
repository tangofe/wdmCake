//详情页面.....................................................................................................
//当前位置显示
function getGoodsLocation(){
	var id=$("#good_id").val();
	$.get('../api/CategoryApi.php',{'act':'getGoodsLocation','id':id},function(data){
		var tab='当前位置：<a href="">首页</a>';
		for(var i=data.length-1;i>-1;i--){
			if (i==0) {
				tab+='<code>></code><a href="#">'+data[i][1]+'</a> ';
			}
			if(i==1){
				tab+='<code>></code><a href="category.php?id='+data[i][0]+'&act=getCategoryGoods&name='+data[i][1]+'">'+data[i][1]+'</a> ';
			}
			if(i==2) {	
				tab+='<code>></code><a href="category.php?cateId=1">'+data[i][1]+'</a> ';
			}
 		}
		$("#current_position_detail").html(tab);	
		var obj=data[data.length-1][0];
		if (obj!=1) {
			$("#type_detail").hide();
		}
		//hotGoods(obj);
	},'json')	
}
$(getGoodsLocation);
//热销商品设置
function hotGoods(){
	//var cid=i;
	var cid=$("#good_id").val();
	$.get('../api/GoodsApi.php',{'act':'getCategoryAllGoods','id':cid},function(data){	
		var jsonObj = $.parseJSON(data);
		var tab="";
		if (jsonObj.length>10) {
			for(var i=0;i<10;i++){
			if (i==0) {
					tab+='<li id="content_left_'+(i+1)+'" onmouseover="left_more_detail_fun(this)"><a href="detail_cake.php?id='+jsonObj[i].id+'"><span>'+jsonObj[i].name+'</span></a><a href="detail_cake.php?id='+jsonObj[i].id+'"><img src="/'+jsonObj[i].img+'"></a></li>';
				}else{
					tab+='<li id="content_left_'+(i+1)+'" onmouseover="left_more_detail_fun(this)"><a href="detail_cake.php?id='+jsonObj[i].id+'"><span>'+jsonObj[i].name+'</span></a><a href="detail_cake.php?id='+jsonObj[i].id+'" style="display: none;"><img src="/'+jsonObj[i].img+'"></a></li>';
				}			
			}
		}else{
			for(var i=0;i<jsonObj.length;i++){
			if (i==0) {
				tab+='<li id="content_left_'+(i+1)+'" onmouseover="left_more_detail_fun(this)"><a href="detail_cake.php?id='+jsonObj[i].id+'"><span>'+jsonObj[i].name+'</span></a><a href="detail_cake.php?id='+jsonObj[i].id+'"><img src="/'+jsonObj[i].img+'"></a></li>';
				}else{
					tab+='<li id="content_left_'+(i+1)+'" onmouseover="left_more_detail_fun(this)"><a href="detail_cake.php?id='+jsonObj[i].id+'"><span>'+jsonObj[i].name+'</span></a><a href="detail_cake.php?id='+jsonObj[i].id+'" style="display: none;"><img src="/'+jsonObj[i].img+'"></a></li>';
				}			
			}
		}
		
		$("#left_more_ul").html(tab);
	},'html');
}
$(hotGoods);

//焦点图效果
function changImg_detail(i){
	//$('#pic_left_detail li').eq(i).fadeIn(500).siblings().fadeOut(500);
	$('#pic_left_detail li').eq(i).fadeIn(500).siblings().fadeOut(500);
	$('#pic_right_detail li').eq(i).children().addClass('addborder');
	$('#pic_right_detail li').eq(i).siblings().children().removeClass();
}
// $(changImg_detail(1));
// $(changImg_detail(2));
function getBigimg_detail(){
	$('#pic_right_detail li').mouseenter(
		function(){
			var x=$(this).index();
			changImg_detail(x);
		}
	)
}
$(getBigimg_detail);

//左方菜单名称上方鼠标悬浮效果
//
function outImg_detail(i){
	var obj=$('#left_more_ul li').eq(i);
	obj.children().eq(1).fadeIn(0);
	
	for(j=0;j<obj.siblings().length;j++){
		obj.siblings().eq(j).children().eq(1).fadeOut(0);
	}
}
function left_more_detail_fun(obj){
	$('#left_more_ul li').mouseenter(
		function(){
			var x=$(obj).index();
			outImg_detail(x);
		}
	);
}



//右方购买选项价格/规格变化效果
//
function outIntru_detail(i){
	$('#unit_intru div').eq(i).removeClass().addClass('type2_unit_intru').siblings().removeClass().addClass('type_unit_intru');
	//悬浮时效果
}
function unit_intru_detail_fun(){
	//设置悬浮效果
	$('#unit_intru div').eq(1).removeClass().addClass('type2_unit_intru');
	$('#unit_intru div').mouseenter(function(){
		var x=$(this).index();
		outIntru_detail(x);
	});
// 	//设置文本效果
// 	$('#unit_intru div').click(function(){
// 		var t=$(this).index();
// 		var y=$('#number_price');
// 		switch(t){
// 			case 0:
// 				var z1=168;
// 				var x=parseInt($("#number_intru input").eq(1).val());//数量框数值
// 				var obj=z1*x;
// 				y.text(obj);
// 				break;
// 			case 1:
// 				var z2=208;
// 				var x=parseInt($("#number_intru input").eq(1).val());//数量框数值
// 				var obj=z2*x;
// 				y.text(obj);
// 				break;
// 			case 2:
// 				var z3=288;
// 				var x=parseInt($("#number_intru input").eq(1).val());//数量框数值
// 				var obj=z3*x;
// 				y.text(obj);
// 				break;
// 			case 3:
// 				var z4=398;
// 				var x=parseInt($("#number_intru input").eq(1).val());//数量框数值
// 				var obj=z4*x;
// 				y.text(obj);
// 				break;
// 		}
// 		outIntru_detail(t);
// 	})
}
$(unit_intru_detail_fun);

//购买数量/价格的效果
//
function add_del_detail_fun() {
	var ret=$("#good_cid").val();
	if (ret!=15) {
		$("#number_intru input").eq(0).click(function(){
		var x=parseInt($("#number_intru input").eq(1).val());//数量框数值
		var y=parseInt($('#number_price').text());//价格
		x--;
		if(x<1){
			alert('此商品的最小购买数量为1件');
			x++;
			return false;
		}
		var obj=x*y/(x+1);
		$("#number_intru input").eq(1).val(x);
		$('#number_price').text(obj);
		}).mouseenter(function(){
			$("#number_intru input").eq(0).css({'border-color':'#BC002D'})
		}).mouseleave(function(){
			$("#number_intru input").eq(0).css({'border-color':'#757575'})
		})

		$("#number_intru input").eq(1).change(function(){
			var x=parseInt($(this).val());//数量框数值
			var y=parseInt($('#number_price').text());//价格
			var obj=x*y;
			$('#number_price').text(obj);
		})

		$("#number_intru input").eq(2).click(function(){
			var x=parseInt($("#number_intru input").eq(1).val());//数量框数值
			var y=parseInt($('#number_price').text());//价格
			x++;
			var obj=x*y/(x-1);
			$("#number_intru input").eq(1).val(x);
			$('#number_price').text(obj);
		}).mouseenter(function(){
			$("#number_intru input").eq(2).css({'border-color':'#BC002D'})
		}).mouseleave(function(){
			$("#number_intru input").eq(2).css({'border-color':'#757575'})
		})	
	}
	
	
}
$(add_del_detail_fun)
//加入购物车设置
function addToShopCar(){
	$("#botton_intru").click(function(){
		var id=$("#good_id").val();
		var pricesum=$("#number_price").text();
		var num=$("#number_cake").val();
		var price=pricesum/num;
		var name=$("#good_name").val();
		var img=$("#pic_right_detail").children().eq(0).html();
		var pcssum=$("#other_price").text();
		var n=pcssum.indexOf("/")+1;
		if (n!=0) {
			var pcs=pcssum.substr(n,5);		
		}else{
			var new_pcssum=pcssum.replace(/\s/g, "");
			var pcs=new_pcssum.substr(3,5);	
		}	 
		$.get('../api/shopCarApi.php',{'act':'addGoodsToShopCar','id':id,'name':name,'price':price,'img':img,'pcs':pcs,'num':num},function(data){
			// alert(data.data);
			if(data.code==100){
				alert(data.msg);
				window.location.href="./login_register_cake.php";
			}else{
				alert(data.msg);
				window.location.href="./shopcar.php";
			}
		},'json');
	})
}
$(addToShopCar);
//添加喜欢设置
function likenum_add(){
	var status=1;
	$(".like").click(function(){
		if (status==1) {
			var id=$("#good_id").val();
			var num=$(".like").children().text();
			$.get('../api/GoodsApi.php',{'act':'likenum_add','num':num,'id':id},function(data){
			//alert(data.code)
			if (data.code==101) {
				alert(data.data);
			}
			if (data.code==102) {
				$(".like span").text(data.data);
				
			}
		},"json");
			status=0;
		}else{
				alert("您已点击过");
		}
	})
}
$(likenum_add);


//温馨提示文章显示
function detail_tip_fun(){
	var id=$("#good_cid").val();
	$.get('../api/CategoryApi.php',{'act':'detail_tip','id':id},function(data){
		var obj=data.content;
		var rows=obj.split("#");
		var tab="";
		tab='<div class="title_1_more"><div class="symbol_title_detail"></div><span>温馨提示</span></div><div id="box_3_more">';
		for(var i=0;i<rows.length;i++){
			tab+='<div class="article_3_more"><span>'+(i+1)+'、</span><p>'+rows[i]+'</p ></div>';
		}
		tab+="</div>";

		$("#more_detail_3").html(tab);
	},"json");
}
$(detail_tip_fun);
