<?php
$admin = dirname(dirname(__FILE__));
$frontend = dirname($admin);
Yii::setPathOfAlias('admin', $admin);
Yii::setPathOfAlias('frontend', $frontend);
return array(
		'basePath' => $frontend,
        'name' => '大学窝',
		'controllerPath' => $admin.'/controllers',
		'viewPath' => $admin.'/views',
		'runtimePath' => $admin.'/runtime',
        'language'=>'zh_cn',
		'defaultController'=>'adminLogin',
		'components'=>array(
            'user'=>array(
                'loginUrl' => array('adminLogin/')
            ),
				'db'=>array(
						'connectionString' => 'mysql:host=localhost;dbname=shops',
						'emulatePrepare'   => true,
						'username'          => 'root',
						'password'          => 'lovelp',
						'charset'           => 'utf8',
				),
				'urlManager'=>array(
/*						'urlFormat'=>'path',
						'showScriptName' => false,
						'rules' => array(

						)*/
				),
		),
		'import' => array(
				'admin.models.*',
				'frontend.models.*',
				'frontend.common.classes.*',
                'frontend.components.*',
                'frontend.formModels.*',
		),
    'params'=>require(dirname(__FILE__).'/params.php'),
		
);