<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/show.css');?>
<h3><?php echo $shop['title'];?></h3>
<div class="shop_show_top">
    <div class="shop_image_zone">
        <?php echo CHtml::image(Constant::getShopImagePath().$shop['image'],$shop['title'],array('width'=>210, 'class'=>'shop_show_image'));?>
    </div>
    <div class="shop_operate">
        <div class="operation">
        <?php $this->widget('zii.widgets.CMenu',array(
        'items'=>array(
            array('label'=>'编辑内容', 'url'=>Yii::app()->createUrl('shop/edit'), 'visible'=>(Yii::app()->user->getState('role')=='shop' && Yii::app()->user->getId()==$shop['id'])),
            array('label'=>'|', 'visible'=>(Yii::app()->user->getState('role')=='shop' && Yii::app()->user->getId()==$shop['id'])),
            array('label'=>'更换图片', 'url'=>Yii::app()->createUrl('shop/changeImage'), 'visible'=>(Yii::app()->user->getState('role')=='shop' && Yii::app()->user->getId()==$shop['id'])),
            array('label'=>'|', 'visible'=>(Yii::app()->user->getState('role')=='shop' && Yii::app()->user->getId()==$shop['id'])),
            array('label'=>'管理留言', 'url'=>Yii::app()->createUrl('note/'), 'visible'=>(Yii::app()->user->getState('role')=='shop' && Yii::app()->user->getId()==$shop['id'])),
            array('label'=>'留言领取优惠券', 'url'=>Yii::app()->createUrl('note/add',array('id'=>$shop['id'])), 'visible'=>(Yii::app()->user->getState('role') != 'shop'), 'itemOptions'=>array('id'=>'to_note')),
        ),
        'itemCssClass'=>'top_menu',
    )); ?>
        </div>
        <div class="shop_show_center">
            <p>商家编号: <?php echo $shop['id'];?></p>
            <p>加入时间: <?php echo date('Y年n月d日',$shop['join_time']);?></p>
        </div>
    </div>
</div>
<div class="clear"></div>
 <div class="shop_show_desc">
     <h3 class="desc_title">商家简介：</h3>
     <?php echo $shop['description'];?>
 </div>

<div class="clear"></div>
