<?php
return array(
		'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name' => '这里是网站的名称',
		'import'=>array(
				'application.models.*',
				'application.common.classes.*',
				'application.common.config.*',
		),
		'defaultController'=>'site',
		'components'=>array(
				'user'=>array(
						'allowAutoLogin'=>true,
				),
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
								'login/' => 'site/login',
								'register/' => 'site/register',
						)
				),
		),
		'params'=>require(dirname(__FILE__).'/params.php'),
);