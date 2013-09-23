<?php

/**
 * This is the model class for table "jebapp_user_details".
 *
 * The followings are the available columns in table 'jebapp_user_details':
 * @property integer $id
 * @property string $f_name
 * @property string $l_name
 * @property string $organization
 * @property string $address1
 * @property string $address2
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $zip
 * @property string $phone
 * @property string $fax
 * @property string $avater
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class UserDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jebapp_user_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('f_name, l_name, organization, country, state, city, zip', 'length', 'max'=>100),
			array('address1, address2, avater', 'length', 'max'=>255),
			array('phone, fax', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, f_name, l_name, organization, address1, address2, country, state, city, zip, phone, fax, avater', 'safe', 'on'=>'search'),
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
			'users' => array(self::HAS_MANY, 'User', 'user_details_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'f_name' => 'First Name',
			'l_name' => 'Last Name',
			'organization' => 'Organization',
			'address1' => 'Address Line 1',
			'address2' => 'Address Line 2',
			'country' => 'Country',
			'state' => 'State',
			'city' => 'City',
			'zip' => 'Zip',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'avater' => 'Avatar',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('f_name',$this->f_name,true);
		$criteria->compare('l_name',$this->l_name,true);
		$criteria->compare('organization',$this->organization,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('avater',$this->avater,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}