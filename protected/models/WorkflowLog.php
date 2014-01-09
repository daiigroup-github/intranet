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
 */
class WorkflowLog extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WorkflowLog the static model class
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
			//array('documentId, workflowStateId, employeeId', 'required'),
			//array('documentId, workflowStateId, employeeId', 'length', 'max'=>20),
			array(
				'documentId, workflowStateId, employeeId, groupId, createDateTime , remarks',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'workflowLogId, documentId, workflowStateId, employeeId, groupId, createDateTime , remarks',
				'safe',
				'on'=>'search'),
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
			'employee'=>array(
				self::BELONGS_TO,
				'Employee',
				'employeeId'),
			'workflowState'=>array(
				self::BELONGS_TO,
				'WorkflowState',
				'workflowStateId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'workflowLogId'=>'Workflow Log',
			'documentId'=>'เอกสาร',
			'workflowStateId'=>'Workflow State',
			'employeeId'=>'พนักงาน',
			'groupId'=>'กลุ่ม',
			'createDateTime'=>'วันเวลาสร้าง',
			'remarks'=>'เหตุผล'
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

		$criteria->compare('workflowLogId', $this->workflowLogId, true);
		$criteria->compare('documentId', $this->documentId, true);
		$criteria->compare('workflowStateId', $this->workflowStateId, true);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('groupId', $this->groupId, true);
		$criteria->compare('createDateTime', $this->createDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

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
