/**
 * 判断密码强度
 */
function getPasswordStrength(password){
    return 0
        // if password bigger than 5 give 1 point
        + +( password.length > 5 )
        // if password has both lower and uppercase characters give 1 point
        + +( /[a-z]/.test(password) && /[A-Z]/.test(password) )
        // if password has at least one number and at least 1 other character give 1 point
        + +( /\d/.test(password) && /\D/.test(password) )
        // if password has a combination of other characters and special characters give 1 point
        + +( /[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/.test(password) && /\w/.test(password) )
        // if password bigger than 12 give another 1 point (thanks reddit)
        + +( password.length > 12 )
}
$(document).ready(function(){
    /**
     * 即时判断密码强度
     */
    $('#UserForm_password').bind( 'keyup' , function(){
        $('#UserForm_password_em_').css('display','block');
        var pass = $(this).val(),
            strength = getPasswordStrength(pass),
            text = new Array('弱', '中', '强', '极强'),
            show_text;

        if ( pass.length > 0 ) {
            if ( strength == 0) {
                show_text = text[0];
            }else if( strength == 1 ){
                show_text = text[1];
            } else if ( 2 <= strength && strength <= 4 ) {
                show_text = text[2];
            }
            else if ( strength == 5 ) {
                show_text = text[3];
            }
            $('#password_error_msg').text("密码强度:" + show_text);
        }
    });

    /**
     * 检查输入密码
     */
    $('#UserForm_password').blur(function(){
        var pwd = $(this).val();
        var p_length = pwd.length;
        var password_error_msg = $('#password_error_msg');
        if ( p_length == 0 ) {
            password_error_msg.text('密码不能为空');
        } else {
            if( p_length < 6 ){
                password_error_msg.text('密码长度不能小于6位');
            }
        }
    });


});