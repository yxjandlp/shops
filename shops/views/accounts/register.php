<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/plugin/QapTcha/QapTcha.jquery.css');?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/register.css');?>
<?php Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/common/jquery.ui.touch.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/plugin/QapTcha/QapTcha.jquery.min.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/register.js');?>
<br />
<div class="regForm">
    <?php $form=$this->beginWidget('CActiveForm',array(
          'id'=>'registerForm',
          'enableClientValidation'=>true,
          'clientOptions' => array(
              'validateOnSubmit'=>true,
              'validateOnChange'=>true,
              'validateOnType'=>false,
    )));
    ?>
    <p><?php echo $form->label($model,'用户名:');?></p>
    <p>
        <?php echo $form->textField($model,'username',array('class'=>'txt_input'));?>
        <?php echo $form->error($model,'username',array('class'=>'register_error_msg'));?>
        <span class="hint">用户名为数字、字母、下划线_的组合，长度为6-20位</span>
    </p>
    <p><?php echo $form->label($model,'密码:');?></p>
    <p>
        <?php echo $form->passwordField($model,'password',array('class'=>'txt_input'));?>
        <?php echo $form->error($model,'password',array('class'=>'register_error_msg'));?>
        <span class="hint">密码为6个字符以上</span>
    </p>
    <p><div class="QapTcha"></div></p>
    <div class="clear"></div>
    <p><?php echo CHtml::submitButton('注册',array('class'=>'blue_btn'));?></p>
    <?php $this->endWidget();?>
</div>
<div id="goto_shop_register">
        <?php echo CHtml::link('&gt;&gt;商家加盟入口', array('shopRegister'))?>
</div>
<div class="clear"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.QapTcha').QapTcha({
           // PHPfile:'<?php echo Yii::app()->request->baseUrl.'/plugin/QapTcha/QapTcha.jquery.php';?>',
            PHPfile: '<?php echo Yii::app()->createUrl("accounts/QapTcha");?>',
            txtLock:'请先滑动方块解锁',
            txtUnlock:'已解锁'
        });
    });
</script>
