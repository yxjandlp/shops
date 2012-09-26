<!--<div class='block_title'>商家联盟...</div>
<div id="shops_list">
<div class='shop' style='background-color:#15ADEF;'>店辅一</div>
<div class='shop' style='background-color:#CCC2B9'>店辅二</div>
<div class='shop' style='background-color:#EEF0EF'>店辅三</div>
<div class='clear'></div>
<div class='shop' style='background-color:#FCB712;'>店辅一</div>
<div class='shop' style='background-color:#96B232'>店辅二</div>
<div class='shop' style='background-color:#339933'>店辅三</div>
<div class='clear'></div>
</div>-->
<?php  foreach( $shopGroups as $shopGroup ): ?>
    <div class="category_shop_list">
    <h3><?php echo $shopGroup['category'];?></h3>
    <div class="shop_shelf">
        <?php if( ! empty($shopGroup['shops']) ):?>
        <?php  foreach($shopGroup['shops'] as $shop): ?>
        <span>
            <p><?php echo CHtml::image(Yii::app()->baseUrl.'/assets/upload/shops/'.$shop['shop']['image'], 'alt',array('width'=>174, 'height'=>140) );?></p>
            <p class="show_shop_title"><?php echo  CHtml::link( StringUtils::truncateText($shop['shop']['title'], 15), Yii::app()->createUrl('shop/show',array('id'=>$shop['shop']['id'])));?></p>
        </span>
        <?php endforeach;?>
        <?php else:?>
        <span>--暂无--</span>
        <?php endif;?>

    </div>
    </div>
    <div class="clear"></div>
<?php  endforeach; ?>