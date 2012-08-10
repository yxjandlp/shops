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
		
		$login = $this->getRequestParam('login');
		if ( ! empty( $login ) ) {
			$goUrl = $this->getRequestParam('go_url');
			if ( ! empty($goUrl) ) {
				$this->redirect( $goUrl );
			} else {
				$this->redirect( Yii::app()->user->returnUrl );
			}
		}		
		
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