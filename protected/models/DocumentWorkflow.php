<?php

/**
 * This is the model class for table "document_workflow".
 *
 * The followings are the available columns in table 'document_workflow':
 * @property string $documentWorkflowId
 * @property string $documentId
 * @property string $currentState
 * @property string $documentGroupId
 * @property integer $isFinished
 * @property string $employeeId
 * @property string $groupId
 * @property string $createDateTime

 */
class DocumentWorkflow extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentWorkflow the static model class
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
		return 'document_workflow';
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
				'documentId, currentState, createDateTime',
				'required'),
			array(
				'isFinished',
				'numerical',
				'integerOnly' => true),
			array(
				'documentId, currentState, documentGroupId, employeeId, groupId',
				'length',
				'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'documentWorkflowId, documentId, currentState, documentGroupId, isFinished, employeeId, groupId, createDateTime',
				'safe',
				'on' => 'search'),);
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
			'document' => array(
				self::BELONGS_TO,
				'Document',
				'documentId'),
			'employee' => array(
				self::BELONGS_TO,
				'Employee',
				'employeeId'),);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentWorkflowId' => 'Document Work Flow',
			'documentId' => 'Document',
			'currentState' => 'Current State',
			'documentGroupId' => 'Document Group',
			'isFinished' => 'Is Finished',
			'employeeId' => 'Employee',
			'groupId' => 'Group',
			'createDateTime' => 'Create Date Time',);
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

		$criteria->compare('documentWorkflowId', $this->documentWorkFlowId, true);
		$criteria->compare('documentId', $this->documentId, true);
		$criteria->compare('currentState', $this->currentState, true);
		$criteria->compare('documentGroupId', $this->documentGroupId, true);
		$criteria->compare('isFinished', $this->isFinished);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('groupId', $this->groupId, true);
		$criteria->compare('createDateTime', $this->createDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,));
	}

	public function saveDocumentWorkflow($documentType, $documentId, $leaveType = 0)
	{
		//new record
		$this->isNewRecord = true;

		//save document_workflow : documentId, currentState, docuemntGroupId
		$workflowStates = $documentType->workflowGroup->workflowState;

		if ($workflowStates[0]->currentState == 0 && $workflowStates[0]->nextState == 0)
		{
			$this->currentState = 0;
			$this->employeeId = Yii::app()->user->id;
			$this->groupId = null;
			$this->isFinished = 0;
		}
		else
		{
			$this->currentState = $workflowStates[0]->nextState;

			if ($workflowStates[0]->nextState == 0)
			{
				$this->isFinished = 1;
			}

			if (isset($workflowStates[0]->workflowNext->employeeId))
			{
				if ($workflowStates[0]->workflowNext->employeeId != 0)
				{
					if ($leaveType == 2 || $leaveType == 3)
					{
						$tm = Employee::model()->find("username ='tm' ");
						$this->employeeId = $tm->employeeId;
					}
					else
					{
						$this->employeeId = $workflowStates[0]->workflowNext->employeeId;
					}
				}
				else
				{
					if ($workflowStates[0]->workflowNext->groupId == 0)
					{
						$employee = Employee::model()->findByPk(Yii::app()->user->id);

						if ($employee->level->level >= 7 || $employee->username == "nsy" || $employee->username == "nmk")
						{
							if ($leaveType == 2 || $leaveType == 3)
							{
								$tm = Employee::model()->find("username ='tm' ");
								$this->employeeId = $tm->employeeId;
							}
							else
							{
								$this->employeeId = Yii::app()->user->id;
							}
						}
						else
						{
							$this->employeeId = $employee->managerId;
						}
					}
				}
			}

			if ($workflowStates[0]->workflowNext->groupId != 0)
			{
				$this->groupId = $workflowStates[0]->workflowNext->groupId;
			}
			else
			{
				$this->groupId = null;
			}
		}

		$this->createDateTime = new CDbException('NOW()');
		$this->documentId = $documentId;

		//Controller::writeToFile('/tmp/leaves', print_r($documentId, true));

		return $this->save();
	}

	public function updateDocumentWorkflowByWorkflowStatusModelAndDocumentId($workflowStateModel, $documentId)
	{
		$documentModel = Document::model()->findByPk($documentId);
		$documentWorkflowModel = $documentModel->documentWorkflow;
		Controller::writeToFile('/tmp/dwf0', 'dwf1');

		//Draft State
		if ($workflowStateModel->currentState == 0 && $workflowStateModel->nextState == 0)
		{
			$documentWorkflowModel->currentState = 0;
			$documentWorkflowModel->employeeId = $documentModel->employeeId;
			$documentWorkflowModel->groupId = null;
			$documentWorkflowModel->isFinished = 0;
		}
		else
		{
			if (isset($workflowStateModel->nextState))
			{
				//Finish
				if ($workflowStateModel->nextState == 0)
				{
					Controller::writeToFile('/tmp/dwf1', 'dwf1');
					$documentWorkflowModel->isFinished = 1;
					$documentWorkflowModel->currentState = 0;
					$documentWorkflowModel->employeeId = null;
					$documentWorkflowModel->groupId = null;
				}
				else
				{
					$documentWorkflowModel->currentState = $workflowStateModel->nextState;
				}
			}

			$documentWorkflowModel->createDateTime = new CDbExpression('NOW()');

			if (isset($workflowStateModel->workflowNext))
			{
				Controller::writeToFile('/tmp/dwf2', 'dwf2');
				//find employee or group
				if ($workflowStateModel->workflowNext->employeeId > 0)
				{
					$documentWorkflowModel->employeeId = $workflowStateModel->workflowNext->employeeId;
					if ($workflowStateModel->workflowNext->groupId > 0)
					{
						$documentWorkflowModel->groupId = $workflowStateModel->workflowNext->groupId;
					}
					else
					{
						$documentWorkflowModel->groupId = null;
					}
				}
				//back to doc creator
				else if ($workflowStateModel->workflowNext->employeeId == -1)
				{
					$documentWorkflowModel->employeeId = $documentModel->employeeId;
					$documentWorkflowModel->groupId = null;
					if ($workflowStateModel->workflowNext->groupId > 0)
					{
						$documentWorkflowModel->groupId = $workflowStateModel->workflowNext->groupId;
					}
					else
					{
						$documentWorkflowModel->groupId = null;
					}
				}
				else
				{
					//division manager
					if ($workflowStateModel->workflowNext->groupId == 0)
					{
						$employee = Employee::model()->findByPk(Yii::app()->user->id);

						if ($employee->level->level >= 7 || $employee->username == "nsy" || $employee->username == "nmk")
						{
							$documentWorkflowModel->employeeId = Yii::app()->user->id;
						}
						else
						{
							$documentWorkflowModel->employeeId = $documentModel->employee->managerId;
						}
						$documentWorkflowModel->groupId = null;
					}
					else
					{
						$documentWorkflowModel->employeeId = null;
						$documentWorkflowModel->groupId = $workflowStateModel->workflowNext->groupId;
					}
				}
			}
		}

		return $documentWorkflowModel->save();
	}

}
