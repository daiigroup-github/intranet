<?php

/**
 * This is the model class for table "workflow_state".
 *
 * The followings are the available columns in table 'workflow_state':
 * @property string $workflowStateId
 * @property string $workflowStateName
 * @property string $currentState
 * @property string $nextState
 * @property string $workflowStatusId
 * @property string $workflowGroupId
 * @property integer $requireConfirm
 * @property integer $ordered
 * @property integer $estimateHour
 */
class WorkflowStateMaster extends MasterCActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'workflow_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('workflowStateName, currentState, workflowStatusId, workflowGroupId, ordered', 'required'),
			array('requireConfirm, ordered, estimateHour', 'numerical', 'integerOnly'=>true),
			array('workflowStateName', 'length', 'max'=>80),
			array('currentState, nextState, workflowStatusId, workflowGroupId', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('workflowStateId, workflowStateName, currentState, nextState, workflowStatusId, workflowGroupId, requireConfirm, ordered, estimateHour', 'safe', 'on'=>'search'),
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
			'workflowStateId' => 'Workflow State',
			'workflowStateName' => 'Workflow State Name',
			'currentState' => 'Current State',
			'nextState' => 'Next State',
			'workflowStatusId' => 'Workflow Status',
			'workflowGroupId' => 'Workflow Group',
			'requireConfirm' => 'Require Confirm',
			'ordered' => 'Ordered',
			'estimateHour' => 'Estimate Hour',
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
		$criteria->compare('LOWER(workflowStateName)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(currentState)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(nextState)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(workflowStatusId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('LOWER(workflowGroupId)',strtolower($this->searchText),true, 'OR');
		$criteria->compare('requireConfirm',$this->requireConfirm);
		$criteria->compare('ordered',$this->ordered);
		$criteria->compare('estimateHour',$this->estimateHour);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WorkflowStateMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
