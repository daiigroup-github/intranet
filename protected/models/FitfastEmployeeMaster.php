<?php

/**
 * This is the model class for table "fitfast_employee".
 *
 * The followings are the available columns in table 'fitfast_employee':
 * @property string $fitfastEmployeeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $employeeId
 * @property integer $halfS
 * @property integer $S
 * @property integer $SS
 * @property integer $F
 * @property string $forYear
 * @property double $percent
 */
class FitfastEmployeeMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fitfast_employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employeeId, forYear', 'required'),
			array('status, halfS, S, SS, F', 'numerical', 'integerOnly'=>true),
			array('percent', 'numerical'),
			array('employeeId', 'length', 'max'=>10),
			array('forYear', 'length', 'max'=>4),
			array('createDateTime, updateDateTime', 'safe'),
			array('createDateTime, updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			array('updateDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fitfastEmployeeId, status, createDateTime, updateDateTime, employeeId, halfS, S, SS, F, forYear, percent, searchText', 'safe', 'on'=>'search'),
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
			'fitfastEmployeeId' => 'Fitfast Employee',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
			'employeeId' => 'Employee',
			'halfS' => 'Half S',
			'S' => 'S',
			'SS' => 'Ss',
			'F' => 'F',
			'forYear' => 'For Year',
			'percent' => 'Percent',
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

		if(isset($this->searchText) && !empty($this->searchText))
		{
			$this->fitfastEmployeeId = $this->searchText;
			$this->status = $this->searchText;
			$this->createDateTime = $this->searchText;
			$this->updateDateTime = $this->searchText;
			$this->employeeId = $this->searchText;
			$this->halfS = $this->searchText;
			$this->S = $this->searchText;
			$this->SS = $this->searchText;
			$this->F = $this->searchText;
			$this->forYear = $this->searchText;
			$this->percent = $this->searchText;
		}

		$criteria->compare('fitfastEmployeeId',$this->fitfastEmployeeId,true, 'OR');
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true, 'OR');
		$criteria->compare('updateDateTime',$this->updateDateTime,true, 'OR');
		$criteria->compare('employeeId',$this->employeeId,true, 'OR');
		$criteria->compare('halfS',$this->halfS);
		$criteria->compare('S',$this->S);
		$criteria->compare('SS',$this->SS);
		$criteria->compare('F',$this->F);
		$criteria->compare('forYear',$this->forYear,true, 'OR');
		$criteria->compare('percent',$this->percent);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FitfastEmployeeMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
