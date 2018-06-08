<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="./css/css.css" rel="stylesheet" type="text/css" />
    <script  src="./js/jquery2.14.min.js"></script>
    <script  src="./js/script.js"></script>
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
            <div id="updata_lanmu"><!--管理栏目-->
                <div class="title">文章设置---&gt;管理文章</div>
                <?php
                include('../Api/editArticleApi.php');
                ?>
                <table width="803" border="0" cellspacing="0" cellpadding="0">

                    <tr>
                        <td>操作</td>
                        <td>文章id</td>
                        <td>文章标题</td>
                    </tr>
                    <?php
                    if(!$rows){exit;}
                    $tab='';
                    foreach($rows as $row){
                        $tab.='<tr>
					<td width="113"><a href="../View/upArticle.v.php?lid=7&act=editArticle&id='.$row['id'].'   ">编辑</a><a href="../Api/editArticleApi.php?act=deleteArticle&id='.$row['id'].'  ">删除</a></td>
					<td width="95">'.$row['id'].'</td>
					<td width="95">'.$row['art_name'].'</td>
				 </tr>';
                    }
                    echo $tab;
                    ?>

                </table>

            </div><!---updatalanmu---->
           <!-- <div id="fpage">--><?php  //echo $link; ?><!--</div>-->
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
