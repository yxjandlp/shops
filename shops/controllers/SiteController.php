<?php
class SiteController extends BaseController {
	
	public $layout="//layouts/site";
	
	/**
	 * the main page of site
	 */
	public function actionIndex() {
        $this->pageTitle = CHtml::encode(Yii::app()->params['title']) . '| 首页';

        $shops = Shops::model()->getAllShopsList();
		$this->render( 'index' , array(
            'shops' => $shops
		) );
	}

}