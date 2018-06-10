<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加商品</title>
<link href="./css/css.css" rel="stylesheet" type="text/css" />
<script  src="./js/jquery2.14.min.js"></script>
    <script src="./js/script.js"></script>
<script type="text/javascript" charset="utf-8" src="./ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="./ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="./ueditor/lang/zh-cn/zh-cn.js"></script>
<style>	
	#goods_tab{
		width:100%;
		overflow: hidden;
	}
	#goods_tab span{
		display: block;width:120px;height:40px;line-height: 40px;background: #ccc;text-align: center;float:left;margin-right:20px;
		margin-top:10px;
		cursor:pointer;
	}
	.whites{
		color:#fff;
	}
	#img_box img{
		width:83px;
	}
	#img_box02 img{
		width:83px;
	}

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
  	<div id="cnt">
  		<div class="menu" id="menu">
      		<div class="title">商品设置---&gt;更新商品</div>
		      	<div id="edit_cnt">
			      <?php 
			      include('../Api/upGoodsApi.php');
			      if(!$goodInfo){
			      	exit;
			      }
			      $good=$goodInfo['good'];
			      $pro=$goodInfo['pro'];
			      ?>
			      	<div id="goods_tab">
						<span id="gt_base" class="whites">基本设置</span><span id="gt_other">其它属性</span>
			      	</div>
			      	<form action="../Api/upGoodsApi.php?act=upGoodsInfo&id=<?php echo $good['id'];?>" method="post">
				      	
				      	<div id="goods_base" style="clear:both" >		      
							<table width="470" border="0" cellspacing="0" cellpadding="0">
								<tr>
							  <td width="86" class="align_r">所属分类:</td>
							  <td  class="align_l">
							       <select name="cid" id="cid" onchange="changePro(this)">
									<option value=0>----请选择分类----</option>
									<?php
										$tab="";
										foreach($categorys as $row){
											
											if($good['cid']==$row['id']){
												$tab.="<option selected='selected' value={$row['id']}>{$row['html']}{$row['name']}</option>";
											}else{
												$tab.="<option value={$row['id']}>{$row['html']}{$row['name']}</option>";
											}
										}
										echo $tab;
									?>
									

							  </select>
							  </td>
							</tr>
								<tr>
								  <td class="align_r" width="86">商品名称:</td>
								  <td class="align_l"><input type="text" name="good_name" id="good_name" value="<?php echo $good['name'];?>"/></td>
								  </tr>
								<tr>
								  <td class="align_r">商品价格:</td>
								  <td class="align_l"><input type="text" name="good_price" id="good_price" value="<?php echo $good['price'];?>"/></td>
								</tr>
								<tr>
								  <td class="align_r">计价单位:</td>
								  <td class="align_l">
								  	<select name="good_pcs" id="good_pcs" >
								  		<option value="">无</option>
								  		<option value="Φ15cm">Φ15cm</option>
								  		<option value="Φ18cm">Φ18cm</option>
								  		<option value="Φ19cm">Φ19cm</option>
								  		<option value="Φ20cm">Φ20cm</option>
								  		<option value="3层">3层</option>
								  		<option value="4层">4层</option>
								  		<option value="6元">6元</option>
								  		<option value="8元">8元</option>
								  		<option value="10元">10元</option>
								  		<option value="15元">15元</option>
								  		<option value="16元">16元</option>
								  		<option value="20元">20元</option>
								  	</select>
								  </td>
								</tr>
								<tr>
								  <td class="align_r" width="86">商品价格集:</td>
								  <td class="align_l"><input type="text" name="good_pricesum" id="good_pricesum" value="<?php echo $good['pricesum'];?>" /></td>
								</tr>
								<tr>
								  <td class="align_r" width="86">计价单位集:</td>
								  <td class="align_l"><input type="text" name="good_pcssum" id="good_pcssum" value="<?php echo $good['pcssum'];?>" /></td>
								</tr>
								<tr>
								  <td class="align_r" width="86">商品描述:</td>
								  <td class="align_l"><input type="text" name="good_depict" id="good_depict" value="<?php echo $good['depict'];?>" /></td>
								</tr>
								<tr>
								  <td class="align_r" width="86">订购提示:</td>
								  <td class="align_l"><input type="text" name="good_summary" id="good_summary" value="<?php echo $good['summary'];?>" /></td>
								</tr>
								<tr>
								  <td class="align_r">商品相册:</td>
								  <td class="align_l">
								  	<input type="button" onClick="upImage()" value="上传图片"> 
								  	<input type="text" id="srcTxt" name="thumbImg"  value="<?php
											if($good['img']){
												echo $good['img'];
											}
										?>"   />
									<div id="img_box">
										<?php echo htmlspecialchars_decode($good['img']);?>			
									</div>	
								  </td>
								</tr>
								<tr>
								  <td class="align_r">分类标记:</td>
								  <td class="align_l">
								  	<select name="good_type" id="good_type" >
								  		<option value="0">无</option>
								  		<option value="1">天然奶油蛋糕</option>
								  		<option value="2">法式蛋糕</option>
								  		<option value="3">乳酪蛋糕</option>
								  		<option value="4">慕斯蛋糕</option>
								  		<option value="5">巧克力风味蛋糕</option>
								  		<option value="6">大型庆典蛋糕</option>
								  	</select>
								  </td>
								</tr>
								<tr>
								  <td class="align_r">商品尺寸介绍图:</td>
								  <td class="align_l">
								  	<input type="button" onClick="upImage02()" value="上传图片"> 
								  	<input type="text" id="srcTxt02" name="good_sizeImg" value="<?php
											if($good['sizeimg']){
												echo $good['sizeimg'];
											}
										?>" />
									<div id="img_box02" >
									<?php echo htmlspecialchars_decode($good['sizeimg']);?>					
									</div>	
								  </td>
								</tr>
								<tr>
								  <td class="align_r">商品详情:</td>
								  <td class="align_l">
								  <textarea id="editor" name="content" style="width:700px;height:400px;">
										<?php echo htmlspecialchars_decode($good['cnt']);?>
								  </textarea>
								  		
								  </td>
								</tr>
								<tr>
								  <td class="align_r"></td>
								  <td>&nbsp;</td>
								  </tr>
							</table>					
						</div>
						<div id="goods_other" style="clear:both;display: none;">
							<table id="goods_other_tab" width="470" border="0" cellspacing="0" cellpadding="0">
								<?php
									$goodPro=unserialize($good['prototype']);
									// echo "<pre>";
									// print_r($goodPro);
									// echo "</pre>";
									$tab="";
									for($i=0;$i<count($pro);$i++){

										$row=$pro[$i];
										if($row['type']==2){//有多个选项值，值与值之间用逗号分隔
											//alert(row.value+'--'+row.id)
											$str=$row['value'];
											$str=explode(',',$str);
											//alert(row.name)
											$sel='<select name="'.$row['name'].'" id="pro_'.$row['id'].'_'.$row['name'].'" >';
											$tag=false;
											for($j=0;$j<count($str);$j++){				
												foreach($goodPro as $key=>$val){
													if($val==$str[$j]){
														$tag=true;
														continue;
													}
												}
												if($tag){
													$sel.='<option selected="selected" value="'.$str[$j].'">'.$str[$j].'</option>';
												}else{
													$sel.='<option value="'.$str[$j].'">'.$str[$j].'</option>';
												}
											}
											$sel.='</select>';
											$tab.='<tr><td width="86" class="align_r">'.$row['name'].':</td><td class="align_l">'.$sel.'</td></tr>';
											//alert(tab)
										}else{//手工输入
											//alert(row.name+'--'+row.id)
											foreach($goodPro as $key=>$val){
												if($key==$row['name']){
													$tab.='<tr><td width="86" class="align_r">'.$row['name'].':</td><td class="align_l"><input type="text" value='.$val.' name="'.$row['name'].'" id="pro_'.$row['id'].'_'.$row['name'].'" /></td></tr>';
												}
											}
											// $tab.='<tr><td width="86" class="align_r">'.$row['name'].':</td><td class="align_l"><input type="text" name="'.$row['name'].'" id="pro_'.$row['id'].'_'.$row['name'].'" /></td></tr>';
										}
									}
									echo $tab;


								?>

							</table>
						</div>


						<input type="submit" id="btn" name="btn" class="btn" value="更新商品" />
					</form>
		     	 </div>

      		</div>
  
  		</div>
  	</div>
</div>
  <?php
include('./footer.php');
?>
<script>
 //实例化编辑器
 //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
 var ue = UE.getEditor('editor');

</script>
 
<div id="test"><img width="200px" id="src"/></div> 
<script type="text/plain" id="j_ueditorupload" style="height:5px;display:none;" ></script> 
<script type="text/plain" id="j_ueditorupload02" style="height:5px;display:none;" ></script> 
<script>
 //实例化编辑器  
      var o_ueditorupload = UE.getEditor('j_ueditorupload',  
      {  
        autoHeightEnabled:false  
      });  
      o_ueditorupload.ready(function ()  
      {  
        o_ueditorupload.hide();//隐藏编辑器  
        
        //监听图片上传  
        o_ueditorupload.addListener('beforeInsertImage', function (t,arg)  
         {  
          	var pp = (arg[0].src);  
          	var img='<img  src="'+pp+'"/>';
       	//$("#src").attr("src",pp);  
          	var old=$("#srcTxt").val();
          	$("#srcTxt").val(old+img);
          	//$("#srcTxt").val(old+img);         		
          	$("#img_box").append(img);
        });  
         });           
      //弹出图片上传的对话框  
      function upImage() {  
        	var myImage = o_ueditorupload.getDialog("insertimage");  
        	myImage.open();  
      }  
</script>
<script>
 //实例化编辑器  
      var oo_ueditorupload = UE.getEditor('j_ueditorupload02',  
      {  
        autoHeightEnabled:false  
      });  
      oo_ueditorupload.ready(function ()  
      {  
        oo_ueditorupload.hide();//隐藏编辑器  
        
        //监听图片上传  
        oo_ueditorupload.addListener('beforeInsertImage', function (t,arg)  
         {  
          	//alert(arg);
          	var pp = (arg[0].src);  
          	var img='<img src="'+pp+'"/>';
       	//$("#src").attr("src",pp);  
          	var old=$("#srcTxt02").val();
          	$("#srcTxt02").val(old+img);
          	//$("#srcTxt").val(old+img);         		
          	$("#img_box02").append(img);
        });  
         });           
      //弹出图片上传的对话框  
      function upImage02() {  
        	var myImage = oo_ueditorupload.getDialog("insertimage");  
        	myImage.open();  
      }  
</script>
<script>
	//切换选项卡
	$(function(){
		$("#gt_base").click(function(){
			$(this).addClass('whites').siblings().removeClass('whites');
			$("#goods_base").css("display",'block');
			$("#goods_other").css("display",'none');
		})
		$("#gt_other").click(function(){
			
			$(this).addClass('whites').siblings().removeClass('whites');
			$("#goods_base").css("display",'none');
			$("#goods_other").css("display",'block');
			var cid=$("#cid option:selected").val();		
			var h=$("#goods_other_tab").html();
			if(h){//原table中不能有空格
				//alert(h);
				$("#goods_other_tab").html(h);
			}else{
				//alert('no');
				//if(cid>0){getProById(cid);}
			}			
		})
	})
	//所属分类下拉列表发生变化
	function changePro(e){
		//alert($(e).val());
		var id=$(e).val();//根据分类id，在goods_prototype表中取其全部属性
		getProById(id);
	}
	//通过id 获取属性
	function getProById(id){
		$.get('../Api/getPrototypeApi.php',{act:'getPrototype',cid:id},function(data){
				var tab="";
				for(var i in data){
					var row=data[i];
					if(row.type==2){//有多个选项值，值与值之间用逗号分隔
						//alert(row.value+'--'+row.id)
						var str=row.value;
						str=str.split(',');
						//alert(row.name)
						var sel='<select name="'+row.name+'" id="pro_'+row.id+'_'+row.name+'" >';
						for(var i in str){
							sel+='<option value="'+str[i]+'">'+str[i]+'</option>';
						}
						sel+='</select>';
						tab+='<tr><td width="86" class="align_r">'+row.name+':</td><td class="align_l">'+sel+'</td></tr>'
						//alert(tab)
					}else{//手工输入
						//alert(row.name+'--'+row.id)
						tab+='<tr><td width="86" class="align_r">'+row.name+':</td><td class="align_l"><input type="text" name="'+row.name+'" id="pro_'+row.id+'_'+row.name+'" /></td></tr>'
					}
				}
				$("#goods_other_tab").html(tab);

		},'json')
	}

</script>
</body>
</html>
