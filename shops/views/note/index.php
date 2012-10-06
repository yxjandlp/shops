<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/note.css');?>
<h3><?php echo $shop['title'];?></s></h3>
<form id="note_list" name="note_list" method="post" action="">
    <select id="filter" name="filter">
        <option value="all" <?php if($filter=='all') echo "selected='true'";?>>所有留言</option>
        <option value="0" <?php if($filter=='0') echo "selected='true'";?>>未处理</option>
        <option value="1" <?php if($filter=='1') echo "selected='true'";?>>已处理</option>
    </select>
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'selectableRows'=>2,
        'dataProvider'=>$dataProvider,
        'columns' => array(
            array('class'=>'CCheckBoxColumn','name'=>'id','id'=>'select'),
            'id',
            'username',
            array(
                'name'=>'message',
                'value'=>array($this,'gridNoteContent'),
            ),
            array(
                'header'=> '操作',
                'class'=>'CLinkColumn',
                'label'=>'详细内容',
                'urlExpression'=>'Yii::app()->createUrl("note/detail",array("id"=>$data->id))'
            ),
            array(
                'name'=>'create_time',
                'value'=>'date("Y/m/d H:i:s", $data->create_time)',
            ),
            array(
                'name'=>'is_handled',
                'value'=>array($this,'gridIsHandled'),
            ),
        )
    ));
    ?>
    <input type="hidden" name="shop_id" value="<?php echo $shop['id'];?>" />
    <input type="button" name="set_handled" value="设为已处理" id="set_handled" />&nbsp;&nbsp;
    <input type="button" name="delete_note" value="删除" id="delete_note" />
</form>
<script type="text/javascript">
    $('#set_handled').click(function(){
        if($('.select-on-check:checked').size() < 1){
            $('#note_list').jAlert('请选择处理项','fatal');
        }else{
            $('#note_list').submit();
        }
    });
    $('#delete_note').click(function(){
        if($('.select-on-check::checked').size() < 1){
            $('#note_list').jAlert('请选择删除项','fatal');
        }else{
            if(confirm('确定删除吗')){
                $('#note_list').attr('action', '<?php echo Yii::app()->createUrl('note/delete');?>');
                $('#note_list').submit();
            }
        }
    });
    $('#filter').change(function(){
        $('#note_list').submit();
    });
</script>