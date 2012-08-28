<?php
/**
 * @author yaoxianjin
 *
 * Date: 12-8-26
 * Time: 下午7:46
 */
class ShopForm extends CFormModel
{
    public $title;
    public $description;
    public $image;
    public $admin_pwd;
    public $confirm_pwd;
    public $join_time;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, description, image, admin_pwd, confirm_pwd', 'required'),
            array('title', 'length', 'max'=>100),
            array('image', 'file', 'types'=>'jpg,gif,png', 'maxSize'=>204800),
            array('admin_pwd', 'length', 'min'=>6),
            array('confirm_pwd', 'compare', 'compareAttribute'=>'admin_pwd', 'message'=>'两次输入的密码不一致'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels(){
        return array(
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
    public function addShop() {
        return Shops::model()->addShop($this->attributes);
    }
}