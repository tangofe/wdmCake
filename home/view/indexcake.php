<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>味美多蛋糕官网</title>
    <meta name="keyword" content="">
    <meta name="description" content="">
    <meta name="author" content="tango">
    <link rel="shortcut icon" href="./images/animated_favicon.gif"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/swiper-3.4.2.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
    .swiper-container {
    width: 100%;
    height: 100%;
    margin-left: auto;
    margin-right: auto;
    }
    .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;

    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
    }
    </style>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/swiper-3.4.2.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body class="index">
<?php include './header.php' ?>
    <main>
        <div class="container">
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><a href="./detail_cake.php?id=1"><img src="image/caroul1.jpg" alt=""></a></div>
                    <div class="swiper-slide"><a href="./detail_cake.php?id=2"><img src="image/caroul2.jpg" alt=""></a></div>
                    <div class="swiper-slide"><a href=""><img src="image/caroul3.jpg" alt=""></a></div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets" >
                </div>
            </div>
        </div>
        <div class="container">
        <div class="main">
            <ul class="list-inline clearfix">
                <li><a href="./detail_cake.php?id=3"><img src="image/cake1.jpg" alt=""><div class="mask"></div></a></li>
                <li><a href=""><img src="image/cake2.jpg" alt=""><div class="mask"></div></a></li>
                <li><a href="./detail_cake.php?id=2"><img src="image/cake3.jpg" alt=""><div class="mask"></div></a></li>
                <li><a href="./detail_cake.php?id=12"><img src="image/cake4.jpg" alt=""><div class="mask"></div></a></li>
            </ul>
        </div>
        </div>
         <?php include './footer.php'?>


</body>
<script>
   /* $('.swiper-container').mouseenter(function () {*/
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            slidesPerView: 1,
            paginationClickable: true,
            /* paginationBulletRender: function (swiper, index, className) {
                 return '<span class="' + className + '">' + (index + 1) + '</span>';
             },*/
            paginationBulletRender: function (swiper, index, className) {
                return '<span class="' + className + ' pagin">' + (index + 1) + '</span>';
                /*<span class="' + className + ' pagin">' + (index + 1) + '</span>*/
            },
            spaceBetween: 30,
            loop: true,
            autoplay: 3000,
        });
  /*  }).mouseleave(function () {
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            slidesPerView: 1,
            paginationClickable: true,
            /!* paginationBulletRender: function (swiper, index, className) {
                 return '<span class="' + className + '">' + (index + 1) + '</span>';
             },*!/
            paginationBulletRender: function (swiper, index, className) {
                return '<span class="' + className + ' pagin">' + (index + 1) + '</span>';
                /!*<span class="' + className + ' pagin">' + (index + 1) + '</span>*!/
            },
            spaceBetween: 30,
            loop: true
        });
    })*/
   $('.swiper-container').mouseenter(function () {
         $('.swiper-pagination').css({'transform': 'translate( -50%,85px)'});
              for (var i = 0; i < 3; i++) {
                  $('.swiper-pagination>span').eq(i).html('<img src="image/caroul' + (i + 1) + '.jpg" alt="">').removeClass('pagin');
              }
              $('.swiper-pagination').css({'background-color': 'hsla(0,0%,0%,.3)'}).css({'transform': 'translate( -50%,0)'});



   }).mouseleave(function () {
       $('.swiper-pagination').css({'transform': 'translate( -50%,85px)'});
           for( var i =0; i< 3; i++) {
               $('.swiper-pagination>span').eq(i).html(i+1).addClass('pagin');
           }
           $('.swiper-pagination').css({'background-color':'transparent'}).css({'transform': 'translate( -50%,0)'})

   })
   $('.swiper-pagination-bullet').mouseenter(function () {
       var the = $(this);
       the.click();
   })
/*    var swiper1 = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationBulletRender: function (swiper, index, className) {
            return '<span class="' + className + ' pagin">'+index+'</span>';
        },
    })*/
</script>

</html>