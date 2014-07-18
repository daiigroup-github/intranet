<?php

class WorkflowState extends WorkflowStateMaster
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public $ownerPwd;
	public $staffPwd;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return CMap::mergeArray(parent::rules(), array(
				//code here
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return CMap::mergeArray(parent::relations(), array(
				//code here
				'workflowCurrent'=>array(
					self::BELONGS_TO,
					'Workflow',
					'currentState'),
				'workflowNext'=>array(
					self::BELONGS_TO,
					'Workflow',
					'nextState'),
				'workflowStatus'=>array(
					self::BELONGS_TO,
					'WorkflowStatus',
					array(
						'workflowStatusId'=>'workflowStatusId')),
				'workflowGroup'=>array(
					self::BELONGS_TO,
					'WorkflowGroup',
					'workflowGroupId'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Cmap::mergeArray(parent::attributeLabels(), array(
				//code here
				'estimateHour'=>'Next Work Time(hr)'
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	  public function search()
	  {
	  }
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
			':workflowGroupId'=>$this->workflowGroupId);

		Controller::writeToFile('/tmp/workflowState', print_r($criteria, true));

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
			':currentState'=>$currentState,
			':workflowGroupId'=>$workflowGroupId,
			':employeeId'=>$employeeId);
		if(isset($documentId))
		{
			$criteria->condition .= " AND dw.documentId =:documentId ";
			$criteria->params[":documentId"] = $documentId;
		}
		$criteria->order = "ws.workflowStatusName ASC";
		$models = $this->findAll($criteria);

		$w = array(
			);

		foreach($models as $model)
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
			':currentState'=>$currentState,
			':workflowGroupId'=>$workflowGroupId,
			':employeeId'=>$employeeId);
		$criteria->order = "ws.workflowStatusName ASC";
		$models = $this->findAll($criteria);

		$w = array(
			);

		foreach($models as $model)
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
			':currentState'=>$currentState,
			':workflowStatusId'=>$workflowStatusId,
			':workflowGroupId'=>$workflowGroupId);

		$model = $this->find($criteria);

		return $model;
	}

	public function getWorkflowStateByCurrentStateAndWorkflowGroupId($currentState, $workflowGroupId)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'currentState=:currentState AND workflowGroupId=:workflowGroupId';
		$criteria->params = array(
			':currentState'=>$currentState,
			':workflowGroupId'=>$workflowGroupId);

		$model = $this->find($criteria);

		return $model;
	}

	public function getAllStateByWorkflowGroupId($workflowGroupId)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'workflowGroupId=:workflowGroupId';
		$criteria->params = array(
			':workflowGroupId'=>$workflowGroupId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.ordered ASC , t.workflowStateId ASC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function getWorkflowByWorkflowGroupId($workflowGroupId)
	{
		$models = WorkflowState::model()->findAll('workflowGroupId=:workflowGroupId', array(
			':workflowGroupId'=>$workflowGroupId));

		$w = array(
			'0'=>'-',
			'-1'=>'ไม่แสดงตอนสร้าง');

		foreach($models as $model)
		{
			if(isset($model->workflowCurrent))
			{
				$w[$model->currentState] = $model->workflowCurrent->workflowName;
			}
		}

		return $w;
	}

}
