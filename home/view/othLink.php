<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>购物帮助_味美多蛋糕官网</title>
    <link rel="shortcut icon" href="./images/animated_favicon.gif"/>
    <meta name="keyword" content="">
    <meta name="description" content="">
    <meta name="author" content="tango">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body class="service othLink">
<?php include './header.php' ?>
<main>
    <div class="main">
        <div class="container">
        <div class="location">当前位置:首页</div>
        <div class="serContent clearfix">
            <div class="pull-left clearfix">
            <ul class="list-unstyled pull-left">
                <li><a href="">帮助中心</a></li>
                <li><a href="othLink.php?id=16">购物帮助</a></li>
                <li><a href="othLink.php?id=17">支付方式</a></li>
                <li><a href="othLink.php?id=18">配送方式</a></li>
            </ul>
            <ul class="list-unstyled pull-left">
                <li><a href="">门店服务</a></li>
                <li><a href="othLink.php?id=19">门店查询</a></li>
                <li><a href="othLink.php?id=20">购卡须知</a></li>
                <li><a href="othLink.php?id=21">提货卡/积分卡查询</a></li>
            </ul>
            <ul class="list-unstyled pull-left">
                <li><a href="">关于我们</a></li>
                <li><a href="service.php?id=8">了解味多美</a></li>
                <li><a href="othLink.php?id=22">味多美新闻</a></li>
                <li><a href="othLink.php?id=23">加入味多美</a></li>
            </ul>
            <ul class="list-unstyled pull-left">
                <li><a href="">关注我们</a></li>
                <li><a href="http://weibo.com/wedomecake">官方微博</a></li>
                <li><a href="http://club.wdmcake.cn/">美粉社区</a></li>
            </ul>
            </div>
            <?php
            include '../api/articleApi.php';
            //print_r($res);
            ?>
<!-- 帮助中心-购物帮助 -->

            <div class="article pull-right">
               <?php if(isset($_GET['id'])&&( $_GET['id']<24||$_GET['id']>31)) { ?>
                <img src="./image/othLink.jpg">
                <?php } ?>
                <h2 class="title"><?php echo $res['art_name']?></h2>
                <article>
                    <?php echo htmlspecialchars_decode($res['art_content'])?>
                    <?php
                    if(isset($_GET['id'])&& $_GET['id']==23) { ?>
                        <ul class="list-inline">
                            <li><a href="othLink.php?id=24"><img src="images/othLink/weihu.png" alt=""><span>系统维护专员</span></a></li>
                            <li><a href="othLink.php?id=25"><img src="images/othLink/yingxiao.png" alt=""><span>营业员</span></a></li>
                            <li><a href="othLink.php?id=26"><img src="images/othLink/mianbao.png" alt=""><span>面包学徒</span></a></li>
                            <li><a href="othLink.php?id=27"><img src="images/othLink/baojie.png" alt=""><span>保洁</span></a></li>
                            <li><a href="othLink.php?id=28"><img src="images/othLink/biaohua.png" alt=""><span>裱花学徒</span></a></li>
                            <li><a href="othLink.php?id=29"><img src="images/othLink/kaifa.png" alt=""><span>开发专员</span></a></li>
                            <li><a href="othLink.php?id=30"><img src="images/othLink/sheji.png" alt=""><span>设计经理</span></a></li>
                            <li><a href="othLink.php?id=31"><img src="images/othLink/yunxing.png" alt=""><span>运营主管（O2O配送方向）</span></a></li>
                        </ul>
                    <?php } ?>
                </article>
            </div>
        </div>
    </div>
    </div>
    <?php include './footer.php'; ?>
</body>


</html>