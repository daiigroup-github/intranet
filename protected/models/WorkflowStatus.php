<?php

/**
 * This is the model class for table "workflow_status".
 *
 * The followings are the available columns in table 'workflow_status':
 * @property string $workflowStatusId
 * @property string $workflowStatusName
 * @property string $workflowStatusGroup
 */
class WorkflowStatus extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WorkflowStatus the static model class
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
		return 'workflow_status';
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
				'workflowStatusName',
				'required'),
			array(
				'workflowStatusName',
				'length',
				'max'=>80),
			array(
				'workflowStatusGroup',
				'length',
				'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'workflowStatusId, workflowStatusName, workflowStatusGroup',
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
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'workflowStatusId'=>'สถานะ Workflow',
			'workflowStatusName'=>'ชื่อ สถานะ Workflow',
			'workflowStatusGroup'=>'กลุ่ม สถานะ Workflow',
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

		$criteria->compare('workflowStatusId', $this->workflowStatusId, true);
		$criteria->compare('workflowStatusName', $this->workflowStatusName, true);
		$criteria->compare('workflowStatusGroup', $this->workflowStatusGroup, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	//Custom
	public function getAllWorkflowStatus()
	{
		$models = WorkflowStatus::model()->findAll();

		$w = array(
			''=>'Workflow Status');

		foreach($models as $model)
		{
			$w[$model->workflowStatusId] = $model->workflowStatusName;
		}

		return $w;
	}

}
