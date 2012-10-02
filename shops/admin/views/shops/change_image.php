<div class="content_block">
<?php echo CHtml::image(Yii::app()->request->baseUrl.'/assets/upload/shops/'.$shop['image'].'?'.rand(),$shop['title'],array('width'=>210, 'class'=>'shop_image'));?>
<div class="clear"></div>
<?php $form=$this->beginWidget('CActiveForm',array(
    'id'=>'change_image_form',
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    'enableAjaxValidation' => false,
));
?>
<input type="hidden" name="shop_id" value="<?php echo $shop['id'];?>" />
<?php echo $form->labelEx($model,'image'); ?>
<?php echo $form->fileField($model,'image') ?>
<?php echo CHtml::SubmitButton('确定', array('name'=>'add_shop', 'id'=>'register_shop'));?>
<?php echo $form->error($model,'image',array('class'=>'error_msg'));?>
<?php $this->endWidget();?>
</div>