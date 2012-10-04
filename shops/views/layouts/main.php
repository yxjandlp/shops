<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="Description" content="大学窝是一个面向大学生的商家信息展示平台，包括商家联盟、杂志专区、营销大区、音乐家族、摄影家族、创业创新几大版块" />
    <meta name="Keywords" content="daxuewo，大学窝，大学生，商家，杂志，音乐，摄影，创业，创新" />
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/main.css');?>
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jalert/jquery.jalert.packed.js');?>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/jalert/jalert.css');?>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/main.js');?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container" id="page">
    <div id="top">
        <div id="header_main">
            <div id="accounts">
                <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'登录', 'url'=>Yii::app()->homeUrl.'login?go_url='.$this->getReturnUrl(),'linkOptions'=>array('id'=>'loginButton'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'快速注册', 'url'=>array('register/'), 'linkOptions'=>array('id'=>'registerButton'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>Yii::app()->user->name, 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'进入我的店辅', 'url'=>Yii::app()->createUrl('shop/show',array('id'=>Yii::app()->user->getId())), 'visible'=>(Yii::app()->user->getState('role')=='shop')),
                    array('label'=>'修改密码', 'url'=>array('accounts/changePassword'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'注销', 'url'=>array('logout/'), 'visible'=>!Yii::app()->user->isGuest),
                ),
                'itemCssClass'=>'top_menu',
            )); ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
   <div id="logo">
       <?php echo CHtml::link(CHtml::encode(Yii::app()->name),array('/'), array('id'=>"site_name")); ?>
       <div class="to_add_shop"><a href="#">商家加盟</a></div>
   </div>
    <div id="main_menu">
        <div id="nav">
            <?php $this->widget('zii.widgets.CMenu',array(
            'items'=>array(
                array('label'=>'商家联盟', 'url'=>array('/'), 'linkOptions'=>array('class'=>'current')),
                array('label'=>'杂志专区', 'url'=>array('/')),
                array('label'=>'营销大区', 'url'=>array('/')),
                array('label'=>'音乐家族', 'url'=>array('/')),
                array('label'=>'摄影家族', 'url'=>array('/')),
                array('label'=>'创业创新', 'url'=>array('/')),

            ),
        )); ?>
        </div>
        <div class="search_block"><input type="text" id="search"/></div>
        <div class="clear"></div>
    </div>
	<div id="content">
		<?php echo $content; ?>
		<div id="footer">
			<?php include('_sitemap.php');?>
			<div class='clear'></div>
			<div id="copyright">
				Copyright &copy; <?php echo date('Y').' '.Yii::app()->params['copyrightInfo']; ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>