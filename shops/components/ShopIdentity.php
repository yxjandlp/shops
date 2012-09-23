<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-29
 * Time: 下午9:33
 */
class ShopIdentity extends CUserIdentity
{
    private $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $shop = Shops::model()->find('id=?',array($this->username));
        if( $shop == null )
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if( ! $shop->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id = $shop->id;
            Yii::app()->user->setState('role','shop');
            $this->errorCode=self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;
    }

    public function getId()
    {
        return $this->_id;
    }

}