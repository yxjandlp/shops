<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-19
 * Time: 下午3:31
 */
class UserForm extends CFormModel {

    public $username;
    public $password;
    public $password2;
    public $rememberMe = false;

    private $_identity;

    /**
     * 字段规则
     */
    public function rules() {
        return array(
            array('username', 'required', 'on'=>'login,register', 'message'=>'用户名不能为空'),
            array('password', 'required', 'on'=>'login,register', 'message'=>'密码不能为空'),
            array('password2', 'required', 'on'=>'register', 'message'=>'请确认密码'),
            array('username','match','pattern'=>'/^[\w]{6,20}$/','on'=>'register','message'=>'用户名格式错误'),
            array('username', 'validateUsername', 'on'=>'register'),
            array('password', 'length', 'min'=>6, 'on'=>'register', 'message'=>'密码长度不能小于6位'),
            array('password2', 'compare', 'compareAttribute'=>'password', 'on'=>'register', 'message'=>'两次输入的密码不一致'),
            array('rememberMe', 'boolean', 'on'=>'login'),
            array('password','authenticate', 'on'=>'login'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels(){
        return array(
            'username' => '用户名',
            'password' => "密码",
            "password2" => "确认密码",
        );
    }

    /*
    * 密码验证
    */
    public function authenticate($attribute,$params){
        $this->_identity = new UserIdentity($this->username,$this->password);

        if( !$this->_identity->authenticate() ){
            $this->addError('username',"用户名或密码错误");
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ( $this->_identity === null ) {
            $this->_identity = new UserIdentity($this->username,$this->password);
            $this->_identity->authenticate();
        }
        if ( $this->_identity->errorCode === UserIdentity::ERROR_NONE ) {
            $duration = $this->rememberMe ? 3600*24*14 : 0;
            Yii::app()->user->login($this->_identity,$duration);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 用户名合法性判断
     */
    public function validateUsername($attribute,$params) {
        if ($this->username) {
            $model = User::model()->getUserByUsername($this->username);
            if ($model) {
                $this->addError('username',"用户名已被注册");
            }
        }
    }

    /**
     * 注册用户
     */
    public function register( $username, $password ) {
        return User::model()->addUser($username, $password);
    }

}