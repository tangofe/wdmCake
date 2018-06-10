<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="./css/css.css" rel="stylesheet" type="text/css" />
    <script  src="./js/jquery2.14.min.js"></script>
    <script  src="./js/script.js"></script>
    <script type="text/javascript" charset="utf-8" src="./ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="./ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="./ueditor/lang/zh-cn/zh-cn.js"></script>

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
            <div id="add_menu"><!----add_menu---->
                <div class="title">商品设置---&gt;添加商品</div>
                <div id="edit_cnt"><!----edit_cnt---->
                    <form action="../Api/addArticleApi.php" method="post">
                        <table width="470" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="align_r">文章标题:</td>
                                <td class="align_l"><input type="text" name="article_title" id="good_name" /></td>
                            </tr>
                            <tr>
                                <td class="align_r">文章内容:</td>
                                <td class="align_l">
                                    <textarea id="editor" name="content" style="width:700px;height:400px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="align_r"><input type="submit" id="btn" name="btn" class="btn" value="添加文章" /></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!---editcnt---->
            </div><!---addmenu---->


            <!--------------------------------->
        </div><!--menu-->

    </div><!---cnt---->
</div><!--list-->
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
        var img='<img width="100px" src="'+pp+'"/>';
        //$("#src").attr("src",pp);
        var old=$("#srcTxt").val();
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
</body>
</html>
