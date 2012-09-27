<?php  foreach( $shopGroups as $shopGroup ): ?>
    <div class="category_shop_list">
    <h3>
        <?php echo $shopGroup['category'];?>
        <span class="more_shop"><a href="">更多&gt;&gt;</a></span>
    </h3>
    <div class="shop_shelf">
        <?php if( ! empty($shopGroup['shops']) ):?>
        <?php  foreach($shopGroup['shops'] as $shop): ?>
        <span>
            <p><a href="<?php echo Yii::app()->createUrl('shop/show',array('id'=>$shop['shop']['id']));?>" title="<?php echo $shop['shop']['title'];?>"><?php echo CHtml::image(Yii::app()->baseUrl.'/assets/upload/shops/'.$shop['shop']['image'], $shop['shop']['title'],array('width'=>174, 'height'=>140) );?></p></a>
            <!--<p class="show_shop_title"><?php /*echo  CHtml::link( StringUtils::truncateText($shop['shop']['title'], 15), Yii::app()->createUrl('shop/show',array('id'=>$shop['shop']['id'])));*/?></p>-->
        </span>
        <?php endforeach;?>
        <?php else:?>
        <span>--暂无--</span>
        <?php endif;?>
    </div>
    </div>
    <div class="clear"></div>
<?php  endforeach; ?>