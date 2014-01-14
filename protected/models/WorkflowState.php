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
 */
class WorkflowState extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WorkflowState the static model class
	 */
	public $ownerPwd;
	public $staffPwd;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

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
			array(
				'workflowStateName, currentState, workflowStatusId, workflowGroupId',
				'required'),
			array(
				'requireConfirm, ordered',
				'numerical',
				'integerOnly' => true),
			array(
				'workflowStateName',
				'length',
				'max' => 80),
			array(
				'currentState, nextState, workflowStatusId, workflowGroupId',
				'length',
				'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'workflowStateId, workflowStateName, currentState, nextState, workflowStatusId, workflowGroupId, requireConfirm',
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
			'workflowCurrent' => array(
				self::BELONGS_TO,
				'Workflow',
				'currentState'),
			'workflowNext' => array(
				self::BELONGS_TO,
				'Workflow',
				'nextState'),
			'workflowStatus' => array(
				self::BELONGS_TO,
				'WorkflowStatus',
				array(
					'workflowStatusId' => 'workflowStatusId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'workflowStateId' => 'ID',
			'workflowStateName' => 'Name',
			'currentState' => 'Current',
			'nextState' => 'Next',
			'workflowStatusId' => 'Status',
			'workflowGroupId' => 'Workflow Group',
			'requireConfirm' => 'Require Confirm',
			'ordered' => 'Order',
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

		$criteria->compare('workflowStateId', $this->workflowStateId, true);
		$criteria->compare('workflowStateName', $this->workflowStateName, true);
		$criteria->compare('currentState', $this->currentState, true);
		$criteria->compare('nextState', $this->nextState, true);
		$criteria->compare('workflowStatusId', $this->workflowStatusId, true);
		//$criteria->compare('workflowGroupId',$this->workflowGroupId,true);
		$criteria->order = 'ordered';

		$criteria->condition = 'workflowGroupId=:workflowGroupId';
		$criteria->params = array(
			':workflowGroupId' => $this->workflowGroupId);

		Controller::writeToFile('/tmp/workflowState', print_r($criteria, true));

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	//custom
	public function getAllWorkflowStatusByCurrentStateAndWorkflowGroupId($currentState, $workflowGroupId, $employeeId, $documentId = null)
	{
		$criteria = new CDbCriteria();
		$criteria->join = "LEFT JOIN workflow_status ws ON t.workflowStatusId = ws.workflowStatusId";
		$criteria->join .= " LEFT JOIN document_workflow dw ON dw.currentState = t.currentState";
		$criteria->condition = 't.currentState=:currentState AND workflowGroupId=:workflowGroupId AND dw.isFinished = 0 AND dw.employeeId =:employeeId ';
		$criteria->params = array(
			':currentState' => $currentState,
			':workflowGroupId' => $workflowGroupId,
			':employeeId' => $employeeId);
		if (isset($documentId))
		{
			$criteria->condition .= " AND dw.documentId =:documentId ";
			$criteria->params[":documentId"] = $documentId;
		}
		$criteria->order = "ws.workflowStatusName ASC";
		$models = $this->findAll($criteria);

		$w = array(
			);

		foreach ($models as $model)
		{
			$w[$model->workflowStatusId] = $model->workflowStatus->workflowStatusName;
		}

		return $w;
	}

	public function getAllWorkflowStatusByCurrentStateAndWorkflowGroupIdAndMemberGroupId($currentState, $workflowGroupId, $employeeId)
	{
		$criteria = new CDbCriteria();
		$criteria->join = "LEFT JOIN workflow_status ws ON t.workflowStatusId = ws.workflowStatusId";
		$criteria->join .= " LEFT JOIN document_workflow dw ON dw.currentState = t.currentState";
		$criteria->join .= " LEFT OUTER JOIN group_member gm ON gm.groupId = dw.groupId";
		$criteria->condition = 't.currentState=:currentState AND workflowGroupId=:workflowGroupId AND dw.isFinished = 0 AND gm.employeeId =:employeeId ';
		$criteria->params = array(
			':currentState' => $currentState,
			':workflowGroupId' => $workflowGroupId,
			':employeeId' => $employeeId);
		$criteria->order = "ws.workflowStatusName ASC";
		$models = $this->findAll($criteria);

		$w = array(
			);

		foreach ($models as $model)
		{
			$w[$model->workflowStatusId] = $model->workflowStatus->workflowStatusName;
		}

		return $w;
	}

	public function getWorkflowStateByCurrentStateAndWrokflowStatusIdAndWorkflowGroupId($currentState, $workflowStatusId, $workflowGroupId)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'currentState=:currentState AND workflowStatusId=:workflowStatusId AND workflowGroupId=:workflowGroupId';
		$criteria->params = array(
			':currentState' => $currentState,
			':workflowStatusId' => $workflowStatusId,
			':workflowGroupId' => $workflowGroupId);

		$model = $this->find($criteria);

		return $model;
	}

	public function getWorkflowStateByCurrentStateAndWorkflowGroupId($currentState, $workflowGroupId)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'currentState=:currentState AND workflowGroupId=:workflowGroupId';
		$criteria->params = array(
			':currentState' => $currentState,
			':workflowGroupId' => $workflowGroupId);

		$model = $this->find($criteria);

		return $model;
	}

	public function getAllStateByWorkflowGroupId($workflowGroupId)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'workflowGroupId=:workflowGroupId';
		$criteria->params = array(
			':workflowGroupId' => $workflowGroupId);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
				'defaultOrder' => 't.ordered ASC , t.workflowStateId ASC',
			),
			'pagination' => array(
				'pageSize' => 30
			),
		));
	}

	public function getWorkflowByWorkflowGroupId($workflowGroupId)
	{
		$models = WorkflowState::model()->findAll('workflowGroupId=:workflowGroupId', array(
			':workflowGroupId' => $workflowGroupId));

		$w = array(
			'0' => '-',
			'-1' => 'ไม่แสดงตอนสร้าง');

		foreach ($models as $model)
		{
			if (isset($model->workflowCurrent))
			{
				$w[$model->currentState] = $model->workflowCurrent->workflowName;
			}
		}

		return $w;
	}

}