<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-30
 * Time: 下午8:37
 */
class ShopController extends BaseController {

    /**
     * 默认布局文件
     * @var string
     */
    public $layout="//layouts/site";

    /**
     * 过滤器
     * @return array
     */
    public function filters(){
        return array(
            'accessControl' ,
            'checkRole',
        );
    }

    /**
     * 如果角色不是店辅管理员，则给出的action将直接跳转到首页
     *
     * @param $filterChain
     */
    public function filterCheckRole($filterChain) {
        $filterArray = array('edit', 'changeImage', 'delete');
        if ( Yii::app()->user->getState('role') != 'shop' && in_array($this->action->id, $filterArray) ) {
            throw new CHttpException(403);
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
                'actions'=>array( 'edit', 'changeImage'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('show', 'index', 'category', 'search'),
                'users'=>array('*'),
            ),
            array('deny',
                'users'=>array('*')
            )
        );
    }

    /**
     * 店辅列表页
     */
    public function actionIndex()
    {
        $this->setPageTitle('商家联盟');

        $shopsArray = array();
        $categories = ShopCategory::model()->findAll();
        foreach ( $categories as $category ) {
            $criteria = new CDbCriteria();
            $criteria->with = array('category', 'shop');
            $criteria->compare('category_id', $category['id']);
            $criteria->compare('is_active', Shops::IS_ACTIVE);
            $criteria->limit = 5;
            $models = ShopToCategory::model()->findAll($criteria);
            $shopsArray[] = array(
                'category' => $category,
                'shops' => $models
            );
        }
        $this->render( 'index' , array(
            'shopGroups' => $shopsArray
        ) );
    }

    /**
     * 分类浏览
     */
    public function actionCategory( $id )
    {
        $category = ShopCategory::model()->findByPk($id);
        if ( ! $category ) {
            throw new CHttpException(404);
            Yii::app()->end();
        }
        $this->setPageTitle($category['name']);
        $criteria = new CDbCriteria();
        $criteria->with = array('category', 'shop');
        $criteria->compare('category_id', $id);
        $criteria->compare('is_active', Shops::IS_ACTIVE);

        $count = ShopToCategory::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $shops = ShopToCategory::model()->findAll($criteria);
        $this->render('category', array(
            'category' => $category['name'],
            'shops' => $shops,
            'pages' => array(
                'pages'=>$pages,
                'header'=>'',
                'prevPageLabel'=>'<',
                'nextPageLabel'=>'>',
            )
        ));
    }
    /**
     * 店辅主页
     */
    public function actionShow( $id )
    {
        $shop = Shops::model()->findByPk($id);
        if( ! $shop ){
            throw new CHttpException(404);
        }
        $this->setPageTitle($shop['title']);
        if( $shop->is_active == Shops::NOT_ACTIVE ){
            $this->render('shop_to_audit', array());
        }else{

            $this->render('show', array(
                'shop' => $shop
            ));
        }
    }

    /**
     * 编辑店辅
     */
    public function actionEdit()
    {
        $this->setPageTitle('编辑店辅');

        $id = Yii::app()->user->getId();
        $shop = Shops::model()->findByPk($id);
        $shopToCategory = ShopToCategory::model()->find('shop_id=:id', array(':id'=>$id));
        $model = new ShopForm('register');
        $model->attributes = $shop->attributes;
        $shopInfoArray = $this->getRequestParam('ShopForm');
        if ( ! empty($shopInfoArray) ){
            $shop->attributes = $shopInfoArray;
            if ($shop->validate()) {
                $shop->save();

                if ( $shopToCategory ) {
                    $shopToCategory->category_id = $shopInfoArray['category'];
                    $shopToCategory->save();
                }
                $this->showSuccessMessage('修改成功', Yii::app()->createUrl('shop/show',array('id'=>$id)));
            }
        }

        $categoryModel = ShopCategory::model()->findAll();
        $categoryList = CHtml::listData($categoryModel,'id', 'name');
        $this->render('edit', array(
            'model' => $model,
            'categoryList' => $categoryList,
            'category_id' => $shopToCategory->category_id,
        ));
    }

    /**
     * 修改图片
     */
    public function actionChangeImage()
    {
        $this->setPageTitle('修改图片');

        $id = Yii::app()->user->getId();
        $shop = Shops::model()->findByPk($id);
        $model = new ImageChangeForm();
        $shopInfoArray = $this->getRequestParam('ImageChangeForm');
        if ( ! empty($shopInfoArray) ){
            $model->attributes = $shopInfoArray;
            $shopImage = CUploadedFile::getInstance($model, 'image');
            $model->image = $shopImage;
            $saveImageName = $shop->join_time .'_174x140.jpg';
            if ( $model->validate() ) {
                if (  $shopImage->saveAs('assets/upload/shops/'.$shop->image) && ImageUtils::createThumbnail(174, 140, 'assets/upload/shops/'.$shop->image, 'assets/upload/shops/'.$saveImageName) ) {
                    $this->showSuccessMessage('修改成功', Yii::app()->createUrl('shop/changeImage'));
                }
            }
        }
        $this->render('change_image', array(
            'shop' => $shop,
            'model' => $model
        ));
    }

    /**
     * 搜索商家
     */
    public function actionSearch()
    {
        $keyword = $this->getRequestParam('keyword');
        $this->setPageTitle('搜索['.$keyword.']');
        $criteria = new CDbCriteria();
        if( $keyword ){
            $criteria->addSearchCondition('title', $keyword);
        }
        $shops = Shops::model()->findAll($criteria);
        $this->render('search',array(
            'keyword' => $keyword,
            'shops' => $shops
        ));
    }

}