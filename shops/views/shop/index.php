<?php echo CHtml::image(Yii::app()->request->baseUrl.'/assets/upload/shops/'.$shop['image'],$shop['title'],array('width'=>210, 'class'=>'shop_image'));?>
<div>
    <h3><?php echo $shop['title'];?></h3
    <p></p>
        <?php
        if (  Yii::app()->user->getState('role') != 'shop') {
            echo CHtml::link('留言领取优惠券', array('note/add','id'=>$shop['id']));
        }
        ?>
    </p>
</div>
<p>
    <?php echo $shop['description'];?>
</p>

<?php $this->widget('zii.widgets.CMenu',array(
    'items'=>array(
        array('label'=>'编辑内容', 'url'=>Yii::app()->createUrl('shop/edit',array('id'=>Yii::app()->user->getId())), 'visible'=>(Yii::app()->user->getState('role')=='shop' && Yii::app()->user->getId()==$shop['id'])),
        array('label'=>'更换图片', 'url'=>Yii::app()->createUrl('shop/changeImage',array('id'=>Yii::app()->user->getId())), 'visible'=>(Yii::app()->user->getState('role')=='shop' && Yii::app()->user->getId()==$shop['id'])),
        array('label'=>'管理留言', 'url'=>Yii::app()->createUrl('note/'), 'visible'=>(Yii::app()->user->getState('role')=='shop' && Yii::app()->user->getId()==$shop['id'])),
    ),
    'itemCssClass'=>'top_menu',
)); ?>
<div class="clear"></div>
