<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/admin.css" />
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<?php echo $content; ?>
</html>
