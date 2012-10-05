<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/note.css');?>
<h3><?php echo $shop['title'];?></h3>
<div class="noteForm">
    <?php $form=$this->beginWidget('CActiveForm',array('method'=>'post'));?>
    <p><?php echo $form->errorSummary($model);?></p>
    <p><?php echo $form->label($model,'message');?>：</p>
    <p><?php echo $form->textArea($model,'message',array('maxlength'=>'200','id'=>'note_text'));?></p>
    <?php echo CHtml::submitButton('确定',array('id'=>'add_note','class'=>'blue_btn'));?>
    <?php $this->endWidget();?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#add_note').click(function(){
            if ($('#note_text').val().trim() == '') {
                $('#note_text').jAlert('请输入留言内容',"fatal", 'errboxid');
                return false;
            }
        });
    });
</script>