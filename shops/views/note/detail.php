<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/note.css');?>
<h3>留言内容：</h3>
<div class="note_detail">
    <h3><?php echo $shop['title'];?>：</h3>
    <pre>
        <?php echo $note['message'];?>
    </pre>
    <div class="note_bottom">
        <p><b><?php echo $note['username'];?></b></p>
        <p></p><b><?php  echo date("Y年n月d日",$note['create_time']);?></b></p>
    </div>
    <div class="clear"></div>
</div>


