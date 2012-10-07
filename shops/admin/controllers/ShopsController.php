<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-21
 * Time: 下午9:29
 */
class ShopsController extends AdminBaseController
{
    /**
     * 商家列表显示界面
     */
    public function actionIndex()
    {
        $this->setPageTitle('店辅管理');

        $audit = $this->getRequestParam('audit', 'all');
        $criteria = array('with'=>array('category', 'shop'));
        if ( in_array($audit, array('0', '1'), true) ) {
            $criteria['condition'] = 'is_active=:audit';
            $criteria['params'] = array(':audit'=>$audit);
        }
        $dataProvider=new CActiveDataProvider('ShopToCategory', array(
            'criteria'=>$criteria,
        ));
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'audit' => $audit
        ));
    }

    /**
     * 添加商家
     */
    public function actionAdd()
    {
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
                if ( $shopImage->saveAs('assets/upload/shops/'.$model->image) && ImageUtils::createThumbnail(174, 140, 'assets/upload/shops/'.$model->image, 'assets/upload/shops/'.$saveImageName) && ( $insertId = $model->addShopByAdmin()) ) {
                    if ( $model->addShopToCategory($insertId) )
                        $this->showSuccessMessage('添加成功', Yii::app()->createUrl('shops/index'));
                }else{
                    throw new CHttpException(500);
                }
            }
        }
        $categoryModel = ShopCategory::model()->findAll();
        $categoryList = CHtml::listData($categoryModel,'id', 'name');
        $this->render('add', array(
            'model' => $model,
            'categoryList' => $categoryList
        ));
    }

    /**
     * 审核通过
     */
    public function actionSetActive()
    {
        $shopIdArray =  $this->getRequestParam('select');
        if ( ! empty($shopIdArray) ) {
            Shops::model()->updateAll(array('is_active'=>Shops::IS_ACTIVE),'id in('.implode(',',$shopIdArray).')');
            $this->showSuccessMessage('设置成功', Yii::app()->createUrl('shops/index'));
        }
    }

    /**
     * 审核未通过
     */
    public function actionSetInActive()
    {
        $shopIdArray =  $this->getRequestParam('select');
        if ( ! empty($shopIdArray) ) {
            Shops::model()->updateAll(array('is_active'=>Shops::NOT_ACTIVE),'id in('.implode(',',$shopIdArray).')');
            $this->showSuccessMessage('设置成功', Yii::app()->createUrl('shops/index'));
        }
    }

    /**
     *删除商家
     */
    public function actionDelete()
    {
        $shopIdArray = $this->getRequestParam('select');
        if ( ! empty($shopIdArray) ) {
            $criteria1 = new CDbCriteria();
            $criteria2 = new CDbCriteria();
            $criteria1->addInCondition('id', $shopIdArray);
            $criteria2->addInCondition('shop_id', $shopIdArray);

            Shops::model()->deleteAll($criteria1);
            ShopToCategory::model()->deleteAll($criteria2);
            Note::model()->deleteAll($criteria2);
            $this->showSuccessMessage('删除成功', Yii::app()->createUrl('shops/'));
        }
    }

    /**
     * 修改店辅内容页面显示
     */
    public function actionToEdit()
    {
        $this->setPageTitle('商家编辑');

        $shopIdArray = $this->getRequestParam('select');
        $id = $shopIdArray[0];
        $shop = Shops::model()->findByPk($id);
        $shopToCategory = ShopToCategory::model()->find('shop_id=:id', array(':id'=>$id));

        $model = new ShopForm('register');
        $model->attributes = $shop->attributes;
        $categoryModel = ShopCategory::model()->findAll();
        $categoryList = CHtml::listData($categoryModel,'id', 'name');

        $this->render('edit', array(
            'model' => $model,
            'categoryList' => $categoryList,
            'category_id' => $shopToCategory->category_id,
            'shop_id' => $id
        ));
    }

    /**
     * 修改店辅内容
     */
    public function actionEdit()
    {
        $shopInfoArray = $this->getRequestParam('ShopForm');
        if ( ! empty($shopInfoArray) ){
            $id =   $shopInfoArray['id'];
            $shop = Shops::model()->findByPk($id);
            $shopToCategory = ShopToCategory::model()->find('shop_id=:id', array(':id'=>$id));
            $shop->attributes = $shopInfoArray;
            if ($shop->validate()) {
                $shop->save();
                if ( $shopToCategory ) {
                    $shopToCategory->category_id = $shopInfoArray['category'];
                    $shopToCategory->save();
                }
                $this->showSuccessMessage('修改成功', Yii::app()->createUrl('shops/'));
            }
        }
    }

    /**
     * 更换商家图片显示界面
     */
    public function actionChangeImage()
    {
        $this->setPageTitle('修改图片');

        $id = $this->getRequestParam('shop_id');
        if( ! $id ) {
            $shopIdArray = $this->getRequestParam('select');
            $id = $shopIdArray[0];
        }
        $shop = Shops::model()->findByPk($id);
        $model = new ImageChangeForm();
        $shopInfoArray = $this->getRequestParam('ImageChangeForm');
        if ( ! empty($shopInfoArray) ){
            $model->attributes = $shopInfoArray;
            $shopImage = CUploadedFile::getInstance($model, 'image');
            $model->image = $shopImage;
            if ( $model->validate() ) {
                if (  $shopImage->saveAs('assets/upload/shops/'.$shop->image) ) {
                    $this->showSuccessMessage('修改成功', Yii::app()->createUrl('shops/changeImage',array('shop_id'=>$id)));
                }
            }
        }
        $this->render('change_image', array(
            'shop' => $shop,
            'model' => $model
        ));
    }

    /**
     * 修改密码
     */
    public function actionChangePassword()
    {
        $id = $this->getRequestParam('shop_id');
        if( ! $id ) {
            $shopIdArray = $this->getRequestParam('select');
            $id = $shopIdArray[0];
        }
        $this->setPageTitle('修改密码');
        $model = new PasswordChangeForm('admin');
        $passwordInfo = $this->getRequestParam('PasswordChangeForm');
        if( $passwordInfo ){
            $model->attributes = $passwordInfo;
            if($model->validate() && $model->changePasswordByAdmin($id)){
                $this->showSuccessMessage('修改密码成功', Yii::app()->createUrl('shops/'));
            }
        }
        $this->render('change_password',array(
            'model' => $model,
            'shop_id' => $id
        ));
    }

    /**
     * 查看详细内容
     */
    public function actionDetail( $id )
    {
        $shop = Shops::model()->findByPk($id);
        $this->render('detail', array(
            'shop' => $shop
        ));
    }
    /**
     * 判断是否通过审核
     * @return boolean
     */
    protected  function gridIsAudit( $data, $row )
    {
        return $data->shop->is_active==1 ? "通过" : "未通过";
    }

}
