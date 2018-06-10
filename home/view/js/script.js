$(function () {
    $(".dropdown").mouseover(function () {
        $(this).addClass("open");
    }).mouseleave(function () {
        $(this).removeClass("open");
    })
})