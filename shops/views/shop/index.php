<?php  foreach( $shopGroups as $shopGroup ): ?>
    <div class="category_shop_list">
    <div class="category_shop_title">
        <div class="category_name"> <?php echo $shopGroup['category']['name'];?></div>
        <div class="more_shop"><a href="<?php echo Yii::app()->createUrl('shop/category', array('id'=>$shopGroup['category']['id']));?>">更多»</a></div>
    </div>
    <div class="shop_shelf">
        <?php if( ! empty($shopGroup['shops']) ):?>
        <?php  foreach($shopGroup['shops'] as $shop): ?>
        <span>
            <p><a href="<?php echo Yii::app()->createUrl('shop/show',array('id'=>$shop['shop']['id']));?>" title="<?php echo $shop['shop']['title'];?>"><?php echo CHtml::image(Yii::app()->baseUrl.'/assets/upload/shops/'.$shop['shop']['image'], $shop['shop']['title'],array('width'=>174, 'height'=>140) );?></p></a>
        </span>
        <?php endforeach;?>
        <?php else:?>
        <span>--暂无--</span>
        <?php endif;?>
    </div>
    </div>
    <div class="clear"></div>
<?php  endforeach; ?>