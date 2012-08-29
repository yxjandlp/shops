<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property integer $join_time
 * @property integer $is_active
 */
class User extends CActiveRecord
{
    /**
     * 激活用户
     */
    const IS_ACTIVE = 1;

    /**
     * 受限制用户
     */
    const IS_NOT_ACTIVE = 0;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, join_time', 'required'),
			array('username', 'length', 'max'=>20),
			array('password', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, join_time, is_active', 'safe', 'on'=>'search'),
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
			'username' => '用户名',
			'password' => '密码',
			'join_time' => '加入时间',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('join_time',$this->join_time);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * 根据用户名获取用户信息
     *
     * @param $username string
     */
    public function getUserByUsername( $username ) {
        return User::model()->find('username=:username', array(':username'=>$username));
    }

    /**
     * 检验密码是否正确
     *
     * @param $password string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password) {
        return sha1($password) == $this->password;
    }

    /**
     * 添加用户
     *
     * @param $username
     * @param $password
     * @return boolean true if save successfully
     */
    public function addUser($username, $password) {
        $user = new User();
        $user->setAttribute('username', $username);
        $user->setAttribute('password', $password);
        $user->setAttribute('join_time', time());
        $user->setAttribute('is_active', self::IS_ACTIVE);
        return $user->save();
    }

}