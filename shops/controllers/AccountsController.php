<?php
class AccountsController extends BaseController
{
    /**
     * 默认布局文件
     * @var string
     */
	public $layout = "//layouts/accounts";

    /**
     * 过滤器
     * @return array
     */
    public function filters()
    {
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
    public function filterCheckLogin($filterChain)
    {
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
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('logout', 'changePassword'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('index', 'login', 'register', 'shopRegister', 'RegisterSuccess','shopRegisterSuccess', 'shopLogin', 'QapTcha'),
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
	public function actionIndex()
    {
		$this->redirect('login');
	}
	
	/**
	 * 登录动作
	 */
	public function actionLogin()
    {
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
	public function actionRegister()
    {
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
                    if( $model->login() ){
                        $this->showSuccessMessage('注册成功', Yii::app()->homeUrl);
                    }
                }
            }
        }
        $this->render('register', array(
            'model' => $model,
        ));
	}

    /*
    * 注销登录
    */
    public function actionLogout()
    {
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
                $saveImageName = $joinTime .'_174x140.jpg';
                if ( $shopImage->saveAs(Constant::getShopImageUploadPath().$model->image) && ImageUtils::createThumbnail(174, 140, Constant::getShopImageUploadPath().$model->image, Constant::getShopImageUploadPath().$saveImageName) && ( $insertId = $model->addShop()) ) {
                    if ( $model->addShopToCategory($insertId) )
                        $this->redirect('shopRegisterSuccess?insertId='.$insertId);
                }else{
                    throw new CHttpException(500);
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
        $model = new PasswordChangeForm('normal');
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

    /**
     * 滑动解锁验证
     */
    public function actionQapTcha()
    {
        $aResponse['error'] = false;
        if(isset($_POST['action']) && isset($_POST['qaptcha_key'])){
            $_SESSION['qaptcha_key'] = false;
            if(htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8') == 'qaptcha'){
                $_SESSION['qaptcha_key'] = $_POST['qaptcha_key'];
                echo json_encode($aResponse);
            }else{
                $aResponse['error'] = true;
                echo json_encode($aResponse);
            }
        }else{
            $aResponse['error'] = true;
            echo json_encode($aResponse);
        }
    }

}