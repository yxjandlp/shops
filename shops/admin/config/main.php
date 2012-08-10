<?php
$admin = dirname(dirname(__FILE__));
$frontend = dirname($admin);
Yii::setPathOfAlias('admin', $admin);
Yii::setPathOfAlias('frontend', $frontend);

return array(
		'basePath' => $frontend,

		'controllerPath' => $admin.'/controllers',
		'viewPath' => $admin.'/views',
		'runtimePath' => $admin.'/runtime',
		
		'defaultController'=>'admin',
		
		'components'=>array(
				
				'db'=>array(
						'connectionString' => 'mysql:host=localhost;dbname=shops',
						'emulatePrepare'   => true,
						'username'          => 'root',
						'password'          => 'lovelp',
						'charset'           => 'utf8',
		
				),
				'urlManager'=>array(
						'urlFormat'=>'path',
						'showScriptName' => false,
						'rules' => array(
		
						)
				),
		),
		
		'import' => array(
				'admin.models.*',
				'admin.components.*',
				'admin.models.*',
				'frontend.models.*',
				'frontend.common.classes.*',
		),
		
);