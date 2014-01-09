<?php

/**
 * This is the model class for table "qtech_process".
 *
 * The followings are the available columns in table 'qtech_process':
 * @property string $qtechProcessId
 * @property integer $status
 * @property string $qtechProjectId
 * @property string $processName
 * @property string $processDetail
 * @property string $duration
 */
class QtechProcess extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QtechProcess the static model class
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
		return 'qtech_process';
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
				'processName',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'qtechProjectId, duration',
				'length',
				'max'=>10),
			array(
				'processName',
				'length',
				'max'=>100),
			array(
				'processDetail',
				'length',
				'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'qtechProcessId, status, qtechProjectId, processName, processDetail, duration',
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
			'processSub'=>array(
				self::HAS_MANY,
				'QtechProcessSub',
				array(
					'qtechProcessId'=>'qtechProcessId')),
			'project'=>array(
				self::BELONGS_TO,
				'QtechProject',
				array(
					'qtechProjectId'=>'qtechProjectId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'qtechProcessId'=>'Process',
			'status'=>'Status',
			'qtechProjectId'=>'Project',
			'processName'=>'Process Name',
			'processDetail'=>'Process Detail',
			'duration'=>'Duration',
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

		$criteria->compare('qtechProcessId', $this->qtechProcessId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('qtechProjectId', $this->qtechProjectId, true);
		$criteria->compare('processName', $this->processName, true);
		$criteria->compare('processDetail', $this->processDetail, true);
		$criteria->compare('duration', $this->duration, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}
