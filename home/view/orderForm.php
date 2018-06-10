<?php
session_start();
header("content-type:text/html;charset=utf-8;");
if (!isset($_SESSION['userId'])) {
    echo "<script>alert('请先登录!');window.location.href='../view/login_register_cake.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>订单确认_味美多蛋糕官网</title>
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
<body class="order">
<?php include '../api/getGoodMessageApi.php';?>
<?php include './header.php' ?>
<main>
    <form class="form-inline" action="../api/orderFormApi.php?" method="post">
        <?php
        if (!$goodMsg=='') {
        foreach ($goodMsg as $key => $val) {?>
        <input type="hidden" name="goodsid[<?php echo $key;?>]" value="<?php echo $val['goodid'] ?>">
        <?php }}?>
    <section class="addressMsg" data-id="<?php echo $_SESSION['uid']?>" data-address=" <?php if (isset($rows)&&!empty($rows)) {echo 1;}else {echo 0;}?>">
        <div class="container">
        <h2 class="title">收货信息</h2>
        <div class="msgBox">
            <?php if (isset($rows)&&!empty($rows)) {
                //print_r($rows);
              foreach ( $rows as $row) {
                  if ($row['is_alway']==0) {
                      echo "<div class='msgAddress'><label><input type='radio' class='inputAddress' name='address' value='" . $row['id'] . "'/>" . $row['address'] .' '.$row['address_detail']. "  " . $row['get_person'] . " " . $row['get_call'] . "</label><span class='updateMsg' onclick='editMsg(this)'>编辑</span><span class='deleteMsg' onclick='delMsg(this)'>删除</span></div>";
                  } else  {
                      echo "<div class='msgAddress'><label><input type='radio' class='inputAddress' name='address' value='" . $row['id'] . "' checked/>" . $row['address'].' '.$row['address_detail']. "  " . $row['get_person'] . " " . $row['get_call'] . "</label><span class='updateMsg' onclick='editMsg(this)'>编辑</span><span class='deleteMsg' onclick='delMsg(this)'>删除</span></div>";
                  }
              } }?>

            <div>
            <label for=""><input type="radio" id="newSrc" data-address="" value="0" class="hid">新增收货地址</label>
            </div>
            <div class="msgDetail" style="display: <?php  if (isset($rows)&&!empty($rows)) {echo 'none';} else { echo 'block';}?>" data-right="1" data-do="0">
                <div class="form-group">
                    <label for="address">配送地址:</label>
                    <select class="form-control" name="companySrc1" id="companySrc1">
                        <option value="">请选择</option>
                        <option value="1">北京</option>
                    </select>
                    <select class="form-control" name="companySrc2" id="companySrc2">
                        <option value="">请选择</option>
                    </select>
                    <select class="form-control" name="companySrc3" id="companySrc3">
                        <option value="">请选择</option>
                    </select>
                    <select class="form-control" name="companySrc4" id="companySrc4">
                        <option value="">请选择</option>
                    </select>
                    <span id="addInfo" style="display: none;line-height: 1.4;">请选择完整的地区</span>
                    <input type="text" name="companySrcDetail" id="companySrcDetail">
                </div>
                <div class="form-group">
                    <label for="getPeople">收货人:</label>
                    <input type="text" class="form-control" id="getPeople" name="getPeople" onblur="notNull(this)">
                    <span>必填</span>
                    <button id="getToOrder" type="button">若收货人也是订货人，请点击</button>
                </div>
                <div class="form-group">
                    <label for="orderPeople">订货人:</label>
                    <input type="text" class="form-control" id="orderPeople" name="orderPeople" onblur="notNull(this)">
                    <span>必填</span>
                </div>
                <div class="form-group">
                    <label for="getPhone">手机:</label>
                    <input type="text" class="form-control" id="getPhone" name="getPhone" onblur="corretPhone(this)">
                    <span>必填</span>
                </div>
                <div class="form-group">
                    <label for="orderPhone">订货人手机:</label>
                    <input type="text" class="form-control" id="orderPhone" name="orderPhone" onblur="corretPhone(this)">
                    <span>必填</span>
                </div>
                <div class="form-group">
                    <label for="orderPhone"></label>
                    <input type="checkbox" class="form-control" id="isAlway" name="isAlway">
                    <span id="setAlway">设为常用地址</span>
                </div>
                <div >
                <button type="button" class="btn btn-default upGetMsg">点击保存收货人信息，进入下一步</button>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="goStyle">
        <div class="container">
            <h2 class="title">配送方式</h2>
            <div class="msgBox">
                <!--请先完善配送地址-->
                <div <!--style="display:--><?php /*if(!isset($rows)||empty($rows)){echo 'none';}*/?>">
                <label><input type="radio" name="kuaidi" value="0" checked>味美多快递</label>
                </div>
            <div><label><input type="radio"  name="kuaidi" value="1">顺丰</label></div>
            <div class="goTime"><label for="" >送达时间:<input type="date" name="date"/><input type="time" name="time"></label></div>

            </div>
        </div>
    </section>
    <section class="payStyle">
        <div class="container">
            <h2 class="title">支付方式</h2>
            <div class="msgBox">
                <label for=""><input type="radio" id="payStyle" name="payStyle" value="0" checked>在线支付</label>
                <div class="allPay">
                    <ul class="list-inline">
                    <li class="clearfix"><label for=""><input type="radio" name="intStyle" value="微信支付" checked><img src="images/orderform/weixin.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/zhifubao.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/zhongguoyinhang.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/gongshang.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/zhaoshang.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/jianshe.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/nongye.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/pufa.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/xingye.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/guangfa.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/shanghai.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/pingan.jpg" alt=""></label></li>
                        <li><label for=""><input type="radio" name="intStyle"><img src="images/orderform/youzheng.jpg" alt=""></label></li>
                    </ul>
                </div>
                <label for=""><input type="radio"  name="payStyle" value="货到付款">货到付款</label>
            </div>
        </div>
    </section>
    <section class="billStyle">
        <div class="container">
            <h2 class="title">发票信息</h2>
            <div class="msgBox">
                <label for=""><input type="radio" name="invoice" value="0" checked>&nbsp;不需要发票&nbsp;</label><label for=""><input type="radio" name="invoice" value="1">&nbsp;个人发票&nbsp;</label><label for=""><input type="radio" name="invoice" value="2" >&nbsp;公司发票&nbsp;</label>
            </div>
        </div>
    </section>
    <section class="goodForm">
        <div class="container">
            <h2 class="title">货物清单</h2>
            <div class="msgBox">
                <!--请先完善配送地址-->
                <div class="goodBox">
                    <?php if (!$goodMsg=='') {
                        //print_r($goodMsg);
                        ?>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <th width="143px">商品图片</th>
                            <th width="164px">商品名称</th>
                            <th width="96px">规格</th>
                            <th width="104px">单价（元）</th>
                            <th width="138px">数量</th>
                            <th width="206px">祝福对象</th>
                            <th width="206px">祝福语</th>
                            <th width="113px">小计</th>
                        </tr>
                        <?php foreach ($goodMsg as $msg) { ?>
                            <tr data-id="<?php echo $msg['id']?>">
                        <td><?php echo $msg['img'];?></td>
                        <td><?php echo $msg['goodname'];?></td>
                        <td><?php echo $msg['pcs'];?></td>
                        <td><?php echo $msg['price'];?></td>
                        <td><?php echo $msg['num'];?></td>
                        <td><div class="dropdown">
                                <input class="dropdown-toggle wishPersonPut" type="text" name="wishPerson" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" value="<?php echo $msg['wish_person']?>"/>
                                <ul class="dropdown-menu wishPerson" aria-labelledby="dropdownMenu1">
                                    <li><a href="javascript:0;">爸爸</a></li>
                                    <li><a href="javascript:0;">妈妈</a></li>
                                    <li><a href="javascript:0;">孩子</a></li>
                                    <li><a href="javascript:0;">爱人</a></li>
                                    <li><a href="javascript:0;">朋友</a></li>
                                    <li><a href="javascript:0;">领导</a></li>
                                    <li><a href="javascript:0;">长辈</a></li>
                                    <li><a href="javascript:0;">亲属</a></li>
                                    <li><a href="javascript:0;">其他人</a></li>
                                </ul>
                            </div></td>
                        <td><div class="dropdown">
                                <input class="dropdown-toggle goodWishPut" type="text" name="goodWish" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" value="<?php echo $msg['good_wish']?>"/>
                                <ul class="dropdown-menu goodWish" aria-labelledby="dropdownMenu1">
                                    <li><a href="javascript:0;">生日快乐</a></li>
                                    <li><a href="javascript:0;">Happy Birthday</a></li>
                                    <li><a href="javascript:0;">圣诞快乐</a></li>
                                    <li><a href="javascript:0;">Merry Christmas</a></li>
                                    <li><a href="javascript:0;">元旦快乐</a></li>
                                    <li><a href="javascript:0;">新年快乐</a></li>
                                    <li><a href="javascript:0;">Happy new year</a></li>
                                    <li><a href="javascript:0;">情人节快乐</a></li>
                                    <li><a href="javascript:0;">新婚快乐</a></li>
                                    <li><a href="javascript:0;">健康长寿</a></li>
                                    <li><a href="javascript:0;">福如东海 寿比南山</a></li>
                                    <li><a href="javascript:0;">I LOVE YOU</a></li>
                                </ul>
                            </div></td>
                        <td class="money"><?php echo '￥'.$msg['price']*$msg['num'].'.00'?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <?php }?>
                </div>
            </div>
        </div>
    </section>
    <section class="beizu">
        <div class="container">
            <label for="">订单备注:</label>
            <textarea name="otherMsg" id="" cols="30" rows="10"></textarea>
        </div>
    </section>
    <div class="orderPrice">
        <div class="container">
            <div class="priceBox">
        <span>商品总价: <i>￥<?php echo $_GET['all'];?></i></span>
        <span>应付款金额:    <i>￥<?php echo $_GET['all'];?></i></span>
            </div>
            <input type="hidden" name="all" value="<?php echo  $_GET['all'];?>">
        </div>
    </div>
        <div class="container">
    <button type="submit" class="submit pull-right">提交表单</button>
        </div>
    </form>


    <?php include './footer.php'?>
</body>
<script>
    function notNull(e) {
        //console.log($(e).val().length);
        $(".msgDetail").attr("data-do",'1');
        var length = $(e).val().length;
        if (length>0) {
            console.log(length);
            $(e).next().css('background','none')
            $(e).css('border','1px solid #ccc');
            $(".msgDetail").attr("data-right",'1');
           // $(e).css('border','1px dotted #ccc');
        } else {
            $(e).next().css('background','url(images/orderform/false.gif) no-repeat')
            $(e).css('border','1px dotted #cf0f25');
            $(".msgDetail").attr("data-right",'0');
        }
    }
    function corretPhone(e) {
        var rex = new RegExp(/^1[34578]\d{9}$/);
        var str = $(e).val();
        $(".msgDetail").attr("data-do",'1');
        if (str.length>0) {
            var bol = rex.test(str);
            if (bol) {
                $(e).next().css('background','none').html('必填');
                $(e).css('border','1px solid #ccc');
                $(".msgDetail").attr("data-right",'1');
            } else {
                $(e).next().css('background','url(images/orderform/false.gif) no-repeat').html('格式错误');
                $(e).css('border','1px dotted #cf0f25');
                $(".msgDetail").attr("data-right",'0');
            }
        }else {
            $(e).next().css('background','url(images/orderform/false.gif) no-repeat').html('请填写手机号码');
            $(e).css('border','1px dotted #cf0f25');
            $(".msgDetail").attr("data-right",'0');
        }
    }
    $("select").change(function () {
        $(".msgDetail").attr("data-do",'1');
        var v = $("#companySrc4").val();
        if (v==''){
            $("#addInfo").css("display",'inline-block').css('background','url(images/orderform/false.gif) no-repeat');
            $(".msgDetail").attr("data-right",'0');
        }else {
            $("#addInfo").css("display",'none')
            $(".msgDetail").attr("data-right",'1');
        }
    })
    $("#companySrcDetail").blur(function () {
        $(".msgDetail").attr("data-do",'1');
        var d = $(this).val();
        if (d=='') {
            $(this).css('border','1px dotted #cf0f25');
            $(".msgDetail").attr("data-right",'0');
        }else {
            $(this).css('border','1px solid #ccc');
            $(".msgDetail").attr("data-right",'1');
        }
    })
    function changeSrc1() {
        var v = $("#companySrc1").val();
        console.log(v);
        $.get('../api/getAddressApi.php',{id: v}, function (data) {
            if (data==[]) {
                //alert('kkk');
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
    };
    $("#companySrc1").change(changeSrc1);
    function changeSrc2() {
        var v = $("#companySrc2").val();
        console.log(v);
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
    }
    $("#companySrc2").change(changeSrc2);
    function changeSrc3() {
        var v = $("#companySrc3").val();
        console.log(v);
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
    }
    $("#companySrc3").change(changeSrc3);
    //保存收货人信息
    $(".upGetMsg").click(function () {
        var id = $("#newSrc").val();
        var uid = $('.addressMsg').attr('data-id');
        var src1 = $("#companySrc1").val(); var src2 = $("#companySrc2").val(); var src3 = $("#companySrc3").val(); var src4 = $("#companySrc4").val();
        var srcD = $("#companySrcDetail").val();
        var getPer = $("#getPeople").val();var getPhone = $("#getPhone").val();
        var orderPer = $("#orderPeople").val(); var orderPhone = $("#orderPhone").val();
        if ($("#isAlway").is(':checked')) { //checkBox的选中判断
            var isAlway = 1;
        }else {
            var isAlway = 0;
        }
        if (src4=='') {
            $("#addInfo").css("display",'inline-block').css('background','url(images/orderform/false.gif) no-repeat');
            $(".msgDetail").attr("data-right",'0');
        }
        if (srcD=='') {
            $(this).css('border','1px dotted #cf0f25');
            $(".msgDetail").attr("data-right",'0');
        }
        if (getPer=='') {
            e = $("#getPeople");
            $(e).next().css('background','url(images/orderform/false.gif) no-repeat')
            $(e).css('border','1px dotted #cf0f25');
            $(".msgDetail").attr("data-right",'0');
        }
        if (orderPer=='') {
            e = $("#orderPeople");
            $(e).next().css('background','url(images/orderform/false.gif) no-repeat')
            $(e).css('border','1px dotted #cf0f25');
            $(".msgDetail").attr("data-right",'0');
        }
        e = $("#getPhone");
       // corretPhone(e);
        var rex = new RegExp(/^1[34578]\d{9}$/);
        var str = $(e).val();
        if (str.length>0) {
            var bol = rex.test(str);
            if (bol) {

            } else {
                $(e).next().css('background','url(images/orderform/false.gif) no-repeat').html('格式错误');
                $(e).css('border','1px dotted #cf0f25');
                $(".msgDetail").attr("data-right",'0');
            }
        }else {
            $(e).next().css('background','url(images/orderform/false.gif) no-repeat').html('请填写手机号码');
            $(e).css('border','1px dotted #cf0f25');
            $(".msgDetail").attr("data-right",'0');
        }
        e = $("#orderPhone");
        var str = $(e).val();
        if (str.length>0) {
            var bol = rex.test(str);
            if (bol) {

            } else {
                $(e).next().css('background','url(images/orderform/false.gif) no-repeat').html('格式错误');
                $(e).css('border','1px dotted #cf0f25');
                $(".msgDetail").attr("data-right",'0');
            }
        }else {
            $(e).next().css('background','url(images/orderform/false.gif) no-repeat').html('请填写手机号码');
            $(e).css('border','1px dotted #cf0f25');
            $(".msgDetail").attr("data-right",'0');
        }

        //console.log(isAlway);
       var right = $(".msgDetail").attr("data-right"); //right为1时，代表表单通过，默认为1，有错修改为0
        var doing = $(".msgDetail").attr("data-do");  //doing为0时，代表没动收货人表单，即表单为全空，默认为0;动了改为1，保存后改回0；
        if (right==1&&doing!=0) {
        $.get('../api/getGoodMessageApi.php',
            { act:'upGetMsg',id:id, uid:uid,src1:src1,src2:src2,src3:src3,src4:src4,srcD:srcD,getPer:getPer,orderPer:orderPer,getPhone:getPhone,orderPhone:orderPhone,isAlway:isAlway},
        function (data) {
            console.log(data);
            var str='';
            //console.log(data);
            if(data) {
                $(".addressMsg .msgBox .msgAddress").remove();
                for (var i = 0; i < data.length; i++) {
                    // console.log(data[i].address);
                    var add = data[i].address.split(",");
                    var address = '';
                    for (var j = 0; j < add.length; j++) {
                        address += add[j];
                    }
                    if (data[i].is_alway == 0) {
                        str = "<label><input type='radio' name='address'  value='" + data[i].id + "'/>" + data[i].address_zh + "  "+data[i].address_detail + "  "+data[i].get_person + "  " + data[i].get_call + "</label><span class='updateMsg' onclick='editMsg(this)'>编辑</span><span class='deleteMsg' onclick='delMsg(this)'>删除</span>";
                    } else {
                        str = "<label><input type='radio' name='address'  value='" + data[i].id + "' checked/>" + data[i].address_zh + "  "+data[i].address_detail +"  "+ data[i].get_person + "  " + data[i].get_call + "</label><span class='updateMsg' onclick='editMsg(this)'>编辑</span><span class='deleteMsg' onclick='delMsg(this)'>删除</span>";
                    }
                    $(".addressMsg .msgBox").prepend("<div class='msgAddress'>" + str + "</div>");
                    console.log(str);
                }
                $(".msgDetail").css("display", 'none');
                $(".msgDetail").attr("data-do", 0);
            }
        },'json')
        } else {
            console.log('表单不通过！');
        }
    })
    $('input[type=radio][name=address]').change(function() {
        //alert($(this).val());
    });
    $('input[type=radio][name=payStyle]').change(function() {
       // console.log($(this).val());
        if ($(this).val()=='货到付款') {
            $('input[type=radio][name=intStyle]').prop("checked",false);
        }
    });
    $('input[type=radio][name=intStyle]').change(function () {
        $("#payStyle").prop("checked",true);
    })

    //新增收货地址
    $("#newSrc").click(function (e) {
       // console.log(11);
        $(".msgDetail").css("display", 'block');
            $("#newSrc").val(0);
            /* var src1 = $("#companySrc1").val(); var src2 = $("#companySrc2").val(); var src3 = $("#companySrc3").val(); var src4 = $("#companySrc4").val();*/
            /*var srcD = */
            $("#companySrc1").val('');
            $("#companySrc2").val('');
            $("#companySrc3").val('');
            $("#companySrc4").val('');
            $("#companySrcDetail").val('');
            /* var getPer = */
            $("#getPeople").val('');
            /*var getPhone = */
            $("#getPhone").val('');
            /*var orderPer =*/
            $("#orderPeople").val('');
            /*var orderPhone = */
            $("#orderPhone").val('');
    })
    //编辑地址
    function editMsg(mid) {
        $(".msgDetail").attr("data-do",1);
        $(".msgDetail").css("display",'block');
        var id = $(mid).parent().children().children().val();
        $(".form-group span").not("#setAlway").not("#addInfo").text("必填").css("background",'none')
        $(".form-group").eq(0).children("span").css("display","none");
        $(".form-group input").css("border","1px dotted #ccc");
        // $("#newSrc").val(id);
        $.get('../api/getGoodMessageApi.php',{act:'editGetMsg', id:id},function (data) {
           // console.log(data);
                var src = data.src;
                for (var j=0; j<src.length;j++) {
                    var srcObj = src[j];
                    var str = '<option value="">请选择</option>';
                    for (var k=0; k<srcObj.length;k++) {
                        str += '<option value="'+srcObj[k].id+'">' + srcObj[k].address_side + '</option>';
                    }
                    if (j==0) {
                        $("#companySrc2").html(str);
                    }else if (j==1) {
                        $("#companySrc3").html(str);
                    }else if (j==2) {
                        $("#companySrc4").html(str);
                    }else {
                        console.log('不是012');
                    }
                }
           /* var str = '<option value="">请选择</option>';
            var arr = ['东城区','西城','北城'];
            for (var i=0;i<arr.length;i++) {
                if (i==0) {
                    str += '<option value="3">' + arr[i] + '</option>';
                } else {
                    str += '<option value="'+i+'">' + arr[i] + '</option>';
                }
            }
            $("#companySrc3").html(str);*/

            var strs = new Array();
            strs = data.address.split(",");
            //  console.log(strs);
            for (var i = 0; i < strs.length; i++) {
                // console.log(strs[i]);
                $("#companySrc" + (i + 1)).val(strs[i]);
                // var str = "#companySrc"+(i+1)+"";
                //console.log( str);
                //console.log($("#companySrc"+(i+1)).val());
                /* if (i==0) {
                     changeSrcOne();
                 }else if (i==1) {
                     changeSrc2();
                 }*/
            }
            $("#newSrc").val(data.id);
            /* var uid =*/
            $('.addressMsg').attr('data-id', data.uid);
            /* var src1 = $("#companySrc1").val(); var src2 = $("#companySrc2").val(); var src3 = $("#companySrc3").val(); var src4 = $("#companySrc4").val();*/
            /*var srcD = */

            $("#companySrcDetail").val(data.address_detail);
            /* var getPer = */
            $("#getPeople").val(data.get_person);
            /*var getPhone = */
            $("#getPhone").val(data.get_call);
            /*var orderPer =*/
            $("#orderPeople").val(data.pay_person);
            /*var orderPhone = */
            $("#orderPhone").val(data.pay_call);
            /*if ($("#isAlway").is(':checked')) {
                var isAlway = 1;
            }else {
                var isAlway = 0;
            }*/
            if (data.is_alway == 1) {
                $("#isAlway").prop("checked", true);
            } else {
                $("#isAlway").prop("checked", false);
            }
        },'json' )
    }
    //删除地址
    function delMsg(mid) {
        var id = $(mid).parent().children().children().val();
        $.get('../api/getGoodMessageApi.php',{act:'delGetMsg', id:id},function (data) {
             if (data.code==200) {
                 $(mid).parent().remove();
             }
        },'json');
    }
    //$(".updateMsg").on('click',editMsg);
    //订货人也是收货人
    $("#getToOrder").click(function () {
        var name = $("#getPeople").val();
        var phone =$("#getPhone").val();
        $("#orderPeople").val(name);
        $("#orderPhone").val(phone);
        $(".msgDetail").attr("data-right",'1');

    })
    function upGoodWish() {
        var text = $(this).text();
        //console.log(text);
        $(this).parent().prev().val(text);
        var id = $(this).parent().parent().parent().parent().attr("data-id");
        $.get('../api/orderFormApi.php',{act:'goodwish',id:id,goodWish:text},function (data) {
            //alert(data.msg);
        },'json')
    }
    function upWishPerson() {
        var text = $(this).text();
        //console.log(text);
        $(this).parent().prev().val(text);
        var id = $(this).parent().parent().parent().parent().attr("data-id");
        $.get('../api/orderFormApi.php',{act:'wishPerson',id:id,wishPerson:text},function (data) {
            //alert(data.msg);
        },'json')
    }
    //货物清单祝福对象
    $(".wishPerson li").click(upWishPerson)
    //货物清单祝福语
    $(".goodWish li").click(upGoodWish)
    //祝福对象表单变化
    $(".dropdown-toggle.goodWishPut").change(function () {
       var goodWish = $(this).val();
        var id = $(this).parent().parent().parent().attr("data-id");
        //console.log(id);
        $.get('../api/orderFormApi.php',{act:'goodwish',id:id,goodWish:goodWish},function (data) {
            //alert(data.msg);
        },'json')
       // var timer = window.setTimeout(changeGoodWish(id,that),5000);

    })
    //祝福语表单变化
    $(".dropdown-toggle.wishPersonPut").change(function () {
        var goodWish = $(this).val();
        var id = $(this).parent().parent().parent().attr("data-id");
        //console.log(id);
        $.get('../api/orderFormApi.php',{act:'wishPerson',id:id,wishPerson:goodWish},function (data) {
            //alert(data.msg);
        },'json')
        // var timer = window.setTimeout(changeGoodWish(id,that),5000);

    })
</script>
</html>