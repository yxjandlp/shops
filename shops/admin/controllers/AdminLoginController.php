<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-9-23
 * Time: 上午9:43
 */
class AdminLoginController extends BaseController
{
    /**
     * 后台登录
     */
    public function actionIndex() {
        $this->setPageTitle('后台登录');

        $model = new AdminAccount();
        $loginInfoArray = $this->getRequestParam('AdminAccount');
        if( $loginInfoArray ){
            $model->attributes = $loginInfoArray;
            if($model->validate() && $model->login()){
                $this->redirect(array('admin/'));
            }
        }
        $this->render('index',array(
            'model' => $model,
        ));
    }
}