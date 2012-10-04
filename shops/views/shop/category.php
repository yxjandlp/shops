<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/category.css');?>
<div class="shop_block_list">
    <div class="category_block_title">
        <?php echo CHtml::link('商家联盟', Yii::app()->createUrl('shop/')) .  '» <b>' .$category . '</b>';?>
    </div>
    <?php if(  ! empty($shops) ):?>
    <?php  foreach($shops as $shop): ?>
        <div class="shop_block">
            <a class="enter_shop" href="<?php echo Yii::app()->createUrl('shop/show',array('id'=>$shop['shop']['id']));?>" title="进入店辅">进入店辅»</a>
            <a href="<?php echo Yii::app()->createUrl('shop/show',array('id'=>$shop['shop']['id']));?>" title="<?php echo $shop['shop']['title'];?>"><?php echo CHtml::image(Yii::app()->baseUrl.'/assets/upload/shops/'.$shop['shop']['image'], $shop['shop']['title'],array('width'=>174, 'height'=>140) );?></a>
            <p>店名：<b><?php echo $shop['shop']['title'];?></b></p>
            <p>加盟时间：<b><?php echo date('Y年n月d日',$shop['shop']['join_time']);?></b></p>
        </div>
        <?php endforeach;?>
        <div class="clear"></div>
        <?php else:?>
    <div>--暂无--</div>
    <?php endif;?>
</div>
