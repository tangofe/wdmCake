
<header>
           <?php
                if (!isset($_SESSION)) {
                    session_start();
                }

            ?>
<nav class="navbar">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="./indexcake.php"><img src="image/brand.png" alt=""></a>
        </div>
        <p class="navbar-text side"><i class="iconfont">&#xe611;</i>北京</p>
        <ul class="nav navbar-nav">
            <li class="active"><a href="./indexcake.php">首页</a></li>
            <li><a href="category.php?cateId=1">蛋糕</a></li>
            <li><a href="category.php?cateId=2">提货卡券</a></li>
            <li><a href="category.php?cateId=3">全国配送</a></li>
            <li><a href="./myCenter.php">会员中心</a></li>
            <li><a href="http://club.wdmcake.cn/forum.php">美粉俱乐部</a></li>
            <li><a href="category.php?cateId=4">积分换礼</a></li>
            <li><a href="service.php?id=3">企业服务</a></li>
        </ul>
        <div class="navbar-right messageBox">
            <p class="navbar-text call" style="float: right">订购热线 4001-170-170</p>
            <div class="navbar-right" style="margin-right: 10px;">
            <?php if (!isset($_SESSION['userId'])) {?>
                <ul class="list-inline login navbar-left">
                    <li><a href="./login_register_cake.php?act=login" class="navbar-link">登陆</a></li>
                    <li><a href="./login_register_cake.php?act=register" class="navbar-link">注册</a></li>
                </ul>
            <?php }else{ ?>
                <ul class="list-inline login navbar-left">
                    <li><a href="./myCenter.php" class="navbar-link">欢迎您，<span><?php 
                    if (isset($_SESSION['userId'])) {
                    	if (isset($_SESSION['userName'])&&$_SESSION['userName']!=""){echo $_SESSION['userName']; }
                    	else{echo $_SESSION['phoneNum'];}
                    } ?></span></a></li>
                    <li><a href="../api/useroutApi.php" class="navbar-link">退出</a></li>
                </ul>
            <?php } ?>
            <ul class="list-inline car navbar-left">
                <li><a href="./shopcar.php" class="navbar-link"><i class="iconfont">&#xe601;</i><em id="getShopcarnum">0</em></a></li>
                <li><a href="./othLink.php?id=16" class="navbar-link"><i class="iconfont">&#xe604;</i></a></li>
            </ul>
            </div>
        </div>

    </div><!-- /.container -->
</nav>
<script>
function shopcarnum() {
    $.get('../api/shopCarApi.php',{act:"getShopcarnum"},function(data){
       if(data.code==105){
                var shopcarnum=0;
                var newdata=data.data;
                var num=newdata.length;
                $("#getShopcarnum").html(num);
            }
        },'json')

}
$(shopcarnum);
</script>
</header>