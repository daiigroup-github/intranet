<?php

/**
 * This is the model class for table "document_item".
 *
 * The followings are the available columns in table 'document_item':
 * @property string $documentItemId
 * @property string $documentId
 * @property string $documentItemName
 * @property string $file
 * @property string $description
 * @property string $remark
 * @property string $id
 * @property string $value
 * @property string $table
 * @property string $unit
 * @property string $description8
 * @property string $description9
 * @property string $description10
 * @property integer  $status
 * @property integer  $createDateTime
 * @property integer  $updateDateTime
 */
class DocumentItem extends CActiveRecord
{

	/**
	 * status
	 * 1 create
	 * 2 approved
	 * 3 cancel
	 * 4 hr recieve
	 * 5 cancel by system
	 */
	public $input;
	public $image;
	public $control;
	public $startDate;
	public $endDate;
	//public $sumLeaveTime;
	//public $leaveTimeRange;
	public $companyId;
	public $inAround;
	public $isRequire;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentItem the static model class
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
		return 'document_item';
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
				'documentId, documentItemName',
				'required'),
			array(
				'documentId',
				'length',
				'max'=>20),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'documentItemName, file, description, remark, id, value, table, unit, description8, description9, description10',
				'length',
				'max'=>1000),
			array(
				'documentItemId, documentId, documentItemName, file, description, remark, id, value, table, unit, description8, description9, description10, status, createDateTime, updateDateTime',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'documentItemId, documentId, documentItemName, file, description, remark, id, value, table, unit, description8, description9, description10, status, createDateTime, updateDateTime',
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
			'document'=>array(
				self::BELONGS_TO,
				'Document',
				array(
					'documentId'=>'documentId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentItemId'=>'Document Item',
			'documentId'=>'Document',
			'documentItemName'=>'Document Item Name',
			'file'=>'File',
			'description'=>'Description',
			'remark'=>'Remark',
			'id'=>'Id',
			'value'=>'Value',
			'table'=>'Table',
			'unit'=>'Unit',
			'description8'=>'Description8',
			'description9'=>'Description9',
			'description10'=>'Description10',
			'status'=>'สถานะ',
			'createDateTime'=>"วันที่สร้าง",
			'updateDateTime'=>'วันที่แก้ไข'
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

		$criteria->compare('documentItemId', $this->documentItemId, true);
		$criteria->compare('documentId', $this->documentId, true);
		$criteria->compare('documentItemName', $this->documentItemName, true);
		$criteria->compare('file', $this->file, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('remark', $this->remark, true);
		$criteria->compare('id', $this->id, true);
		$criteria->compare('value', $this->value, true);
		$criteria->compare('table', $this->table, true);
		$criteria->compare('unit', $this->unit, true);
		$criteria->compare('description8', $this->description8, true);
		$criteria->compare('description9', $this->description9, true);
		$criteria->compare('description10', $this->description10, true);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAllDocumentItemField()
	{
		//$dbName = Yii::app()->db->getSchema();
		$sql = " SELECT column_name from information_schema.columns
 				where table_name = 'document_item' and table_schema = 'daiichi'";

		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$results = $command->queryAll();


		$w = array(
			''=>'Choose..');

		$i = 0;
		foreach($results as $result)
		{
			if($i > 1)
			{
				$w[$result["column_name"]] = $result["column_name"];
			}
			$i++;
		}

		return $w;
	}

	public function getAllApprovedFixTimeItemByEmployeeId($employeeId, $startDate, $endDate, $inAround = false)
	{
		if($inAround)
		{
			$calendar = Calendar::model()->getSalaryDateOfNow();
			$saralyDay = $calendar->saralyDay;
		}
		$criteria = new CDbCriteria();
		$criteria->select = 't.*';
		$criteria->join = 'LEFT JOIN document d on d.documentId=t.documentId';
		$criteria->join .= " LEFT JOIN workflow_log w on w.documentId = d.documentId AND w.workflowStateId = 216 ";
		$criteria->join .= ' LEFT JOIN document_type dt on d.documentTypeId=dt.documentTypeId';
		$criteria->condition = 'd.employeeId=:employeeId AND dt.documentCodePrefix=:documentCodePrefix AND t.status in (2,4) AND (t.documentItemName BETWEEN :startDate AND :endDate)';
		if($inAround)
		{
			$criteria->condition .= " AND w.createDateTime < DATE_FORMAT(INSERT(convert(now(),char),9,11,'$saralyDay 14:01:00'),'%Y-%m-%d %H:%i:%s')";
		}
		$criteria->params = array(
			':employeeId'=>$employeeId,
			':startDate'=>$startDate,
			':endDate'=>$endDate,
			':documentCodePrefix'=>'ETI');
		$criteria->group = " t.documentItemId ";

		return $this->findAll($criteria);
	}

	public function getWaitApprovedFixTimeItemByEmployeeId($employeeId, $startDate, $endDate)
	{
		$criteria = new CDbCriteria();
		$criteria->select = 't.*';
		$criteria->join = 'LEFT JOIN document d on d.documentId=t.documentId';
		$criteria->join .= ' LEFT JOIN document_type dt on d.documentTypeId=dt.documentTypeId';
		$criteria->condition = 'd.employeeId=:employeeId AND dt.documentCodePrefix=:documentCodePrefix AND t.status in (1,2,3,4) ';
		$criteria->params = array(
			':employeeId'=>$employeeId,
			':documentCodePrefix'=>'ETI');

		if(!empty($startDate) AND empty($endDate))
		{
			$criteria->condition .= " AND (t.documentItemName >= :startDate) ";
			$criteria->params[':startDate'] = $startDate;
		}
		else if(empty($startDate) AND !empty($endDate))
		{
			$criteria->condition .= " AND (t.documentItemName <= :endDate ) ";
			$criteria->params[':endDate'] = $endDate;
		}
		else
		{
			//Do Nothing
		}
		$criteria->order = "t.documentItemName DESC";
		return $this->findAll($criteria);
	}

}
