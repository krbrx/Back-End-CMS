$(document).ready(function(){
    $(".con1").hide();
    $(".con2").hide();
    $(".btn1").click(function(){
        $(".con2").slideUp("slow");
        $(".con3").slideUp("slow");
        $(".con1").slideDown("slow");
    });
    $(".btn2").click(function(){
        $(".con1").slideUp("slow");
        $(".con3").slideUp("slow");
        $(".con2").slideDown("slow");
    });
    $(".btn3").click(function(){
        $(".con1").slideUp("slow");
        $(".con2").slideUp("slow");
        $(".con3").slideDown("slow");
    });
});