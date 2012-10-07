<div id='header'>
    <div id='logo'>
        <h1><?php echo Yii::app()->name . ' - 后台';?></h1>
    </div>
    <div class="admin_account">
        <?php echo Yii::app()->user->name;?>，<a href="<?php echo Yii::app()->createUrl('adminLogin/logout');?>">退出</a>
    </div>
</div>