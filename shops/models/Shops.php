<?php

/**
 * This is the model class for table "shops".
 *
 * The followings are the available columns in table 'shops':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $join_time
 * @property string $admin_pwd
 * @property integer $is_active
 */
class Shops extends CActiveRecord
{
    /**
     * 是否激活
     */
    const IS_ACTIVE = 1;

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shops the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shops';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, image, join_time, admin_pwd', 'required'),
			array('is_active', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('image', 'length', 'max'=>14),
			array('join_time', 'length', 'max'=>10),
			array('admin_pwd', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, image, join_time, admin_pwd, is_active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '商家标题',
			'description' => '商家描述',
			'image' => '商家图片',
			'join_time' => '加入时间',
			'admin_pwd' => '管理密码',
			'is_active' => '是否激活',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('join_time',$this->join_time,true);
		$criteria->compare('admin_pwd',$this->admin_pwd,true);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * 返回所有商家列表
     *
     * @return Array shopList
     */
    public function getAllShopsList() {
        return $this->findAll();
    }

    /**
     * 添加商家
     */
    public function addShop($attributes) {
        $shop = new Shops();
        $shop->setAttribute('title',$attributes['title'] );
        $shop->setAttribute('description', $attributes['description']);
        $shop->setAttribute('image', $attributes['image']);
        $shop->setAttribute('admin_pwd', $attributes['admin_pwd']);
        $shop->setAttribute('join_time', $attributes['join_time']);
        $shop->setAttribute('is_active', self::IS_ACTIVE);
        $shop->save();
        return $shop->id;
    }
}