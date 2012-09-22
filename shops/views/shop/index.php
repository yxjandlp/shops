<?php echo CHtml::image(Yii::app()->request->baseUrl.'/assets/upload/shops/'.$shop['image']);?>
<p><?php echo $shop['title'];?></p>
<p>
    <?php echo $shop['description'];?>
</p>
<?php
if (  Yii::app()->user->getState('role') != 'shop') {
    echo CHtml::link('留言领取优惠券', array('shop/note','id'=>$shop['id']));
}
?>
<?php $this->widget('zii.widgets.CMenu',array(
    'items'=>array(
        array('label'=>'编辑', 'url'=>Yii::app()->createUrl('shop/edit',array('id'=>Yii::app()->user->getId())), 'visible'=>(Yii::app()->user->getState('role')=='shop' && Yii::app()->user->getId()==$shop['id'])),
        array('label'=>'管理留言', 'url'=>Yii::app()->createUrl('shop/manageNote',array('id'=>Yii::app()->user->getId())), 'visible'=>(Yii::app()->user->getState('role')=='shop' && Yii::app()->user->getId()==$shop['id'])),
    ),
    'itemCssClass'=>'top_menu',
)); ?>
