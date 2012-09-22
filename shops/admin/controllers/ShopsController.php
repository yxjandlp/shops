<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-21
 * Time: 下午9:29
 */
class ShopsController extends BaseController
{
    /**
     * 商家列表显示界面
     */
    public function actionIndex()
    {
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
     * 添加商家界面显示
     */
    public function actionAdd()
    {
        $model = new Shops();
        $shopInfoArray = $this->getRequestParam('Shops');
        if ( $shopInfoArray ) {
            $model->attributes = $shopInfoArray;
            $shopImage = CUploadedFile::getInstance($model,'image');
            $joinTime = time();
            $model->join_time = $joinTime;
            $model->image = $joinTime.'.'.$shopImage->extensionName;
            if ( $model->save() &&  $shopImage->saveAs('assets/upload/'.$model->image) ) {
                $this->redirect('index');
            }
        }
        $this->render('add', array(
            'model' => $model
        ));
    }

    /**
     * 判断是否通过审核
     */
    protected function gridIsAudit( $data, $row ) {
        return $data->shop->is_active==1 ? "通过" : "未通过";
    }

}
