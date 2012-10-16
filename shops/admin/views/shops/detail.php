<div class="content_block">
<?php echo CHtml::image(Yii::app()->request->baseUrl.'/assets/upload/shops/'.$shop['image'],$shop['title'],array('width'=>210, 'class'=>'shop_image'));?>
<div>
    <h3><?php echo $shop['title'];?></h3>
</div>
<p>
    <?php echo $shop['description'];?>
</p>
<div class="clear"></div>
</div>