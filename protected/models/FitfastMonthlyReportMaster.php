<?php

/**
 * This is the model class for table "fitfast_monthly_report".
 *
 * The followings are the available columns in table 'fitfast_monthly_report':
 * @property string $fitfastMonthlyReportId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $halfS
 * @property integer $S
 * @property integer $SS
 * @property integer $F
 * @property string $forYear
 * @property integer $month
 * @property double $percent
 * @property integer $type
 */
class FitfastMonthlyReportMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fitfast_monthly_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createDateTime, updateDateTime, forYear, month, type', 'required'),
			array('status, halfS, S, SS, F, month, type', 'numerical', 'integerOnly'=>true),
			array('percent', 'numerical'),
			array('forYear', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fitfastMonthlyReportId, status, createDateTime, updateDateTime, halfS, S, SS, F, forYear, month, percent, type', 'safe', 'on'=>'search'),
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
			'fitfastMonthlyReportId' => 'Fitfast Monthly Report',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
			'halfS' => 'Half S',
			'S' => 'S',
			'SS' => 'Ss',
			'F' => 'F',
			'forYear' => 'For Year',
			'month' => 'Month',
			'percent' => 'Percent',
			'type' => 'Type',
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

		$criteria->compare('fitfastMonthlyReportId',$this->fitfastMonthlyReportId,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);
		$criteria->compare('halfS',$this->halfS);
		$criteria->compare('S',$this->S);
		$criteria->compare('SS',$this->SS);
		$criteria->compare('F',$this->F);
		$criteria->compare('forYear',$this->forYear,true);
		$criteria->compare('month',$this->month);
		$criteria->compare('percent',$this->percent);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FitfastMonthlyReportMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
