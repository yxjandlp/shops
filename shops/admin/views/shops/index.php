<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/shops.css');?>
<div class="shop_list_tb">
    <form action="" name="shop_list" id="shop_list" method="post">
    审核状态：
    <select name="audit" id="audit">
        <option value="all" <?php if($audit=='all') echo 'selected="true"';?>>所有</option>
        <option value="0" <?php if($audit==='0') echo 'selected="true"';?>>未通过</option>
        <option value="1" <?php if($audit==='1') echo 'selected="true"';?>>通过</option>
    </select>
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
        <input type="button" name="set_active" id="set_active" value="通过审核">
        <input type="button" name="set_in_active" id="set_in_active" value="未通过审核">
    </div>
    </form>
</div>
<script type="text/javascript">
    $('#audit').change(function(){
        $('#shop_list').submit();
    });
    $('#set_active').click(function(){
        if($('.select-on-check:checked').size() < 1){
            $('#shop_list').jAlert('请选择处理项','fatal');
        }else{
            $('#shop_list').attr('action', '<?php echo Yii::app()->createUrl('shops/setActive');?>');
            $('#shop_list').submit();
        }
    });
    $('#set_in_active').click(function(){
        if($('.select-on-check:checked').size() < 1){
            $('#shop_list').jAlert('请选择处理项','fatal');
        }else{
            $('#shop_list').attr('action', '<?php echo Yii::app()->createUrl('shops/setInActive');?>');
            $('#shop_list').submit();
        }
    });
</script>
