<?php

/**
 * This is the model class for table "workflow_group".
 *
 * The followings are the available columns in table 'workflow_group':
 * @property string $workflowGroupId
 * @property string $workflowGroupName
 */
class WorkflowGroup extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WorkflowGroup the static model class
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
		return 'workflow_group';
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
				'workflowGroupName',
				'required'),
			array(
				'workflowGroupName',
				'length',
				'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'workflowGroupId, workflowGroupName',
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
			'workflowState'=>array(
				self::HAS_MANY,
				'WorkflowState',
				'workflowGroupId',
				'order'=>'ordered'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'workflowGroupId'=>'Workflow Group',
			'workflowGroupName'=>'Group Name',
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

		$criteria->compare('workflowGroupId', $this->workflowGroupId, true);
		$criteria->compare('workflowGroupName', $this->workflowGroupName, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAllWorkflowGroup()
	{
		$models = WorkflowGroup::model()->findAll();

		$w = array(
			''=>'Choose..');

		foreach($models as $model)
		{
			$w[$model->workflowGroupId] = $model->workflowGroupName;
		}

		return $w;
	}

	public function calEstimateHour($day, $hour)
	{
		$estimateHour = 0;
		if(isset($day) && intval($day) > 0)
		{
			$estimateHour += $day * 24;
		}
		if(isset($hour) && intval($hour) > 0)
		{
			$estimateHour +=$hour;
		}

		return $estimateHour;
	}

	public function getEstimateHourArray($estimateHour)
	{
		$day = 0;
		$hour = 0;
		$result = array();
		if(isset($estimateHour))
		{
			$day = floor($estimateHour / 24);
			$hour = $estimateHour % 24;
			$result["day"] = $day;
			$result["hour"] = $hour;
		}
		else
		{
			$result["day"] = 0;
			$result["hour"] = 0;
		}

		return $result;
	}

	public function getHourToWork($workflowState, $documentId)
	{
		$hourTowork = array();
		$hour = $workflowState->estimateHour;
//		$beforeState = WorkflowState::model()->find("workflowGroupId = :workflowGroupId AND nextState=:nextState", array(
//			":workflowGroupId"=>$workflowState->workflowGroupId,
//			":nextState"=>$workflowState->currentState));
		$lastWorkflowLog = WorkflowLog::model()->find("documentId = :documentId ORDER BY workflowLogId DESC", array(
			":documentId"=>$documentId));
		$hourDiff = ((strtotime(date("Y-m-d H:i:s")) - strtotime(isset($lastWorkflowLog) ? $lastWorkflowLog->createDateTime : date("Y-m-d H:i:s"))) / 60) / 60;
		if($hourDiff <= 0)
		{
			$hourTowork["hourToWork"] = 0;
		}
		else
		{
			$hourTowork["hourToWork"] = ceil($hourDiff);
		}
		if($hourDiff > $hour)
		{
			$hourTowork["isOverEstimate"] = 1;
		}
		else
		{
			$hourTowork["isOverEstimate"] = 0;
		}

		return $hourTowork;
	}

}
