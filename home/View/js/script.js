$(function () {
    $("#link .lanmu").click(function () {
        console.log(11);
        if ($(this).next().attr("data-open")==0) {
            $(this).next().slideDown().attr("data-open", 1);
        }else {
            $(this).next().slideUp().attr("data-open", 0);
        }
    })
})