<?php

class AdminController extends AdminBaseController {

    public $layout="//layouts/frame";

    /**
     * the frame of admin
     */
	public function actionIndex() {
        $this->setPageTitle('后台');
		$this->render('index' , array() );
	}

    /**
     * the left navigation of admin frame
     */
    public function actionHead() {
        $this->pageTitle = Yii::app()->name . ' - admin';
        $this->render('head' , array());
    }

    /**
     * the left navigation of admin frame
     */
    public function actionLeft() {
        $this->pageTitle = Yii::app()->name . ' - admin';
        $this->render('left' , array());
    }

    /**
     * the home page of admin
     */
	public function actionHome() {
        $this->pageTitle = Yii::app()->name . ' - admin';
        $shopsAmount = Shops::model()->count();
        $shopToAudit = Shops::model()->count('is_active=:not_active', array(':not_active'=>Shops::NOT_ACTIVE));
        $this->render('home' , array(
            'shops_amount' => $shopsAmount,
            'shop_to_audit' => $shopToAudit
        ));
    }
}