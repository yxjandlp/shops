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
            <td><?php echo $form->label($model,'商家标题:'); ?></td>
            <td><?php echo $form->textField($model,'title') ?></td>
            <td><?php echo $form->error($model,'title',array('class'=>'error_msg'));?></td>
        </tr>
        <tr>
            <td><?php echo $form->label($model,'商家图片:'); ?></td>
            <td><?php echo $form->fileField($model,'image') ?></td>
            <td><?php echo $form->error($model,'image',array('class'=>'error_msg'));?></td>
        </tr>
         <?php $this->widget('admin.ext.kindeditor.KindEditor',
            array(
                'model'=>$model,
                'attribute'=>'description',
            )); ?>
        <tr>
             <td valign="top"><?php echo $form->labelEx($model,'商家描述:'); ?></td>
            <td><?php echo $form->textArea($model,'description'); ?></td>
            <td><?php echo $form->error($model,'description',array('class'=>'error_msg'));?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <?php echo CHtml::submitButton('确定');?>&nbsp;
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
</script>