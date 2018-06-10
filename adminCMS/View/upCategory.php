<?php session_start();
//header("content-type:text/html;charset=utf-8;");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加商品分类</title>
<link href="./css/css.css" rel="stylesheet" type="text/css" />
<script  src="./js/jquery2.14.min.js"></script>
<script  src="./js/fun.js"></script>
    <script src="./js/script.js"></script>
<script type="text/javascript" charset="utf-8" src="./ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="./ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="./ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
	// $(function(){

	// 	alert('aa');
	// })
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
    <div id="add_lanmu"><!----add_lanmu---->
      	<div class="title">分类设置---&gt;更新商品分类</div>
      	<?php 
      		include('../Api/upCategoryApi.php');
      		//echo "<pre>";
      		//print_r($row);
      	?>
<form action="../Api/upCategoryApi.php?act=upCategory" method="post">
	<table width="470" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td width="135"  class="align_r">当前分类:</td>
		  <td width="596" class="align_l">
		  <select name="id">
				<?php
					$tab="";
					foreach($rows as $val){
						
						if($val['id']==$row['id']){
							$tab.="<option  selected='selected' value={$val['id']}>{$val['html']}{$val['name']}</option>";
						}else{
							//$tab.="<option value={$val['id']}>{$val['html']}{$val['name']}</option>";
						}
					}
					echo $tab;
				?>
				

		  </select></td>
		  </tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr>
			<td class="align_r">分类小图</td>
			<td class="align_l">
				<div>			  	
					<input type="button" onClick="upImage()" value="上传图片"> 
				  	<input type="text" id="srcTxt" name="thumbImg" value="<?php
						if($row['img']){
							echo $row['img'];
						}
					?>	"/>
			  	</div>	
				<div id="img_box">
					<?php
						if($row['img']){
							echo htmlspecialchars_decode($row['img']);
						}
					?>				
				</div>
			</td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td class="align_r">分类名称:</td>
		  <td class="align_l"><input type="text" name="categoryName" id="categoryName" value="<?php echo $row['name'];?>"/></td>
		  </tr>
		<tr>
		  <td class="align_r">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td class="align_r"><input type="submit" name="btn" id="btn" class="btn" value="保存信息" /></td>
		  <td>&nbsp;</td>
		  </tr>
	</table>
</form>
      </div><!---addlanmu---->


  	<!--------------------------------->  
  	</div>
  	<!--menu-->
  
  </div><!---cnt---->
</div><!--list-->
  <?php
include('./footer.php');
?>
</body>
<script type="text/plain" id="j_ueditorupload" style="height:5px;display:none;" ></script> 
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
          	//alert(pp)
          	//$("#srcTxt").val(old+img);    
          	$("#srcTxt").val(old+img);   		
          	$("#img_box").append(img);
        });  
         });           
      //弹出图片上传的对话框  
      function upImage() {  
        	var myImage = o_ueditorupload.getDialog("insertimage");  
        	myImage.open();  
      }  
</script>
</html>
