<?php echo CHtml::image(Yii::app()->request->baseUrl.'/assets/upload/shops/'.$shop['image']);?>
<p><?php echo $shop['title'];?></p>
<p>
    <?php echo $shop['description'];?>
</p>
<?php echo CHtml::link('留言领取优惠券', array('note/'.$shop['id']));?>
