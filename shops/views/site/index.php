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
<div class='block_title'>商家联盟...</div>
<?php  foreach( $shopGroups as $shopGroup ): ?>
    <?php echo $shopGroup['category'];?>
    <ul>
        <?php if( ! empty($shopGroup['shops']) ):?>
        <?php  foreach($shopGroup['shops'] as $shop): ?>
        <li><?php echo  CHtml::link( $shop['shop']['title'], Yii::app()->createUrl('shop/show',array('id'=>$shop['shop']['id'])));?></li>
        <?php endforeach;?>
        <?php else:?>
        <li>--暂无--</li>
        <?php endif;?>
    </ul>
<?php  endforeach; ?>