<?php
class AccountsController extends BaseController {

    /**
     * 默认布局文件
     * @var string
     */
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
        $filterArray = array('login', 'register', 'registerSuccess', 'shopRegisterSuccess', 'shopLogin');
        if ( ! Yii::app()->user->isGuest && in_array($this->action->id, $filterArray) ) {
            $this->redirect(Yii::app()->homeUrl);
        }
        $filterChain->run();
    }

    /**
     * 访问控制
     * @return array
     */
    public function accessRules(){
        return array(
            array('allow',
                'actions'=>array('logout', 'changePassword'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('index', 'login', 'register', 'shopRegister', 'RegisterSuccess','shopRegisterSuccess', 'shopLogin'),
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
        $this->setPageTitle('登录');

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
        $this->setPageTitle('注册');
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
                    $model->login();
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
        $this->setPageTitle('注册成功');
        $this->render('register_success', array());
    }

    /*
    * 注销登录
    */
    public function actionLogout(){
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * 商家加盟
     */
    public function actionShopRegister()
    {
        $this->setPageTitle('商家加盟');

        $model = new ShopForm('register');
        $shopInfoArray = $this->getRequestParam('ShopForm');
        if ( ! empty($shopInfoArray) ){
            $model->attributes = $shopInfoArray;
            $shopImage = CUploadedFile::getInstance($model,'image');
            $model->image = $shopImage;
            if ($model->validate()) {
                $joinTime = time();
                $model->join_time = $joinTime;
                $model->image = $joinTime.'.'.$shopImage->extensionName;
                $model->admin_pwd = sha1($shopInfoArray['admin_pwd']);
                if ( $shopImage->saveAs('assets/upload/shops/'.$model->image) && ( $insertId = $model->addShop()) ) {
                    if ( $model->addShopToCategory($insertId) )
                        $this->redirect('shopRegisterSuccess?insertId='.$insertId);
                }
            }
        }

        $categoryModel = ShopCategory::model()->findAll();
        $categoryList = CHtml::listData($categoryModel,'id', 'name');
        $this->render('shop_register', array(
            'model' => $model,
            'categoryList' => $categoryList
        ));
    }

    /**
     * 商家注册成功页面
     */
    public function actionShopRegisterSuccess()
    {
        $this->setPageTitle('加盟成功');

        $this->render('shop_register_success', array(
            'lastInsertId' => str_pad( $this->getRequestParam('insertId'), 5, '0' , STR_PAD_LEFT),
        ));
    }

    /**
     * 店辅登录动作
     */
    public function actionShopLogin()
    {
        $this->setPageTitle('商家登录');

        $model = new ShopForm('login');
        $loginInfoArray = $this->getRequestParam('ShopForm');
        if( $loginInfoArray ){
            $model->attributes = $loginInfoArray;
            if($model->validate() && $model->login()){
                $this->redirect(Yii::app()->homeUrl);
            }
        }
        $this->render('shop_login',array(
            'model' => $model,
        ));
    }

    /**
     * 修改密码
     */
    public function actionChangePassword()
    {
        $this->setPageTitle('修改密码');
        $model = new PasswordChangeForm();
        $passwordInfo = $this->getRequestParam('PasswordChangeForm');
        if( $passwordInfo ){
            $model->attributes = $passwordInfo;
            if($model->validate() && $model->changePassword()){
                $this->showSuccessMessage('修改密码成功', Yii::app()->homeUrl);
            }
        }
        $this->render('password_change',array(
            'model' => $model
        ));
    }
}