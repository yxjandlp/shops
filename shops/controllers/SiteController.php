<?php
class SiteController extends BaseController {
	
	public $layout="//layouts/site";
	
	/**
	 * the main page of site
	 */
	public function actionIndex() {
		$this->pageTitle = CHtml::encode(Yii::app()->params['title']) . '| home';
		$this->render( 'index' , array(
				
		) );
	}
	

}