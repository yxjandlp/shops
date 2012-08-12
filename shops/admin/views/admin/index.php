<frameset framespacing="0" border="0" frameborder="NO" rows="36,*">
    <frame src="<?php echo Yii::app()->createUrl('admin.php/admin/head');?>" scrolling="no" target="main" marginheight="0" marginwidth="0" name="topFrame" frameborder="NO" noresize="noresize" id="frame_top">
    <frameset cols="150,*">
        <frame src="<?php echo Yii::app()->createUrl('admin.php/admin/left');?>" frame scrolling="no" target="main_content" frameborder="0" marginheight="0" marginwidth="0" noresize="noresize" name="leftFrame" id='frame_left'>
        <frame src="<?php echo Yii::app()->createUrl('admin.php/admin/home');?>" scrolling="auto" target="_self" frameborder="0" marginheight="0" marginwidth="0" name="main_content">
    </frameset>
</frameset>
