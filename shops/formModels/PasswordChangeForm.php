<?php
/**
 * 修改密码表单
 * @author yaoxianjin
 *
 * Date: 12-9-30
 * Time: 上午8:07
 */
class PasswordChangeForm extends CFormModel
{
    public  $oldPassword;
    public  $newPassword;
    public  $confirmNewPassword;

    /**
     * 表单验证规则
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('oldPassword', 'required', 'on'=>'normal'),
            array('newPassword, confirmNewPassword', 'required', 'on'=>'normal, admin'),
            array('oldPassword','checkOldPassword', 'on'=>'normal, admin'),
            array('newPassword', 'length', 'min'=>6, 'on'=>'normal, admin'),
            array('confirmNewPassword', 'compare', 'compareAttribute'=>'newPassword', 'message'=>'两次输入的密码不一致', 'on'=>'normal, admin'),
        );
    }

    /**
     * 定义各属性显示的标签名
     */
    public function attributeLabels()
    {
        return array(
            'oldPassword' => '旧密码',
            'newPassword' => '新密码',
            'confirmNewPassword' => '确认新密码',
        );
    }

    /**
     * 验证旧密码是否正确
     *
     * @return boolean
     */
    public function checkOldPassword($attribute,$params)
    {
        $model = null;
        if( in_array(Yii::app()->user->getState('role'),array('shop', 'member')) ){
            $model = Shops::model()->findByPk(Yii::app()->user->getId());
        }elseif( Yii::app()->user->getState('role') == 'member' ){
            $model = User::model()->findByPk(Yii::app()->user->getId());
        }elseif( Yii::app()->user->getState('role') == 'admin' ){
            $model = AdminAccount::model()->findByPk(Yii::app()->user->getId());
        }
        if( $model && ! $model->validatePassword($this->oldPassword) ){
            $this->addError('oldPassword',"旧密码输入错误");
        }
    }

    /**
     * 修改密码
     *
     * @return boolean
     */
    public function changePassword()
    {
        $model = null;
        if( in_array(Yii::app()->user->getState('role'),array('shop', 'member')) ){
            $model = Shops::model()->findByPk(Yii::app()->user->getId());
        }elseif( Yii::app()->user->getState('role') == 'member' ){
            $model = User::model()->findByPk(Yii::app()->user->getId());
        }elseif( Yii::app()->user->getState('role') == 'admin' ){
            $model = AdminAccount::model()->findByPk(Yii::app()->user->getId());
        }
        if( $model ){
            return $model->changePassword($this->newPassword);
        }
    }

    /**
     * 修改密码（后台管理）
     */
    public function changePasswordByAdmin( $shopId)
    {
        $model = Shops::model()->findByPk($shopId);
        return $model->changePassword($this->newPassword);
    }

}