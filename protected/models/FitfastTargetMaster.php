<?php

/**
 * This is the model class for table "fitfast_target".
 *
 * The followings are the available columns in table 'fitfast_target':
 * @property string $fitfastTargetId
 * @property integer $status
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property string $employeeId
 * @property string $fitfastId
 * @property string $target
 * @property string $file
 * @property double $grade
 * @property string $parent
 */
class FitfastTargetMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fitfast_target';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createDateTime, updateDateTime, employeeId, fitfastId, target', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('grade', 'numerical'),
			array('employeeId, fitfastId, parent', 'length', 'max'=>10),
			array('file', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fitfastTargetId, status, createDateTime, updateDateTime, employeeId, fitfastId, target, file, grade, parent', 'safe', 'on'=>'search'),
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
			'fitfastTargetId' => 'Fitfast Target',
			'status' => 'Status',
			'createDateTime' => 'Create Date Time',
			'updateDateTime' => 'Update Date Time',
			'employeeId' => 'Employee',
			'fitfastId' => 'Fitfast',
			'target' => 'Target',
			'file' => 'File',
			'grade' => 'Grade',
			'parent' => 'Parent',
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

		$criteria->compare('fitfastTargetId',$this->fitfastTargetId,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);
		$criteria->compare('employeeId',$this->employeeId,true);
		$criteria->compare('fitfastId',$this->fitfastId,true);
		$criteria->compare('target',$this->target,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('grade',$this->grade);
		$criteria->compare('parent',$this->parent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FitfastTargetMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
