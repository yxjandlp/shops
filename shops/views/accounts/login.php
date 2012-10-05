<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/login.css');?>
<br />
<div class="loginForm">
    <?php $form=$this->beginWidget('CActiveForm');?>
    <p><?php echo $form->errorSummary($model);?></p>
    <?php echo $form->label($model,'用户名:');?>
    <p><?php echo $form->textField($model,'username',array('class'=>'txt_input'));?></p>
    <p><?php echo $form->label($model,'密码:');?></p>
    <p><?php echo $form->passwordField($model,'password',array('class'=>'txt_input'));?></p>
    <p>
        <?php echo $form->checkBox($model,'rememberMe');?>
        <?php echo $form->label($model,'两周内自动登录');?>
    </p>
    <?php echo CHtml::submitButton('登录',array('class'=>'blue_btn', 'id' => 'login'));?>
    <?php $this->endWidget();?>
</div>
<div id="goto_shop_login">
    <?php echo CHtml::link('&gt;&gt;商家登录入口', array('shopLogin'))?>
</div>
<div class="clear"></div>
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