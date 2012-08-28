<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/add_shop.css');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/plugin/kindeditor/kindeditor-min.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/plugin/kindeditor/lang/zh_CN.js');?>
<div class="add_shop">
    <?php $form=$this->beginWidget('CActiveForm',array(
    'id'=>'addShopForm',
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
    ?>
    <table border="0">
        <tr>
            <td><?php echo $form->labelEx($model,'title'); ?></td>
            <td><?php echo $form->textField($model,'title') ?></td>
            <td><?php echo $form->error($model,'title',array('class'=>'error_msg'));?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'admin_pwd'); ?></td>
            <td><?php echo $form->passwordField($model,'admin_pwd') ?></td>
            <td><?php echo $form->error($model,'admin_pwd',array('class'=>'error_msg'));?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'confirm_pwd'); ?></td>
            <td><?php echo $form->passwordField($model,'confirm_pwd') ?></td>
            <td><?php echo $form->error($model,'confirm_pwd',array('class'=>'error_msg'));?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'image'); ?></td>
            <td><?php echo $form->fileField($model,'image') ?></td>
            <td><?php echo $form->error($model,'image',array('class'=>'error_msg'));?></td>
        </tr>

        <?php $this->widget('webroot.plugin.kindeditor.KindEditor',
        array(
            'model'=>$model,
            'attribute'=>'description',
        )); ?>
        <tr>
            <td valign="top"><?php echo $form->labelEx($model,'description'); ?></td>
            <td><?php echo $form->textArea($model,'description'); ?></td>
            <td><?php echo $form->error($model,'description',array('class'=>'error_msg'));?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <?php echo CHtml::SubmitButton('确定', array('name'=>'add_shop', 'id'=>'register_shop'));?>&nbsp;
                <?php echo CHtml::button('取消', array('id'=>'cancel'));?>
            </td>
        </tr>
    </table>
    <?php $this->endWidget();?>
</div>
<script type="text/javascript">
    document.getElementById('cancel').onclick = function(){
        location = 'index';
    }
    $(document).ready(function(){
       $('#register_shop').click(function(){
           if ($('#ShopForm_title').val().trim() == '') {
               $('#ShopForm_title').jAlert('请填写商家标题',"fatal", 'errboxid');
               return false;
           }
           if ($('#ShopForm_admin_pwd').val().trim() == '') {
               $('#ShopForm_admin_pwd').jAlert('请填写管理密码',"fatal", 'errboxid');
               return false;
           }
           if ($('#ShopForm_confirm_pwd').val().trim() == '') {
               $('#ShopForm_confirm_pwd').jAlert('请确认密码',"fatal", 'errboxid');
               return false;
           }
           if ($('#ShopForm_image').val().trim() == '') {
               $('#ShopForm_image').jAlert('请选商家图片',"fatal", 'errboxid');
               return false;
           }
       });
    });
</script>