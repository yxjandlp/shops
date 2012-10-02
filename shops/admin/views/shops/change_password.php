<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/login.css');?>
<div class="content_block">
    <?php $form=$this->beginWidget('CActiveForm');?>
    <input type="hidden" name="shop_id" value="<?php echo $shop_id;?>" />
    <p><?php echo $form->errorSummary($model);?></p>
    <p><?php echo $form->label($model,'新密码:');?></p>
    <p><?php echo $form->passwordField($model,'newPassword',array('class'=>'txt_input'));?></p>
    <p><?php echo $form->label($model,'确认新密码:');?></p>
    <p><?php echo $form->passwordField($model,'confirmNewPassword',array('class'=>'txt_input'));?></p>
    <?php echo CHtml::submitButton('确定',array('class'=>'blue_btn', 'id' => 'login'));?>
    <?php $this->endWidget();?>
</div>
<div class="clear"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#login').click(function(){
            if ($('#PasswordChangeForm_newPassword').val().trim() == '') {
                $('#PasswordChangeForm_newPassword').jAlert('请输入新密码',"fatal", 'errboxid');
                return false;
            }
            if ($('#PasswordChangeForm_confirmNewPassword').val().trim() == '') {
                $('#PasswordChangeForm_confirmNewPassword').jAlert('请确认新密码',"fatal", 'errboxid');
                return false;
            }
        });
    });
</script>