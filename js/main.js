$(document).ready(function(){
    $('#search').focus(function(){
        $(this).animate({'width':200}, 300);
    });
    $('#search').blur(function(){
        $(this).animate({'width':150}, 300);
    });
});