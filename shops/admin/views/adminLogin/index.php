<div class="admin_login">
    <h1>后台登录</h1>
    <?php $form=$this->beginWidget('CActiveForm');?>
        <table border="0">
        <?php echo $form->errorSummary($model);?>
        <tr>
            <td style="text-align: right"><?php echo $form->label($model,'帐 号');?>:</td>
            <td><?php echo $form->textField($model,'username',array('class'=>'txt_input'));?></td>
        <tr>
            <td style="text-align: right"><?php echo $form->label($model,'密 码');?>:</td>
            <td><?php echo $form->passwordField($model,'password',array('class'=>'txt_input'));?></td>
         </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo CHtml::submitButton('登录',array('id' => 'loginBtn'));?></td>
        </tr>
        </table>
    <?php $this->endWidget();?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#login').click(function(){
            if ($('#UserForm_username').val().trim() == '') {
                $('#UserForm_username').jAlert('请输入用户名',"fatal", 'errboxid');
                return false;
            }
            if ($('#UserForm_password').val().trim() == '') {
                $('#UserForm_password').jAlert('请输入密码',"fatal", 'errboxid');
                return false;
            }
        });
    });
</script>