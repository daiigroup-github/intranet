<?php

/**
 * This is the model class for table "mobile_app_priv".
 *
 * The followings are the available columns in table 'mobile_app_priv':
 * @property string $id
 * @property integer $status
 * @property integer $mobileAppId
 * @property string $employeeId
 * @property string $priv
 */
class MobileAppPriv extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MobileAppPriv the static model class
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
		return 'mobile_app_priv';
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
				'mobileAppId, employeeId, priv',
				'required'),
			array(
				'status, mobileAppId',
				'numerical',
				'integerOnly' => true),
			array(
				'employeeId',
				'length',
				'max' => 10),
			array(
				'priv',
				'length',
				'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, status, mobileAppId, employeeId, priv',
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
			'mobileApp' => array(
				self::BELONGS_TO,
				'MobileApp',
				array(
					'mobileAppId' => 'mobileAppId')),
			'employee' => array(
				self::HAS_ONE,
				'Employee',
				array(
					'employeeId' => 'employeeId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'status' => 'Status',
			'mobileAppId' => 'Mobile App',
			'employeeId' => 'Employee',
			'priv' => 'Priv',
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

		$criteria->compare('id', $this->id, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('mobileAppId', $this->mobileAppId);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('priv', $this->priv, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}