<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property string $id
 * @property string $username
 * @property string $password
 */
class AdminAccount extends CActiveRecord
{
    private $_identity;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Admin the static model class
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
		return 'admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('username', 'length', 'max'=>100),
			array('password', 'length', 'max'=>40),
            array('password', 'authenticate'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password', 'safe', 'on'=>'search'),
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
			'username' => '帐号',
			'password' => '密码',
		);
	}

    /*
    * 密码验证
    */
    public function authenticate($attribute,$params)
    {
        $this->_identity = new AdminIdentity($this->username,$this->password);

        if( !$this->_identity->authenticate() ){
            $this->addError('username',"管理员帐号或密码错误");
        }
    }

    /**
     * 检验密码是否正确
     *
     * @param $password string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
        return sha1($password) == $this->password;
    }

    /**
     * 管理员登录
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ( $this->_identity === null ) {
            $this->_identity = new AdminIdentity($this->username,$this->password);
            $this->_identity->authenticate();
        }
        if ( $this->_identity->errorCode === UserIdentity::ERROR_NONE ) {
            Yii::app()->user->login($this->_identity, 0);
            return true;
        } else {
            return false;
        }
    }

    /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * 修改密码
     * @param string $password
     * @return boolean
     */
    public function changePassword( $password )
    {
        $this->setAttribute('password', sha1($password));
        return $this->update(array('password'));
    }

}