<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-9-23
 * Time: 下午8:29
 * 后台管理基础控制器类
 */
class AdminBaseController extends BaseController
{
    /**
     * 过滤器
     * @return array
     */
    public function filters(){
        return array(
            'checkRole',
        );
    }

    /**
     * 角色过滤，只有管理员有权限
     *
     * @param $filterChain
     */
    public function filterCheckRole($filterChain) {
        if (  Yii::app()->user->getState('role' ) != 'admin' ) {
            $this->redirect(Yii::app()->user->loginUrl);
        }
        $filterChain->run();
    }

    /**
     * 成功提示
     */
    public  function showSuccessMessage( $message="", $returnUrl="shops/")
    {
       $this->redirect(Yii::app()->createUrl('message/success', array('message'=>$message, 'returnUrl'=>$returnUrl)));
    }
}