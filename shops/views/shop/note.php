<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/note.css');?>
<div class="noteForm">
    <?php $form=$this->beginWidget('CActiveForm',array('method'=>'post'));?>
    <p><?php echo $form->errorSummary($model);?></p>
    <p><?php echo $form->label($model,'message');?>：</p>
    <p><?php echo $form->textArea($model,'message',array('maxlength'=>'200','id'=>'note_text'));?></p>
    <?php echo CHtml::submitButton('确定');?>
    <?php $this->endWidget();?>
</div>