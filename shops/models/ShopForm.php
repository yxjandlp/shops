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

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, description, image', 'required'),
            array('title', 'length', 'max'=>100),
            array('image', 'file', 'types'=>'jpg,gif,png'),
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
        );
    }

    /**
     * 添加商家
     */
    public function addShop($attributes) {
        return Shops::model()->addShop($attributes);
    }
}