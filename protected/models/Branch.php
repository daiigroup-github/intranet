<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 * @property integer $branchId
 * @property integer $status
 * @property string $branchValue
 * @property string $branchName
 * @property string $latitude
 * @property string $longitude
 */
class Branch extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Branch the static model class
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
		return 'branch';
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
				'branchValue, branchName, latitude, longitude',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'branchValue',
				'length',
				'max' => 10),
			array(
				'branchName',
				'length',
				'max' => 120),
			array(
				'latitude, longitude',
				'length',
				'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'branchId, status, branchValue, branchName, latitude, longitude',
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
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'branchId' => 'Branch',
			'status' => 'Status',
			'branchValue' => 'Branch Value',
			'branchName' => 'Branch Name',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
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

		$criteria->compare('branchId', $this->branchId);
		$criteria->compare('status', $this->status);
		$criteria->compare('branchValue', $this->branchValue, true);
		$criteria->compare('branchName', $this->branchName, true);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	//Custom
	public function getAllBranch()
	{
		$b = new Branch;

		$models = $b->findAll(array(
			'condition' => 'status=1',
			'order' => 'branchName',
		));

		$branch = array(
			'' => '- สาขา');

		foreach ($models as $model)
		{
			$branch[$model->branchId] = $model->branchName;
		}

		return $branch;
	}

}