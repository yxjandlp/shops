<?php
class SiteController extends BaseController {
	
	public $layout="//layouts/site";
	
	/**
	 * 网站首页-商家联盟页
	 */
	public function actionIndex() {
        $this->pageTitle = CHtml::encode(Yii::app()->params['title']) . '| 首页';

        $shopsArray = array();
        $categories = ShopCategory::model()->findAll();
        foreach ( $categories as $category ) {
            $criteria = new CDbCriteria();
            $criteria->with = array('category', 'shop');
            $criteria->compare('category_id', $category['id']);
            $criteria->limit = 5;
            $models = ShopToCategory::model()->findAll($criteria);
            $shopsArray[] = array(
                'category' => $category['name'],
                'shops' => $models
            );
        }

		$this->render( 'index' , array(
            'shopGroups' => $shopsArray
		) );
	}

}