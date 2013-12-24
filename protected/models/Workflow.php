<?php

/**
 * This is the model class for table "workflow".
 *
 * The followings are the available columns in table 'workflow':
 * @property string $workflowId
 * @property string $workflowName
 * @property string $employeeId
 * @property string $groupId
 *
 * The followings are the available model relations:
 * @property WorkflowState[] $workflowStates
 * @property WorkflowState[] $workflowStates1
 */
class Workflow extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Workflow the static model class
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
		return 'workflow';
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
				'workflowName',
				'required'),
			array(
				'workflowName',
				'length',
				'max' => 500),
			array(
				'employeeId, groupId',
				'length',
				'max' => 20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'workflowId, workflowName, employeeId, groupId',
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
			'workflowStates' => array(
				self::HAS_MANY,
				'WorkflowState',
				'nextState'),
			'workflowStates1' => array(
				self::HAS_MANY,
				'WorkflowState',
				'currentState'),
			'employee' => array(
				self::BELONGS_TO,
				'Employee',
				'employeeId'),
			'group' => array(
				self::BELONGS_TO,
				'Group',
				'groupId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'workflowId' => 'Workflow',
			'workflowName' => 'Workflow Name',
			'employeeId' => 'Employee',
			'groupId' => 'Employee Group',
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

		$criteria->compare('workflowId', $this->workflowId, true);
		$criteria->compare('workflowName', $this->workflowName, true);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('groupId', $this->groupId, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	//Custom
	public function getAllWorkflow()
	{
		$models = Workflow::model()->findAll();

		$w = array(
			'0' => 'Workflow');

		foreach ($models as $model)
		{
			$w[$model->workflowId] = $model->workflowName;
		}

		return $w;
	}

	public function getNameById($workflowId)
	{
		$workflow = Workflow::model()->find("workflowId =:workflowId", array(
			':workflowId' => $workflowId));
		if (isset($workflow))
		{
			return $workflow->workflowName;
		}
		else
		{
			if ($workflowId == -1)
			{
				return "ไม่แสดงตอนสร้าง";
			}
			else
			{
				return "ไม่มี";
			}
		}
	}

	public function checkCanEditState($currentWorkflowId, $editStates, $documentId)
	{
		$flag = 0;
		if (!empty($editStates))
		{
			$employeeId = Yii::app()->user->id;

			$criteria = new CDbCriteria;
			$criteria->join = "LEFT JOIN group_member gm ON t.groupId = gm.groupId";
			$criteria->condition = "t.workflowId =:workflowId AND (t.employeeId in(:employeeId) OR gm.employeeId in(:employeeId))";
			$criteria->params = array(
				":workflowId" => $currentWorkflowId,
				":employeeId" => $employeeId,
				":employeeId" => $employeeId);
			$result = Workflow::model()->find($criteria);
			if (count($result) > 0)
			{
				$states = explode(",", $editStates);
				if (in_array($currentWorkflowId, $states))
				{
					if ($result->employeeId > 0)
					{
						if ($result->employeeId == $employeeId)
						{
							$flag = 1;
						}
						else
						{
							$flag = 0;
						}
					}
					else if ($result->employeeId == -1)
					{
						$document = Document::model()->findByPk($documentId);
						if ($document->employeeId == $employeeId)
						{
							$flag = 1;
						}
						else
						{
							$flag = 0;
						}
					}
					else
					{
						$flag = 1;
					}
				}
				else
				{
					$flag = 0;
				}
			}
			else
			{
				$states = explode(",", $editStates);
				if (in_array($currentWorkflowId, $states))
				{
					$result = Workflow::model()->find("workflowId=:workflowId", array(
						":workflowId" => $currentWorkflowId));
					if ($result->employeeId == 0 && $result->groupId)
					{
						$document = Document::model()->find("documentId=:documentId", array(
							":documentId" => $documentId));
						if ($employeeId == $document->employeeId)
						{
							$flag = 1;
						}
					}
					else if ($result->employeeId == -1)
					{
						$document2 = Document::model()->findByPk($documentId);
						if ($document2->employeeId == $employeeId)
						{
							$flag = 1;
						}
						else
						{
							$flag = 0;
						}
					}
					else
					{
						$flag = 1;
					}
				}
				else
				{
					$flag = 0;
				}
			}
		}
		return $flag;
	}

	public function checkCanAddState($currentWorkflowId, $addStates, $documentId)
	{
		$flag = 0;
		if (!empty($addStates))
		{
			$employeeId = Yii::app()->user->id;
			$criteria = new CDbCriteria;
			$criteria->join = "LEFT JOIN group_member gm ON t.groupId = gm.groupId";
			$criteria->condition = "t.workflowId =:workflowId AND (t.employeeId in(:employeeId) OR gm.employeeId in(:employeeId))";
			$criteria->params = array(
				":workflowId" => $currentWorkflowId,
				":employeeId" => $employeeId,
				":employeeId" => $employeeId);
			$result = Workflow::model()->find($criteria);
			if (count($result) > 0)
			{
				$states = explode(",", $addStates);
				if (in_array($currentWorkflowId, $states))
				{

					if ($result->employeeId > 0)
					{
						if ($result->employeeId == $employeeId)
						{
							$flag = 1;
						}
						else
						{
							$flag = 0;
						}
					}
					else if ($result->employeeId == -1)
					{
						$document = Document::model()->findByPk($documentId);
						if ($document->employeeId == $employeeId)
						{
							$flag = 1;
						}
						else
						{
							$flag = 0;
						}
					}
					else
					{
						$flag = 1;
					}
				}
				else
				{
					$flag = 0;
				}
			}
			else
			{
				$states = explode(",", $addStates);
				if (in_array($currentWorkflowId, $states))
				{
					$result = Workflow::model()->find("workflowId=:workflowId", array(
						":workflowId" => $currentWorkflowId));
					if ($result->employeeId == 0 && $result->groupId)
					{
						$document = Document::model()->find("documentId=:documentId", array(
							":documentId" => $documentId));
						if ($employeeId == $document->employeeId)
						{
							$flag = 1;
						}
					}
					else if ($result->employeeId == -1)
					{
						$document2 = Document::model()->findByPk($documentId);
						if ($document2->employeeId == $employeeId)
						{
							$flag = 1;
						}
						else
						{
							$flag = 0;
						}
					}
				}
				else
				{
					$flag = 0;
				}
			}
		}
		return $flag;
	}

	public function findEmployeeInCurrentState($employeeId, $currentWorkflowId)
	{
		$criteria = new CDbCriteria;
		$criteria->join = "LEFT JOIN group_member gm ON t.groupId = gm.groupId";
		$criteria->condition = "t.workflowId =:workflowId AND (t.employeeId in(:employeeId) OR gm.employeeId in(:employeeId))";
		$criteria->params = array(
			":workflowId" => $currentWorkflowId,
			":employeeId" => $employeeId,
			":employeeId" => $employeeId);
		$result = $this->findAll($criteria);
		return $result;
	}

}