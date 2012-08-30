<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-30
 * Time: 下午10:31
 */
class MessageController extends CController
{
    public $layout="//layouts/message";

    /**
     * 成功界面
     */
    public function actionSuccess()
    {
        $this->pageTitle = CHtml::encode(Yii::app()->params['title']) . '| 成功';

        $message = Yii::app()->request->getParam('message','');
        $returnUrl = Yii::app()->request->getParam('returnUrl', Yii::app()->createUrl('/'));
        $this->render('success',array(
            'returnUrl' => $returnUrl,
            'message' => $message
        ));
    }

}