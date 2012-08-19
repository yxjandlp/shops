<?php
class AccountsController extends BaseController {
	
	public $layout = "//layouts/accounts";

    /**
     * 过滤器
     * @return array
     */
    public function filters(){
        return array(
            'accessControl' ,
            'checkLogin',
        );
    }

    /**
     * 如果已登录，则给出的action将直接跳转到首页
     *
     * @param $filterChain
     */
    public function filterCheckLogin($filterChain) {
        $filterArray = array('login', 'register', 'registerSuccess');
        if ( ! Yii::app()->user->isGuest && in_array($this->action->id, $filterArray) ) {
            $this->redirect(Yii::app()->homeUrl);
        }
        $filterChain->run();
    }

    /**
     * 访问控制
     *
     * @return array
     */
    public function accessRules(){
        return array(
            array('allow',
                'actions'=>array('logout'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('index', 'login', 'register', 'RegisterSuccess'),
                'users'=>array('*'),
            ),
            array('deny',
                'users'=>array('*')
            )
        );
    }

	/**
	 * the defalut page of accounts
	 */
	public function actionIndex() {
		$this->redirect('login');
	}
	
	/**
	 * 登录动作
	 */
	public function actionLogin() {
        $this->pageTitle = CHtml::encode(Yii::app()->params['title']) .'| login';

        $model = new UserForm('login');
        $loginInfoArray = $this->getRequestParam('UserForm');
        if( $loginInfoArray ){
            $model->attributes = $loginInfoArray;
            if($model->validate() && $model->login()){
                $goUrl = $this->getRequestParam('go_url');
                if ( ! empty($goUrl) ) {
                    $this->redirect( $goUrl );
                } else {
                    $this->redirect( Yii::app()->user->returnUrl );
                }
            }
        }
        $this->render('login',array(
            'model' => $model,
        ));
	}
	
	/**
	 * 注册动作
	 */
	public function actionRegister() {
		$this->pageTitle = CHtml::encode(Yii::app()->params['title']) .'| register';
        $model = new UserForm('register');

        $ajaxForm = $this->getRequestParam('ajax');
        if ($ajaxForm == "userForm") {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        $registerInfoArray = $this->getRequestParam('UserForm');
        if ( $registerInfoArray ) {
            $model->attributes = $registerInfoArray;
            if ( $model->validate() ) {
                $registerInfoArray['password'] = sha1($registerInfoArray['password']);
                if ($model->register($registerInfoArray['username'], $registerInfoArray['password'])) {
                    $this->redirect('registerSuccess');
                }
            }
        }

        $this->render('register', array(
            'model' => $model,
        ));
	}

    /**
     * 注册成功页面
     */
    public function actionRegisterSuccess() {
        $this->pageTitle = CHtml::encode(Yii::app()->params['title']) .'| 注册成功';
        $this->render('register_success', array());
    }

    /*
    * 注销登录
    */
    public function actionLogout(){
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}