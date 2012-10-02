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
                if ( $shopImage->saveAs('assets/upload/shops/'.$model->image) && ( $insertId = $model->addShopByAdmin()) ) {
                    if ( $model->addShopToCategory($insertId) )
                        $this->showSuccessMessage('添加成功', Yii::app()->createUrl('shops/index'));
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
    public function actionSetActive() {
        $shopIdArray =  $this->getRequestParam('select');
        if ( ! empty($shopIdArray) ) {
            Shops::model()->updateAll(array('is_active'=>Shops::IS_ACTIVE),'id in('.implode(',',$shopIdArray).')');
            $this->showSuccessMessage('设置成功', Yii::app()->createUrl('shops/index'));
        }
    }

    /**
     * 审核未通过
     */
    public function actionSetInActive() {
        $shopIdArray =  $this->getRequestParam('select');
        if ( ! empty($shopIdArray) ) {
            Shops::model()->updateAll(array('is_active'=>Shops::NOT_ACTIVE),'id in('.implode(',',$shopIdArray).')');
            $this->showSuccessMessage('设置成功', Yii::app()->createUrl('shops/index'));
        }
    }

    /**
     * 判断是否通过审核
     * @return boolean
     */
    protected  function gridIsAudit( $data, $row ) {
        return $data->shop->is_active==1 ? "通过" : "未通过";
    }

}
