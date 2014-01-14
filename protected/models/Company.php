<?php

/**
 * This is the model class for table "company".
 *
 * The followings are the available columns in table 'company':
 * @property integer $companyId
 * @property integer $status
 * @property integer $companyValue
 * @property string $companyNameTh
 * @property string $companyNameEn
 */
class Company extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Company the static model class
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
		return 'company';
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
				'companyValue, companyNameTh, companyNameEn',
				'required'),
			array(
				'status, companyValue',
				'numerical',
				'integerOnly' => true),
			array(
				'companyNameTh, companyNameEn',
				'length',
				'max' => 200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'companyId, status, companyValue, companyNameTh, companyNameEn',
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
			'companyId' => 'Company',
			'status' => 'Status',
			'companyValue' => 'Company Value',
			'companyNameTh' => 'Company Name Th',
			'companyNameEn' => 'Company Name En',
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

		$criteria->compare('companyId', $this->companyId);
		$criteria->compare('status', $this->status);
		$criteria->compare('companyValue', $this->companyValue);
		$criteria->compare('companyNameTh', $this->companyNameTh, true);
		$criteria->compare('companyNameEn', $this->companyNameEn, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	//Custom
	public function getAllCompany()
	{
		$c = new Company;

		$models = $c->findAll(array(
			'condition' => 'status=1',
			'order' => 'companyNameTh',
		));

		$company = array(
			'' => '- บริษัท');

		foreach ($models as $model)
		{
			$company[$model->companyId] = $model->companyNameTh;
		}

		return $company;
	}

	public function getAllCompanyHaveEmployee()
	{
		$c = new Company;

		$models = $c->findAll(array(
			'condition' => 'status=1',
			'order' => 'companyNameTh',
		));

		$company = array(
			'' => 'ทุกบริษัท');

		foreach ($models as $model)
		{
			$employee = Employee::model()->find("companyId =:companyId AND status = 1", array(
				":companyId" => $model->companyId));
			if (count($employee) > 0)
			{
				$company[$model->companyId] = $model->companyNameTh;
			}
		}

		return $company;
	}

	public function getAllCompantHaveStockTransaction($month)
	{
		$criteria = new CDbCriteria();
		$criteria->join = " LEFT JOIN stock s ON s.companyId = t.companyId ";
		$criteria->join .= " RIGHT JOIN stock_transaction st ON st.stockId = s.stockId ";
		$criteria->compare('MONTH(s.createDateTime)', "<=" . $month);
		$criteria->group .= "s.companyId";

		return $this->findAll($criteria);
	}

}

