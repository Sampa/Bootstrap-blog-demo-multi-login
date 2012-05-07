<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $created
 * @property string $last_activity
 * @property string $avatar
 */

class User extends CActiveRecord
{
	const USER_DIR = "/files/users/";
	const USER_LINK = "/profile/u/";
	const PUBLIC_LIBRARY = 1;
	const PRIVATE_LIBRARY = 0;
	public $password2;
	public $verifyCode;
	public $usernameLegal;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model( $className = __CLASS__ )
	{
		return parent::model( $className );
	}

	/**
	 * @return string the associated database table name
	 */
	 public function beforeValidate()
	{
        $this->usernameLegal = preg_replace( '/[^A-Za-z0-9@_#?!&-]/' , '', $this->username );
        return true;
	}
	public function tableName()
	{
		return '{{user}}';
	}
	public function getFullName()
	{
		return $this->username;
	}
	
	public function getSuggest($q) 
	{
		$c = new CDbCriteria();
		$c->addSearchCondition('username', $q, true, 'OR');
		$c->addSearchCondition('email', $q, true, 'OR');
		return $this->findAll($c);
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required','on'=>'validation'),
			array('username, password, last_activity', 'length', 'max'=>128,'on'=>'validation'),
			array('avatar', 'length', 'max'=>255,'on'=>'validation'),
			array('last_activity', 'safe','on'=>'validation'),
			array('presentation','safe','on'=>'validation'),
			 array('username', 'compare', 'compareAttribute'=>'usernameLegal', 'message'=>'Username contains illegal characters','on'=>'validation'),
		//array('password', 'compare', 'compareAttribute'=>'password2'),              
			array('email','length','max'=>256,'on'=>'validation'),
         // make sure email is a valid email
         //array('email','email'),
         // make sure username and email are unique
		//array('username, email', 'unique'), 
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, created, last_activity,', 'safe', 'on'=>'search,validation'),
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
			'howtos' => array( self::HAS_MANY , 'Howto' , 'author_id' ),
			
		);
	}
		
	
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword( $password , $bf_hash )
		{
	       return crypt( $password , $bf_hash ) === $bf_hash;
	}
	
	public static function getUserDir( $id )
	{
		$dir = User::USER_DIR . $id;
		if ( file_exists( $dir ) )
			{ return $dir; }
		else { return false; }
	}
	
	public static function getUserLink( $username ) 
	{
		
		return CHtml::link($username, array( User::USER_LINK . $username ) );
	
	}
	
	public static function getUserUrl( $username ) 
	{
		return User::USER_LINK . $username;
	
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Username',
			'Password' => 'Password',
			'email' => 'Email',
			'created' => 'Registred',
			'last_activity' => 'Last activity',
			'avatar' => 'Profile picture',
		);
	}

	protected function beforeSave()
	{
		if ( parent::beforeSave() )
		{
			$time = new Datetime();
			if ( $this->isNewRecord )
			{	
				$this->created = $time->format('Y-m-d-h-m-s');
				if ( isset ( $_POST['User']['password'] ) ){
					$password = $_POST['User']['password'];
				} else{
					$password = rand(9999,999999);
				}
				$this->password = crypt( $password,  Randomness::blowfishSalt() );
			}
			else{ 
				$this->last_activity = $time->format('Y-m-d-h-m-s');
			}
			return true;
		}
		else
			return false;
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

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('last_activity',$this->last_activity,true);
		$criteria->compare('avatar',$this->avatar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}