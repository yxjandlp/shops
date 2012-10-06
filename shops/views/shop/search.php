<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/category.css');?>
<h3>搜索结果：</h3>
<?php  foreach($shops as $shop): ?>
<div class="shop_block">
    <a class="enter_shop" href="<?php echo Yii::app()->createUrl('shop/show',array('id'=>$shop['id']));?>" title="进入店辅">进入店辅»</a>
    <a href="<?php echo Yii::app()->createUrl('shop/show',array('id'=>$shop['id']));?>" title="<?php echo $shop['title'];?>"><?php echo CHtml::image(Yii::app()->baseUrl.'/assets/upload/shops/'.$shop['image'], $shop['title'],array('width'=>174, 'height'=>140) );?></a>
    <p>店名：<b><?php echo  str_replace($keyword,'<b class="red">'.$keyword.'</b>', $shop['title']);?></b></p>
    <p>加盟时间：<b><?php echo date('Y年n月d日',$shop['join_time']);?></b></p>
</div>
<?php endforeach;?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#search').val('<?php echo $keyword;?>');
    });
</script>