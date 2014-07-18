<?php

/**
 * This is the model class for table "workflow_log".
 *
 * The followings are the available columns in table 'workflow_log':
 * @property string $workflowLogId
 * @property string $documentId
 * @property string $workflowStateId
 * @property string $employeeId
 * @property string $groupId
 * @property string $createDateTime
 * @property string $remarks
 * @property integer $estimateHour
 * @property integer $numHour
 * @property integer $isOverEstimate
 */
class WorkflowLogMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'workflow_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentId, workflowStateId, employeeId, remarks, estimateHour, isOverEstimate', 'required'),
			array('estimateHour, numHour, isOverEstimate', 'numerical', 'integerOnly'=>true),
			array('documentId, workflowStateId, employeeId, groupId', 'length', 'max'=>20),
			array('createDateTime', 'safe'),
			array('createDateTime', 'default', 'value'=>new CDbExpression('NOW()'), 'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('workflowLogId, documentId, workflowStateId, employeeId, groupId, createDateTime, remarks, estimateHour, numHour, isOverEstimate', 'safe', 'on'=>'search'),
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
			'workflowLogId' => 'Workflow Log',
			'documentId' => 'Document',
			'workflowStateId' => 'Workflow State',
			'employeeId' => 'Employee',
			'groupId' => 'Group',
			'createDateTime' => 'Create Date Time',
			'remarks' => 'Remarks',
			'estimateHour' => 'Estimate Hour',
			'numHour' => 'Num Hour',
			'isOverEstimate' => 'Is Over Estimate',
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
		$criteria->compare('LOWER(documentId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(workflowStateId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(employeeId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(groupId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(createDateTime)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(remarks)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('estimateHour',$this->estimateHour);
		$criteria->compare('numHour',$this->numHour);
		$criteria->compare('isOverEstimate',$this->isOverEstimate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WorkflowLogMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
