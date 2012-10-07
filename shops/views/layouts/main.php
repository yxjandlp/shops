<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
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
                <ul>
                    <?php if( Yii::app()->user->isGuest ):?>
                    <li><a href="<?php echo Yii::app()->homeUrl.'login?go_url='.$this->getReturnUrl();?>" class="first_horizon_menu">登录</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('register/');?>">快速注册</a></li>
                    <?php endif;?>
                    <?php if( ! Yii::app()->user->isGuest):?>
                    <li><?php echo Yii::app()->user->name;?></li>
                    <?php endif;?>
                    <?php if(Yii::app()->user->getState('role')=='shop'):?>
                    <li><a href="<?php echo Yii::app()->createUrl('shop/show',array('id'=>Yii::app()->user->getId()));?>">进入我的店辅</a></li>
                    <?php endif;?>
                    <?php if( ! Yii::app()->user->isGuest):?>
                    <li class="account_li">
                        <a href="javascript:void(0);" class="account_label">帐号</a>
                        <div class="drop_list_menu">
                            <ul>
                                <li><a href="<?php echo Yii::app()->createUrl('accounts/changePassword');?>">修改密码</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('logout/');?>">退出</a></li>
                            </ul>
                        </div>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
   <div id="logo">
       <?php echo CHtml::link(CHtml::encode(Yii::app()->name),array('shop/'), array('id'=>"site_name")); ?>
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
        <div class="search_block">
            <form name="search" id="search_form" action="<?php echo Yii::app()->createUrl('search/');?>" method="get">
                <input type="text" id="search" name="keyword" value=""/>
            </form>
        </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        $(document).onkeydown = Search;
    });
</script>
</body>
</html>