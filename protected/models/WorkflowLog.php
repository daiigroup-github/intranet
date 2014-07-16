<?php

class WorkflowLog extends WorkflowLogMaster
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
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
				'employee'=>array(
					self::BELONGS_TO,
					'Employee',
					'employeeId'),
				'workflowState'=>array(
					self::BELONGS_TO,
					'WorkflowState',
					'workflowStateId'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return Cmap::mergeArray(parent::attributeLabels(), array(
				'workflowLogId'=>'Workflow Log',
				'documentId'=>'เอกสาร',
				'workflowStateId'=>'Workflow State',
				'employeeId'=>'พนักงาน',
				'groupId'=>'กลุ่ม',
				'createDateTime'=>'วันเวลาสร้าง',
				'remarks'=>'เหตุผล',
				'numHour'=>'ระยะเวลาดำเนินการ'
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	  public function search()
	  {
	  }
	 */
	public function findAllByDocumentId($documentId)
	{
		$criteria = new CDbCriteria();
		/* $criteria->condition = 'documentId=:documentId';
		  $criteria->params = array(':documentId'=>$documentId);

		  $model = $this->findAll($criteria);

		  return $model; */
		$criteria->compare('documentId', $documentId);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.workflowLogId DESC',
			),
		));
	}

	public function CanDeleteDocFromWorkflowLog($documentId)
	{
		$criteria = new CDbCriteria;

		$criteria->join = "JOIN workflow_state ws ON ws.workflowStateId = t.workflowStateId ";
		$criteria->condition = "t.documentId =:documentId AND ws.currentState <> 0 ";
		$criteria->params = array(
			":documentId"=>$documentId);

		$result = $this->findAll($criteria);
		if(count($result) > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function saveWorkflowLog($documentId, $workflowStateId, $remarks, $employeeId = NULL, $groupId = NULL)
	{
		$this->isNewRecord = true;

		if(Yii::app() instanceof CWebApplication)
			$employeeId = ($employeeId) ? $employeeId : Yii::app()->user->id;

		$this->documentId = $documentId;
		$this->workflowStateId = $workflowStateId;
		$this->employeeId = $employeeId;
		$this->createDateTime = new CDbExpression('NOW()');
		$this->remarks = $remarks;
		$this->groupId = $groupId;
		$this->workflowLogId = NULL;

		return $this->save();
	}

	public function findLeaveApproveLogByDocumentId($documentId)
	{
		$criteria = new CDbCriteria();
		$criteria->compare("documentId", $documentId);
		$criteria->compare("workflowStateId", 210);
		$criteria->order = "workflowLogId DESC";
		return $this->find($criteria);
	}

	public function findFixtimeApproveLogByDocumentId($documentId)
	{
		$criteria = new CDbCriteria();
		$criteria->compare("documentId", $documentId);
		$criteria->compare("workflowStateId", 216);
		$criteria->order = "workflowLogId DESC";
		return $this->find($criteria);
	}

}
