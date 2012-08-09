<?php
class AccountsController extends BaseController {
	
	public $layout = "//layouts/accounts";
	
	/**
	 * the defalut page of accounts
	 */
	public function actionIndex() {
		$this->redicret('accounts/login');
	}
	
	/**
	 * the login action
	 */
	public function actionLogin() {
		$this->pageTitle = CHtml::encode(Yii::app()->params['title']) .'| login';
		$this->render( 'login' , array(
	
		) );
	}
	
	/**
	 * the register action
	 */
	public function actionRegister() {
		$this->pageTitle = CHtml::encode(Yii::app()->params['title']) .'| register';
		$this->render( 'register' , array(
	
		));
	}			
	
}