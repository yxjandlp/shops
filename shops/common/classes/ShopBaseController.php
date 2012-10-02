<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-10-2
 * Time: 上午11:14
 */
class ShopBaseController extends BaseController
{
    /**
     * 商家权限过滤,只有本店辅管理员有权限
     *
     * @param int $id
     */
    protected  function checkOwner( $id )
    {
        if ( Yii::app()->user->isGuest || Yii::app()->user->getState('role') != 'shop' || Yii::app()->user->getId() != $id ) {
            $this->redirect(Yii::app()->homeUrl);
        }
    }
}