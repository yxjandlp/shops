<?php
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'language'=>'zh_cn',
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'lovelp',
        ),
    ),
    'name' => '大学窝',
    'import'=>array(
        'application.models.*',
        'application.common.classes.*',
        'application.common.config.*',
        'application.components.*',
        'application.formModels.*',
    ),
    'defaultController'=>'shop',
    'components'=>array(
        'user'=>array(
            'allowAutoLogin' => true,
            'loginUrl' => array('login/')
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=shops',
            'emulatePrepare'   => true,
            'username'          => 'postfix',
            'password'          => 'postfix',
            'charset'           => 'utf8',
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName' => false,
            'rules' => array(
                'login/' => 'accounts/login',
                'register/' => 'accounts/register',
                'logout/' => 'accounts/logout',
                'registerSuccess' => 'accounts/registerSuccess',
                'search' => 'shop/search'
            )
        ),
    ),
    'params'=>require(dirname(__FILE__).'/params.php'),
);