 <div id="link">
    <!-- <div class="lanmu">导航菜单</div>
    <ul class="ul">
    	<li><a href='./addMenu.php'>添加菜单</a></li>
            <li><a href='./upMenu.php'>管理菜单</a></li>
    </ul>
    <div class="lanmu">栏目设置</div>
    <ul class="ul">
    	<li><a href='./addLanmu.php'>添加栏目</a></li>
        <li><a href='./editLanmu.php'>管理栏目</a></li>
    </ul>
    <div class="lanmu">文章设置</div>
    <ul class="ul">
    	<li><a href='./addCnt.php'>添加文章</a></li>
        <li><a href='./upCnt.php'>管理文章</a></li>
    </ul> --><!-- 以上用php实现 -->
    <!-- 以上用php+js实现 -->

<div class="lanmu">商品类别</div>
    <ul class="ul" style="display:<?php if (isset($_GET['lid'])&&$_GET['lid']==1) {echo 'block';}else{echo 'none';}?>" data-open="<?php if (isset($_GET['lid'])&&$_GET['lid']==1) {echo 1;}else{echo 0;}?>">
        <li><a href=./addCategory.v.php?lid=1>添加类别</a></li>
         <li><a href='./editCategory.php?lid=1'>管理分类</a></li>
    </ul>
    <div class="lanmu">商品属性</div>
    <ul class="ul" style="display:<?php if (isset($_GET['lid'])&&$_GET['lid']==2) {echo 'block';}else{echo 'none';}?>" data-open="<?php if (isset($_GET['lid'])&&$_GET['lid']==2) {echo 1;}else{echo 0;}?>">
        <li><a href=./addPrototype.v.php?lid=2>添加属性</a></li>
         <li><a href='./editPrototype.v.php?lid=2'>管理属性</a></li>
    </ul>
    <div class="lanmu">商品设置</div>
    <ul class="ul" style="display:<?php if (isset($_GET['lid'])&&$_GET['lid']==3) {echo 'block';}else{echo 'none';}?>" data-open="<?php if (isset($_GET['lid'])&&$_GET['lid']==3) {echo 1;}else{echo 0;}?>">
        <li><a href=./addGoods.v.php?lid=3>添加商品</a></li>
         <li><a href='./editGoods.php?lid=3'>管理商品</a></li>
    </ul>
     <div class="lanmu">销售订单</div>
    <ul class="ul" style="display:<?php if (isset($_GET['lid'])&&$_GET['lid']==4) {echo 'block';}else{echo 'none';}?>" data-open="<?php if (isset($_GET['lid'])&&$_GET['lid']==4) {echo 1;}else{echo 0;}?>">
        <li><a href=./order.v.php?lid=4>订单统计</a></li><!-- //全部订单、单个订单查询、待发货、退货、已发货、结清 -->
    </ul>
     <div class="lanmu">角色设置</div>
            <ul class="ul" style="display:<?php if (isset($_GET['lid'])&&$_GET['lid']==5) {echo 'block';}else{echo 'none';}?>" data-open="<?php if (isset($_GET['lid'])&&$_GET['lid']==5) {echo 1;}else{echo 0;}?>">
                <li><a href="./addRole.php?lid=5">添加角色</a></li>
                <li><a href='./upRole.php?lid=5'>角色管理</a></li>
                <!--  <li><a href='./access.php'>权限分配</a></li> -->       
            </ul>
    <div class="lanmu">用户设置</div>
           <ul class="ul" style="display:<?php if (isset($_GET['lid'])&&$_GET['lid']==6) {echo 'block';}else{echo 'none';}?>" data-open="<?php if (isset($_GET['lid'])&&$_GET['lid']==6) {echo 1;}else{echo 0;}?>">
               <li><a href="./addUser.php?lid=6">添加用户</a></li>
                <li><a href="./upUser.php?lid=6">用户管理</a></li>
           </ul>
     <div class="lanmu">文章设置</div>
     <ul class="ul" style="display:<?php if (isset($_GET['lid'])&&$_GET['lid']==7) {echo 'block';}else{echo 'none';}?>" data-open="<?php if (isset($_GET['lid'])&&$_GET['lid']==7) {echo 1;}else{echo 0;}?>">
         <li><a href=./addArticle.v.php?lid=7>添加文章</a></li>
         <li><a href='./editArticle.v.php?lid=7'>管理文章</a></li>
     </ul>
</div><!--link-->
    



