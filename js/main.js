function trim(stringToTrim) {
    return stringToTrim.replace(/^\s+|\s+$/g,"");
}
var Search = function(evt){
    evt = window.event || evt;
    if(evt.keyCode!=13){//回车键
        if(trim($('#search').val()) != ''){
            $('#search_form').submit();
        }
    }
}
$(document).ready(function(){
    $('#search').focus(function(){
        $(this).animate({'width':200}, 300);
    });
    $('#search').blur(function(){
        $(this).animate({'width':150}, 300);
    });
    $('.account_li').hover(
        function(){
            $('.drop_list_menu').show();
        },
        function(){
            $('.drop_list_menu').hide();
        }
    );
});