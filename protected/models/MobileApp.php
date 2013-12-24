<?php

/**
 * This is the model class for table "mobile_app".
 *
 * The followings are the available columns in table 'mobile_app':
 * @property integer $mibileAppId
 * @property integer $status
 * @property string $name
 * @property string $currentVersion
 */
class MobileApp extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MobileApp the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mobile_app';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
				'name, currentVersion',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'name',
				'length',
				'max' => 80),
			array(
				'currentVersion',
				'length',
				'max' => 10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'mibileAppId, status, name, currentVersion',
				'safe',
				'on' => 'search'),
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
			'mobileAppPriv' => array(
				self::HAS_MANY,
				'mobileAppPriv',
				array(
					'mobileAppId' => 'mobileAppId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mibileAppId' => 'Mibile App',
			'status' => 'Status',
			'name' => 'Name',
			'currentVersion' => 'Current Version',
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

		$criteria = new CDbCriteria;

		$criteria->compare('mibileAppId', $this->mibileAppId);
		$criteria->compare('status', $this->status);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('currentVersion', $this->currentVersion, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}