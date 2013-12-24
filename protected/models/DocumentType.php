<?php

/**
 * This is the model class for table "document_type".
 *
 * The followings are the available columns in table 'document_type':
 * @property string $documentTypeId
 * @property string $documentTypeName
 * @property string $documentTypeDescription
 * @property string $documentCodePrefix
 * @property integer $status
 * @property string $workflowGroupId
 * @property string $employeeId
 * @property string $employeeGroupId
 * @property integer $hasItems
 * @property string $itemTable
 * @property string $transactionTable
 * @property string $inMobile
 * @property string $groupId
 * @property string $customView
 * @property string $customAction
 * The followings are the available model relations:
 * @property Document[] $documents
 * @property DocumentTypeAssign[] $documentTypeAssigns
 * @property integer companyDivisionId 
 */
class DocumentType extends CActiveRecord
{

	public $input;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentType the static model class
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
		return 'document_type';
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
				'documentTypeName, status, groupId',
				'required'),
			array(
				'status, hasItems, inMobile, companyDivisionId',
				'numerical',
				'integerOnly' => true),
			array(
				'documentTypeName',
				'length',
				'max' => 500),
			array(
				'customAction',
				'length',
				'max' => 80),
			array(
				'documentTypeDescription',
				'length',
				'max' => 3000),
			array(
				'documentCodePrefix',
				'length',
				'max' => 5),
			array(
				'workflowGroupId, employeeId, employeeGroupId,groupId',
				'length',
				'max' => 20),
			array(
				'itemTable, transactionTable, customView',
				'length',
				'max' => 200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'documentTypeId, documentTypeName, documentTypeDescription, documentCodePrefix, status, workflowGroupId, employeeId, employeeGroupId, hasItems, itemTable, transactionTable, customView, customAction, companyDivisionId',
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
			'documents' => array(
				self::HAS_MANY,
				'Document',
				'documentTypeId'),
			//'documentTypeAssigns' => array(self::HAS_MANY, 'DocumentTypeAssign', 'documentTypeId'),
			'documentTemplate' => array(
				self::HAS_MANY,
				'DocumentTemplate',
				'documentTypeId'),
			'workflowGroup' => array(
				self::BELONGS_TO,
				'WorkflowGroup',
				'workflowGroupId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentTypeId' => 'Document Type',
			'documentTypeName' => 'ชื่อประเภทเอกสาร',
			'documentTypeDescription' => 'รายละเอียด',
			'documentCodePrefix' => 'รหัสนำหน้า เอกสาร',
			'status' => 'สถานะ',
			'workflowGroupId' => 'กลุ่มของ Workflow',
			'employeeId' => 'พนักงาน',
			'employeeGroupId' => 'กลุ่มของพนักงาน',
			'hasItems' => 'Has Items',
			'itemTable' => 'Item Table',
			'transactionTable' => 'Transaction Table',
			'inMobile' => 'In Mobile',
			'groupId' => 'กลุ่มของพนักงาน',
			'customView' => 'customView',
			'customAction' => 'customAction',
			'companyDivisionId' => 'เอกสารของแผนก',
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

		$criteria->compare('documentTypeId', $this->documentTypeId, true);
		$criteria->compare('documentTypeName', $this->documentTypeName, true);
		$criteria->compare('documentTypeDescription', $this->documentTypeDescription, true);
		$criteria->compare('documentCodePrefix', $this->documentCodePrefix, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('workflowGroupId', $this->workflowGroupId, true);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('employeeGroupId', $this->employeeGroupId, true);
		$criteria->compare('hasItems', $this->hasItems);
		$criteria->compare('itemTable', $this->itemTable, true);
		$criteria->compare('transactionTable', $this->transactionTable, true);
		$criteria->compare('inMobile', $this->inMobile, true);
		$criteria->compare('groupId', $this->groupId, true);
		$criteria->compare('customView', $this->customView, true);
		$criteria->compare('customAction', $this->customAction, true);
		$criteria->compare('customAction', $this->companyDivisionId, true);
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 20
			),
		));
	}

	public function searchForCreateDocument($employeeId, $companyDivisionId = null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;
		//$criteria->join = "LEFT JOIN group g on t.groupId = g.group_id ";
		$criteria->join = "LEFT JOIN group_member gm on t.groupId = gm.groupId ";
		$criteria->compare('documentTypeName', $this->documentTypeName, true);
		if (isset($companyDivisionId))
		{
			$criteria->compare('t.companyDivisionId', $companyDivisionId);
		}
		else
		{
			$criteria->condition = "t.companyDivisionId is null";
		}
		$criteria->compare('t.status', 1);
		$criteria->compare("gm.employeeId", $employeeId);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => 10
			),
		));
	}

	public function findFieldbyDocumentTypeId($documentTypeId)
	{
		$criteria = new CDbCriteria;

		$criteria->compare('documentTypeId', $documentTypeId);
		/* $criteria->compare('documentTypeName',$this->documentTypeName,true);
		  $criteria->compare('active',$this->active);
		  $criteria->compare('workflowGroupId',$this->workflowGroupId,true); */

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function getDocumentTypeByid($documentTypeId)
	{
		$pas = array(
			':documentTypeId' => $documentTypeId);
		$criteria = $this->getCommandBuilder()->createCriteria('documentTypeId=:documentTypeId', $pas);
		return $this->query($criteria);
	}

	public function getDocumentTypeByPrefix($prefix)
	{
		$criteria = new CDbCriteria();
		$criteria->compare("documentCodePrefix", $prefix);

		return $this->find($criteria);
	}

	public function getAllDocumentTypeInMobile()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'inMobile=1';
		$criteria->order = 'documentTypeName';

		return $this->findAll($criteria);
	}

	public function getAllDocumentTypeDropdown()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'status=1';
		$criteria->order = 'documentTypeName';

		$w = array(
			);
		foreach ($this->findAll($criteria) as $item)
		{
			$w[$item->documentTypeId] = $item->documentTypeName;
		}

		return $w;
	}

}
