<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/shops.css');?>
<div class="shop_list_tb">
    <table border="0">
        <tr>
            <th class="shop_list_no">序号</th>
            <th class="shop_list_name">商家名称</th>
            <th class="shop_list_time">加入时间</th>
        </tr>
        <?php if ($isListEmpty):?>
        <tr>
            <td colspan="3">-----------空-----------</td>
        </tr>
        <?php else:?>
            <?php foreach($shopsList as $key=>$shop):?>
            <tr>
                <td><?php echo $key;?></td>
                <td><?php echo $shop['title'];?></td>
                <td><?php echo date('Y年m月d日', $shop['join_time']);?></td>
            </tr>
            <?php endforeach;?>
        <?php endif;?>
    </table>
    <div class="operation">
        <input type="button" value="增加" onclick="location='<?php echo Yii::app()->createUrl('admin.php/shops/add') ;?>';" />
        <input type="button" value="修改" />
        <input type="button" value="删除">
    </div>
</div>