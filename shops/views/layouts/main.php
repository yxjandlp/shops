<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">
	<div id="header">
		<div id="header_main">
			<div id="logo"><?php echo CHtml::link(CHtml::encode(Yii::app()->name),array('/'),array('id'=>'loginButton')); ?></div>
			<div id="accounts">
				<ul>
					<li><?php echo CHtml::link('登录',array('accounts/login?go_url='.$this->getReturnUrl()),array('id'=>'loginButton'));?></li>
					<li><?php echo CHtml::link('注册',array('accounts/register'),array('id'=>'registerButton'));?></li>
				</ul>
			</div>
		</div>
	</div>
	<div id="content">
		<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'栏目一', 'url'=>array('')),
				array('label'=>'栏目二', 'url'=>array('', 'view'=>'about')),
				array('label'=>'栏目三', 'url'=>array('')),
				array('label'=>'栏目四', 'url'=>array(''), 'visible'=>Yii::app()->user->isGuest),
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