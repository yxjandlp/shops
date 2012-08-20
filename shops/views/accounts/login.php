<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/login.css');?>
<div class='block_title'>这里是登录界面</div>
<div class="form">
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
    <?php echo CHtml::submitButton('登录',array('class'=>'blue_btn'));?>
    <?php $this->endWidget();?>
</div>