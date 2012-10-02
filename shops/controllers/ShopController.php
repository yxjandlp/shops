<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-30
 * Time: 下午8:37
 */
class ShopController extends ShopBaseController {

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
        );
    }

    /**
     * 访问控制
     * @return array
     */
    public function accessRules(){
        return array(
            array('allow',
                'actions'=>array('note', 'edit','manageNote','deleteNote', 'changeImage', 'noteDetail'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('show', 'index'),
                'users'=>array('*'),
            ),
            array('deny',
                'users'=>array('*')
            )
        );
    }

    /**
     * 店辅主页
     */
    public function actionShow( $id )
    {
        $this->setPageTitle('商家');
        $shop = Shops::model()->findByPk($id);
        $this->render('index', array(
            'shop' => $shop
        ));
    }

    /**
     * 编辑店辅
     */
    public function actionEdit( $id )
    {
        $this->checkOwner($id);
        $this->setPageTitle('编辑店辅');

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
    public function actionChangeImage( $id )
    {
        $this->checkOwner($id);
        $this->setPageTitle('修改图片');

        $shop = Shops::model()->findByPk($id);
        $model = new ImageChangeForm();
        $shopInfoArray = $this->getRequestParam('ImageChangeForm');
        if ( ! empty($shopInfoArray) ){
            $model->attributes = $shopInfoArray;
            $shopImage = CUploadedFile::getInstance($model, 'image');
            $model->image = $shopImage;
            if ( $model->validate() ) {
                if (  $shopImage->saveAs('assets/upload/shops/'.$shop->image) ) {

                }
            }
        }
        $this->render('change_image', array(
            'shop' => $shop,
            'model' => $model
        ));
    }

}