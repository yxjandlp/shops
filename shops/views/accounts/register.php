<?php Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );?>
<?php Yii::app()->clientScript->registerScriptFile('js/register.js');?>
<div class='block_title'>这里是注册界面</div>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm',array(
          'id'=>'registerForm',
          'enableClientValidation'=>true,
          'clientOptions' => array(
              'validateOnSubmit'=>true,
              'validateOnChange'=>true,
              'validateOnType'=>false,
    )));
    ?>
    <table border="0">
        <tr>
            <td class="input_label"><?php echo $form->label($model,'用户名:');?></td>
            <td><?php echo $form->textField($model,'username');?></td>
            <td><?php echo $form->error($model,'username');?></td>
        </tr>
        <tr>
            <td class="input_label"><?php echo $form->label($model,'密码:');?></td>
            <td><?php echo $form->passwordField($model,'password');?></td>
            <td><div id="password_error_msg"></div></td>
        </tr>
        <tr>
            <td class="input_label"><?php echo $form->label($model,'确认密码:');?></td>
            <td><?php echo $form->passwordField($model,'password2');?></td>
            <td><?php echo $form->error($model,'password2');?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><div class="QapTcha"></div></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo CHtml::submitButton('注册');?></td>
        </tr>
    </table>
    <?php $this->endWidget();?>
</div>

