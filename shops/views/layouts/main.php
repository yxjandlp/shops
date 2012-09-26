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
    <div id="mainmenu">
        <div id="header_main">
            <div id="accounts">
                <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'登录', 'url'=>Yii::app()->homeUrl.'login?go_url='.$this->getReturnUrl(),'linkOptions'=>array('id'=>'loginButton'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'注册', 'url'=>array('register/'), 'linkOptions'=>array('id'=>'registerButton'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>Yii::app()->user->name, 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'进入我的店辅', 'url'=>Yii::app()->createUrl('shop/show',array('id'=>Yii::app()->user->getId())), 'visible'=>(Yii::app()->user->getState('role')=='shop')),
                    array('label'=>'注销', 'url'=>array('logout/'), 'visible'=>!Yii::app()->user->isGuest),
                ),
                'itemCssClass'=>'top_menu',
            )); ?>
            </div><div class="clear"></div>
            <div id="logo"><?php echo CHtml::link(CHtml::encode(Yii::app()->name),array('/'),array('id'=>'loginButton')); ?></div>
        </div>
        <div class="clear"></div>
        <div class="banner">
            <div class="tabbar">
                <div class="tabs">
                    <?php $this->widget('zii.widgets.CMenu',array(
                    'items'=>array(
                        array('label'=>'商家联盟', 'url'=>array('/'), 'linkOptions'=>array('class'=>'actived')),
                        array('label'=>'杂志专区', 'url'=>array('/')),
                        array('label'=>'营销大区', 'url'=>array('/')),
                        array('label'=>'音乐家族', 'url'=>array('/')),
                        array('label'=>'摄影家族', 'url'=>array('/')),
                        array('label'=>'创业创新', 'url'=>array('/')),
                        array('label'=>'关于我们', 'url'=>array('/')),
                    ),
                )); ?>
                </div>
                <div class="bg">
                    <div class="nw"></div>
                    <div class="cen"></div>
                    <div class="cen"></div>
                    <div class="cen"></div>
                    <div class="cen"></div>
                    <div class="ne"></div>
                </div>
            </div>
        </div>
        <div class="bar clear"></div>
    </div>
	<div id="content">
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