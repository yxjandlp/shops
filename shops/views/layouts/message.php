<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jalert/jquery.jalert.packed.js');?>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/jalert/jalert.css');?>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
    <?php echo $content; ?>
</body>
</html>