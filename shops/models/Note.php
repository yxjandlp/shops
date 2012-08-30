<?php

/**
 * This is the model class for table "note".
 *
 * The followings are the available columns in table 'note':
 * @property string $id
 * @property string $shop_id
 * @property string $user_id
 * @property string $message
 * @property string $create_time
 * @property integer $is_handled
 */
class Note extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Note the static model class
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
		return 'note';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message', 'required'),
			array('shop_id', 'length', 'max'=>5),
			array('message', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, shop_id, user_id, message, create_time, is_handled', 'safe', 'on'=>'search'),
		);
	}

   /**
    * 验证之前的一些操作用
    *
    * @return boolean
    */
    public function beforeValidate()
    {
        if ($this->getIsNewRecord() ) {
            $this->create_time = time();
        }
        return true;
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
			'shop_id' => '店辅编号',
			'user_id' => '用户ID',
			'message' => '留言内容',
			'create_time' => '留言时间',
			'is_handled' => '是否处理',
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
		$criteria->compare('shop_id',$this->shop_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('is_handled',$this->is_handled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}