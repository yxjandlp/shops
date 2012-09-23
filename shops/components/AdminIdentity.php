<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-9-23
 * Time: 上午9:58
 * 管理员验证
 */
class AdminIdentity extends UserIdentity
{
    private $_id;
    private $_username;
    private $_role = 'admin';

    /**
     * 管理员验证
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $user=AdminAccount::model()->find('LOWER(username)=?',array(strtolower($this->username)));
        if( $user == null )
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$user->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$user->id;
            $this->_username=$user->username;
            Yii::app()->user->setState('role',$this->_role);
            $this->errorCode=self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;
    }
}