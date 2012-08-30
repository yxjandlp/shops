<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-26
 * Time: 下午7:46
 */
class ShopForm extends CFormModel
{
    public $id;
    public $title;
    public $description;
    public $image;
    public $admin_pwd;
    public $confirm_pwd;
    public $join_time;

    private $_identity;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, description, image, confirm_pwd', 'required', 'on'=>'register'),
            array('admin_pwd','required', 'on'=>'login, register'),
            array('id', 'required', 'on'=>'login'),
            array('title', 'length', 'max'=>100, 'on'=>'register'),
            array('description','length', 'max'=>5120 , 'on'=>'register'),
            array('image', 'file', 'types'=>'jpg,gif,png', 'maxSize'=>204800, 'on'=>'register'),
            array('admin_pwd', 'length', 'min'=>6, 'on'=>'register'),
            array('confirm_pwd', 'compare', 'compareAttribute'=>'admin_pwd', 'message'=>'两次输入的密码不一致', 'on'=>'register'),
            array('admin_pwd','authenticate', 'on'=>'login'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'id' => '店辅编号',
            'title' => '商家标题',
            'description' => "商家描述",
            "image" => "商家图片",
            'admin_pwd' => '管理密码',
            'confirm_pwd' => '确认密码'
        );
    }

    /**
     * 添加商家
     */
    public function addShop()
    {
        return Shops::model()->addShop($this->attributes);
    }

    /*
    * 密码验证
    */
    public function authenticate($attribute,$params)
    {
        $this->_identity = new ShopIdentity($this->id,$this->admin_pwd);

        if( !$this->_identity->authenticate() ){
            $this->addError('id',"店铺编号或管理密码错误");
        }
    }

    /**
     * 商家登录
     *
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ( $this->_identity === null ) {
            $this->_identity = new ShopIdentity($this->id,$this->admin_pwd);
            $this->_identity->authenticate();
        }
        if ( $this->_identity->errorCode === ShopIdentity::ERROR_NONE ) {
            Yii::app()->user->login($this->_identity);
            return true;
        } else {
            return false;
        }
    }
}