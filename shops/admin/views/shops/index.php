<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/shops.css');?>
<div class="shop_list_tb">
    <?php
/*    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider'=>$dataProvider,
    ));*/
    ?>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'selectableRows'=>2,
        'dataProvider'=>$dataProvider,
        'columns' => array(
            array('class'=>'CCheckBoxColumn','name'=>'shop.id','id'=>'select'),
            array(
                'name'=>'shop.id',
                'value'=>'$data->shop->id',
            ),
            array(
                'name'=>'category.name',
                'value'=>'$data->category->name',
            ),
            'shop.title',
            array(
                'name'=>'shop.join_time',
                'value'=>'date("Y/m/d H:i:s", $data->shop->join_time)',
            ),
            array(
                'name'=>'shop.is_active',
                'value'=>array($this,'gridIsAudit'),
            ),
        )
    ));
    ?>
    <div class="operation">
        <input type="button" value="增加" onclick="location='<?php echo Yii::app()->createUrl('shops/add') ;?>';" />
        <input type="button" value="修改" />
        <input type="button" value="删除">
    </div>
</div>
