<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/main.css');?>
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jalert/jquery.jalert.packed.js');?>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/jalert/jalert.css');?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">
	<div id="header">
		<div id="header_main">
			<div id="logo"><?php echo CHtml::link(CHtml::encode(Yii::app()->name),array('/'),array('id'=>'loginButton')); ?></div>
			<div id="accounts">
                <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'登录', 'url'=>'login?go_url='.$this->getReturnUrl(),'linkOptions'=>array('id'=>'loginButton'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'注册', 'url'=>'register', 'linkOptions'=>array('id'=>'registerButton'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'注销 ('.Yii::app()->user->name.')', 'url'=>'logout', 'visible'=>!Yii::app()->user->isGuest)
                ),
                'firstItemCssClass'=>'first_horizon_menu',
            )); ?>
			</div>
		</div>
	</div>
	<div id="content">
		<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'商家联盟', 'url'=>array('')),
				array('label'=>'杂志专区', 'url'=>array('')),
				array('label'=>'营销大区', 'url'=>array('')),
				array('label'=>'音乐家族', 'url'=>array('')),
                array('label'=>'摄影家族', 'url'=>array('')),
                array('label'=>'创业创新课题', 'url'=>array('')),
			),
		)); ?>
		<div class='clear'></div>
		</div>
		<?php echo $content; ?>
		<div id="footer">
			<?php include('_sitemap.php');?>
			<div class='clear'></div>
			<div id="copyright">
				Copyright &copy; <?php echo date('Y').' '.Yii::app()->params['copyrightInfo']; ?>All Rights Reserved.<br/>
			</div>
		</div>
	</div>
</div>
</body>
</html>