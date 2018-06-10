<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>企业服务_味美多蛋糕官网</title>
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
<body class="service">
<?php include './header.php' ?>
<main>
    <div class="main">
        <div class="container">
        <div class="location">当前位置:首页</div>
        <div class="serContent">
            <ul class="list-unstyled pull-left">
                <li><a href="">了解味美多</a></li>
                <li><a href="service.php?id=1">联系味美多</a></li>
                <li><a href="service.php?id=3">企业服务</a></li>
                <li><a href="service.php?id=4">味美多简介</a></li>
                <li><a href="service.php?id=5">味美多工业园</a></li>
                <li><a href="service.php?id=6">味美多文化</a></li>
                <li><a href="service.php?id=7">关于原料</a></li>
                <li><a href="service.php?id=8">味美多未来</a></li>
            </ul>
            <?php
            include '../api/articleApi.php';
            //print_r($res);
            ?>
            <div class="article pull-left">
                <h2 class="title"><?php echo $res['art_name']?></h2>
                <article>
                    <?php echo htmlspecialchars_decode($res['art_content'])?>
                    <?php if ($res['id']==3) {?>
                    <form action="../api/companyServiceApi.php" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="companyName" class="col-sm-2 control-label">公司名称:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="companyName" name="companyName" onblur="notNull(this)">
                            </div>
                            <span class="companyName">请输入正确的公司全称</span>
                        </div>
                        <div class="form-group">
                            <label for="companySrc" class="col-sm-2 control-label">公司地址:</label>
                            <div class="col-sm-2" style="padding-right: 0;">
                                <select class="form-control" name="companySrc1" id="companySrc1">
                                    <option value="">请选择</option>
                                    <option value="1">北京</option>
                                </select>
                            </div>
                            <div class="col-sm-2" style="padding: 0;">
                                <select class="form-control col-sm-2" name="companySrc2" id="companySrc2">
                                    <option value="">请选择</option>
                                </select>
                            </div>
                            <div class="col-sm-2" style="padding: 0;">
                                <select class="form-control col-sm-2" name="companySrc3" id="companySrc3">
                                    <option value="">请选择</option>
                                </select>
                            </div>
                            <div class="col-sm-2" style="padding: 0;" >
                                <select class="form-control col-sm-2" name="companySrc4" id="companySrc4">
                                    <option value="">请选择</option>
                                </select>
                            </div>
                            <span class="companySrc">公司地址不能为空</span>
                        </div>
                        <div class="form-group">
                            <label for="detailSrc" class="col-sm-2 control-label">详细地址:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="detailSrc" name="detailSrc" onblur="notNull(this)">
                            </div>
                            <span class="detailSrc">请输入详细的公司地址</span>
                        </div>
                        <div class="form-group">
                            <label for="peopleNum" class="col-sm-2 control-label">公司人数:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="peopleNum" name="peopleNum" onblur="onlyNum(this)">
                            </div>
                            <span class="peopleNum">公司人数不能为空</span>
                        </div>
                        <div class="form-group">
                            <label for="peopleName" class="col-sm-2 control-label">联系人姓名:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="peopleName" name="peopleName" onblur="notNull(this)">
                            </div>
                            <span class="peopleName"> 联系人姓名不能为空</span>
                        </div>
                        <div class="form-group">
                            <label for="peoplePhone" class="col-sm-2 control-label">联系人手机:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="peoplePhone" name="peoplePhone" onblur="corretPhone(this)">
                            </div>
                            <span class="peoplePhone"> 请输入正确的联系人手机号</span>
                        </div>
                        <div class="form-group">
                            <label for="companyPhone" class="col-sm-2 control-label">公司办公电话:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="companyPhone" name="companyPhone" >
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="callContent" class="col-sm-2 control-label">业务咨询内容:</label>
                            <div class="col-sm-4">
                                <textarea  class="form-control" id="callContent" name="callContent"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default" style="color:#fff;background-color: #c2002d">提 交</button>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                </article>
            </div>
        </div>
    </div>
    </div>
    <?php include './footer.php'?>
</body>
<script>
    function notNull(e) {
        //console.log($(e).val().length);
        var length = $(e).val().length;
        if (length>0) {
            //if ($(e).className())
            console.log(e.id);
            if (e.id == 'companyName') {
                $('.companyName').html('ok').css("color", 'green');
            }
            if (e.id == 'detailSrc') {
                $('.detailSrc').html('ok').css("color", 'green');
            }
            if (e.id == 'peopleName') {
                $('.peopleName').html('ok').css("color", 'green');
            }
        } else {
            console.log(e.id);
            if (e.id == 'companyName') {
                $('.companyName').html('公司名称不能为空').css("color",'red');
            }
            if (e.id == 'detailSrc') {
                $('.detailSrc').html('详细地址不能为空').css("color",'red');
            }
            if (e.id == 'peopleName') {
                $('.peopleName').html('联系人姓名不能为空').css("color",'red');
            }
        }
    }
    function onlyNum(e) {
        var rex = new RegExp(/^[0-9]+$/);
        var str = $(e).val();
       // console.log(rex.test(str));
       // console.log(str);
        var bol = rex.test(str);
        if (bol) {
            $('.peopleNum').html('ok').css('color','green');
        } else {
            $('.peopleNum').html('公司人数至少为一个数字').css('color','red');
        }
    }
    function corretPhone(e) {
        var rex = new RegExp(/^1[34578]\d{9}$/);
        var str = $(e).val();
        var bol = rex.test(str);
        if (bol) {
            $('.peoplePhone').html('ok').css('color','green');
        } else {
            $('.peoplePhone').html('联系人电话格式不正确').css('color','red');
        }
    }
    $("#companySrc1").change(function () {
        var v = $(this).val();
        $.get('../api/getAddressApi.php',{id: v}, function (data) {
            if (data==[]) {
               alert('kkk');
            } else {
                $("#companySrc3").html('<option value="">请选择</option>');
                $("#companySrc4").html('<option value="">请选择</option>');
                var str = '<option value="">请选择</option>'
                for (var i=0;i<data.length;i++) {
                    str+= '<option value="'+data[i].id+'">'+data[i].address_side+'</option>';
                }
                $("#companySrc2").html(str);
            }
        },'json')
    });
    $("#companySrc2").change(function () {
        var v = $(this).val();
        $.get('../api/getAddressApi.php',{id: v}, function (data) {
            var str = '<option value="">请选择</option>'
            for (var i=0;i<data.length;i++) {
                str+= '<option value="'+data[i].id+'">'+data[i].address_side+'</option>';
            }
            if (data==[]) {
                $("#companySrc3").html('<option value="">请选择</option>');
            } else {
                $("#companySrc4").html('<option value="">请选择</option>');
                $("#companySrc3").html(str);
            }
        },'json')
    })
    $("#companySrc3").change(function () {
        var v = $(this).val();
        $.get('../api/getAddressApi.php',{id: v}, function (data) {
            var str = '<option value="">请选择</option>'
            for (var i=0;i<data.length;i++) {
                str+= '<option value="'+data[i].id+'">'+data[i].address_side+'</option>';
            }
            if (data==[]) {
                $("#companySrc4").html('<option value="">请选择</option>');
            } else {
                $("#companySrc4").html(str);
            }
        },'json')
    })


</script>
</html>