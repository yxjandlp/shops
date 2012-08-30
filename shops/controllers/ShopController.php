<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-30
 * Time: 下午8:37
 */
class ShopController extends BaseController {

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
     *
     * @return array
     */
    public function accessRules(){
        return array(
            array('allow',
                'actions'=>array('note'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('index'),
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
    public function actionIndex( $id )
    {
        $this->pageTitle = CHtml::encode(Yii::app()->params['title']) . '| 商家';

        $shop = Shops::model()->findByPk($id);
        $this->render('index', array(
            'shop' => $shop
        ));
    }

    /**
     * 用户留言
     */
    public function actionNote( $id )
    {
        $this->pageTitle = CHtml::encode(Yii::app()->params['title']) . '| 留言';

        $model = new Note();
        $noteInfo = $this->getRequestParam('Note');
        if ( $noteInfo ) {
            $model->attributes = $noteInfo;
            if ( $model->validate() ) {
                $model->user_id = Yii::app()->user->getId();
                $model->shop_id = $id;
                $model->message = $noteInfo['message'];
                if ( $model->save() ) {
                    $this->showSuccessMessage('留言成功', Yii::app()->createUrl('shop/'.$id));
                }
            }
        }
        $this->render('note', array(
            'model' => $model
        ));
    }

}