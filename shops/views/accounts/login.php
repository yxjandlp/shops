<div class='block_title'>这里是登录界面</div>
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm');?>
    <?php echo $form->errorSummary($model);?>
    <table border="0">
        <tr>
            <td class="input_label"><?php echo $form->label($model,'用户名:');?></td>
            <td><?php echo $form->textField($model,'username');?></td>
        </tr>
        <tr>
            <td class="input_label"><?php echo $form->label($model,'密码:');?></td>
            <td><?php echo $form->passwordField($model,'password');?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <?php echo $form->checkBox($model,'rememberMe');?>
                <?php echo $form->label($model,'两周内自动登录');?>
            </td>
        </tr>
        <tr>
            <td><?php echo CHtml::submitButton('登录');?></td>
        </tr>
    </table>
    <?php $this->endWidget();?>
</div>