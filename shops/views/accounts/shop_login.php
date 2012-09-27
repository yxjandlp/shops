<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/login.css');?>
<div class="shopLoginForm">
    <?php $form=$this->beginWidget('CActiveForm');?>
    <p><?php echo $form->errorSummary($model);?></p>
    <?php echo $form->label($model,'店铺编号:');?>
    <p><?php echo $form->textField($model,'id',array('class'=>'txt_input'));?></p>
    <p><?php echo $form->label($model,'管理密码:');?></p>
    <p><?php echo $form->passwordField($model,'admin_pwd',array('class'=>'txt_input'));?></p>
    </p>
    <?php echo CHtml::submitButton('登录',array('class'=>'blue_btn', 'id' => 'login'));?>
    <?php $this->endWidget();?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#login').click(function(){
            if ($('#ShopForm_id').val().trim() == '') {
                $('#ShopForm_id').jAlert('请输入店辅编号',"fatal", 'errboxid');
                return false;
            }
            if ($('#ShopForm_admin_pwd').val().trim() == '') {
                $('#ShopForm_admin_pwd').jAlert('请输入管理密码',"fatal", 'errboxid');
                return false;
            }
        });
    });
</script>