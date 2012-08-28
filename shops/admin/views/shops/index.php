<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/shops.css');?>
<div class="shop_list_tb">
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$dataProvider,
    ));
    ?>
    <div class="operation">
        <input type="button" value="增加" onclick="location='<?php echo Yii::app()->createUrl('shops/add') ;?>';" />
        <input type="button" value="修改" />
        <input type="button" value="删除">
    </div>
</div>
