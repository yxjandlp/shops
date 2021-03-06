<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/add_shop.css');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/plugin/kindeditor/kindeditor-min.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/plugin/kindeditor/lang/zh_CN.js');?>
<div class="add_shop">
    <?php $form=$this->beginWidget('CActiveForm',array(
    'id'=>'addShopForm',
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    'enableAjaxValidation' => false,
));
    ?>
    <table border="0">
        <tr>
            <td><?php echo $form->labelEx($model,'title'); ?></td>
            <td><?php echo $form->textField($model,'title') ?></td>
            <td><?php echo $form->error($model,'title',array('class'=>'error_msg'));?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'category'); ?></td>
            <td>
                <?php echo $form->dropDownList($model, 'category',$categoryList); ?>
            </td>
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
            <td><?php echo $form->fileField($model,'image') ?><span class="notice">(请选择格式为jpg、gif、png大小不超过2M的图片)</span></td>
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
                <?php echo CHtml::SubmitButton('确定', array('name'=>'add_shop', 'id'=>'register_shop', 'class'=>'blue_btn'));?>&nbsp;
            </td>
        </tr>
    </table>
    <?php $this->endWidget();?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
       $('#register_shop').click(function(){
           if (trim($('#ShopForm_title').val()) == '') {
               $('#ShopForm_title').jAlert('请填写商家标题',"fatal", 'errboxid');
               return false;
           }
           if (trim($('#ShopForm_admin_pwd').val()) == '') {
               $('#ShopForm_admin_pwd').jAlert('请填写管理密码',"fatal", 'errboxid');
               return false;
           }
           if (trim($('#ShopForm_confirm_pwd').val()) == '') {
               $('#ShopForm_confirm_pwd').jAlert('请确认密码',"fatal", 'errboxid');
               return false;
           }
           if (trim($('#ShopForm_image').val()) == '') {
               $('#ShopForm_image').jAlert('请选商家图片',"fatal", 'errboxid');
               return false;
           }
       });
    });
</script>