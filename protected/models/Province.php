<?php

/**
 * This is the model class for table "province".
 *
 * The followings are the available columns in table 'province':
 * @property integer $provinceId
 * @property string $provinceName
 * @property string $geographyId
 * @property integer $status
 */
class Province extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Province the static model class
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
		return 'province';
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
				'provinceName, geographyId',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly' => true),
			array(
				'provinceName',
				'length',
				'max' => 150),
			array(
				'geographyId',
				'length',
				'max' => 5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'provinceId, provinceName, geographyId, status',
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
			'provinceId' => 'Province',
			'provinceName' => 'Province Name',
			'geographyId' => 'Geography',
			'status' => 'Status',
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

		$criteria->compare('provinceId', $this->provinceId);
		$criteria->compare('provinceName', $this->provinceName, true);
		$criteria->compare('geographyId', $this->geographyId, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	//Custom
	public function getAllProvince()
	{
		$models = $this->findAll('1 order by provinceName');

		$p = array(
			);

		foreach ($models as $model)
		{
			$p[$model->provinceId] = $model->provinceName;
		}

		return $p;
	}

	public function getProvinceName($provinceId)
	{
		$model = $this->findByPk($provinceId);

		return $model->provinceName;
	}

}