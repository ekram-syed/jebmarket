<?php

/**
 * This is the model class for table "jebapp_media".
 *
 * The followings are the available columns in table 'jebapp_media':
 * @property integer $id
 * @property string $caption
 * @property string $alternative_text
 * @property string $description
 * @property string $url
 * @property string $upload_date
 * @property string $modified_date
 * @property integer $jebapp_user_id
 *
 * The followings are the available model relations:
 * @property User $jebappUser
 */
class Media extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jebapp_media';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('caption, alternative_text, description, url', 'required'),
			array('jebapp_user_id', 'numerical', 'integerOnly'=>true),
			array('url', 'length', 'max'=>255),
			array('upload_date, modified_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, caption, alternative_text, description, url, upload_date, modified_date, jebapp_user_id', 'safe', 'on'=>'search'),
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
			'jebappUser' => array(self::BELONGS_TO, 'User', 'jebapp_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'caption' => 'Caption',
			'alternative_text' => 'Alternative Text',
			'description' => 'Description',
			'url' => 'Url',
			'upload_date' => 'Upload Date',
			'modified_date' => 'Modified Date',
			'jebapp_user_id' => 'Jebapp User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('alternative_text',$this->alternative_text,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('upload_date',$this->upload_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('jebapp_user_id',$this->jebapp_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Media the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
