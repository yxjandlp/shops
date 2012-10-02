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
                'header'=> '查看',
                'class'=>'CLinkColumn',
                'label'=>'详细',
                'urlExpression'=>'Yii::app()->createUrl("shops/detail",array("id"=>$data->id))'
            ),
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
        <input type="button" name="edit" id="edit" value="修改" />
        <input type="button" name="delete" id="delete" value="删除">
        <input type="button" name="change_image" id="change_image" value="更换图片">
        <input type="button" name="change_pwd" id="change_pwd" value="修改密码">
        <input type="button" name="set_active" id="set_active" value="通过审核">
        <input type="button" name="set_in_active" id="set_in_active" value="未通过审核">
    </div>
    </form>
</div>
<script type="text/javascript">
    function editCheck(action){
        if($('.select-on-check:checked').size() < 1){
            $('#shop_list').jAlert('请选择修改项','fatal');
        }else if($('.select-on-check:checked').size() > 1){
            $('#shop_list').jAlert('不能同时修改多项','fatal');
        }else{
            $('#shop_list').attr('action', action);
            $('#shop_list').submit();
        }
    }
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
    $('#delete').click(function(){
        if($('.select-on-check:checked').size() < 1){
            $('#shop_list').jAlert('请选择删除项','fatal');
        }else{
            if(confirm('确定删除吗')){
                $('#shop_list').attr('action', '<?php echo Yii::app()->createUrl('shops/delete');?>');
                $('#shop_list').submit();
            }
        }
    });
    $('#edit').click(function(){
        var action = '<?php echo Yii::app()->createUrl('shops/toEdit');?>';
        editCheck(action);
    });
    $('#change_image').click(function(){
        var action = '<?php echo Yii::app()->createUrl('shops/changeImage');?>';
        editCheck(action);
    });
    $('#change_pwd').click(function(){
        var action = '<?php echo Yii::app()->createUrl('shops/changePassword');?>';
        editCheck(action);
    });
</script>
