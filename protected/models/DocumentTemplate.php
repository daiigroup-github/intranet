<?php

/**
 * This is the model class for table "document_template".
 *
 * The followings are the available columns in table 'document_template':
 * @property string $id
 * @property string $documentTypeId
 * @property string $documentTemplateFieldId
 * @property string $documentControlTypeId
 * @property integer $status
 * @property string $createDateTime
 * @property string $documentControlDataId
 * @property integer $isItem
 * @property string $documentItemField
 * @property string $editState
 * @property string $addState
 * @property string $fieldType
 */
class DocumentTemplate extends CActiveRecord
{

	public $isRequire;
	public $control;
	public $items;
	public $oldStatus;
	public $oldEditState;
	public $oldAddState;
	public $controlTypeName;
	public $oldFieldType;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentTemplate the static model class
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
		return 'document_template';
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
				'documentTypeId, documentTemplateFieldId, documentControlTypeId, status, createDateTime ',
				'required'),
			array(
				'status, isItem, fieldType',
				'numerical',
				'integerOnly' => true),
			array(
				'documentTypeId, documentTemplateFieldId, documentControlTypeId, documentControlDataId',
				'length',
				'max' => 20),
			array(
				'documentItemField',
				'length',
				'max' => 100),
			array(
				'editState, addState',
				'length',
				'max' => 500),
			array(
				'fieldType ',
				'safe',
			),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, documentTypeId, documentTemplateFieldId, documentControlTypeId, status,oldStatus, createDateTime , documentControlDataId, isItem, documentItemField , items, editState, addState',
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
			'documentTemplateField' => array(
				self::BELONGS_TO,
				'DocumentTemplateField',
				'documentTemplateFieldId'),
			'documentType' => array(
				self::BELONGS_TO,
				'DocumentType',
				'documentTypeId'),
			'documentControlType' => array(
				self::BELONGS_TO,
				'DocumentControlType',
				'documentControlTypeId'),
			'documentControlData' => array(
				self::BELONGS_TO,
				'DocumentControlData',
				'documentControlDataId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'documentTypeId' => 'Document Type',
			'documentTemplateFieldId' => 'ชื่อฟิลด์ ',
			'documentControlTypeId' => 'ประเภทของฟิลด์ ',
			'status' => 'สถานะ',
			'createDateTime' => 'Create Date Time',
			'documentControlDataId' => 'ข้อมูลของฟิลด์',
			'isItem' => 'Is Item',
			'documentItemField' => 'ฟิลด์ของ item',
			'editState' => 'State ที่แก้ไขได้',
			'addState' => 'State ที่เพิ่มได้',
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

		$criteria->compare('id', $this->id, true);
		$criteria->compare('documentTypeId', $this->documentTypeId, true);
		$criteria->compare('documentTemplateFieldId', $this->documentTemplateFieldId, true);
		$criteria->compare('documentControlTypeId', $this->documentControlTypeId, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('documentControlDataId', $this->documentControlDataId, true);
		$criteria->compare('isItem', $this->isItem);
		$criteria->compare('documentItemField', $this->documentItemField, true);
		$criteria->compare('editState', $this->editState, true);
		$criteria->compare('addState', $this->editState, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function getDocumentTemplateByTemplateFieldId($documentTemplateFieldId)
	{
		$criteria = new CDbCriteria;
		$criteria->select = "dct.documentControlTypeName as controlTypeName";
		$criteria->join = "LEFT JOIN document_template_field dtf ON dtf.documentTemplateFieldId = t.documentTemplateFieldId";
		$criteria->join .= " LEFT JOIN document_control_type dct ON dct.documentControlTypeIddd = t.documentControlTypeId";
		$criteria->compare("dtf.documentTemplateFieldId", $documentTemplateFieldId);
		$result = $this->find($criteria);

		return $result;
	}

	public function getFieldNameByDocumentTypeIdAndDocumentItemFieldName($documentTypeId, $documentItemFieldName)
	{
		$criteria = new CDbCriteria;
		$criteria->compare("documentTypeId", $documentTypeId);
		$criteria->compare("documentItemField", $documentItemFieldName);
		$criteria->compare("status", 1);

		$result = $this->find($criteria);

		return $result;
	}

	public function FindItemFieldByDocumentTypeId($documentTypeId)
	{
		$criteria = new CDbCriteria;
		$criteria->compare("documentTypeId", $documentTypeId);
		$criteria->compare("isItem", 1);
		$criteria->compare("status", 1);

		$result = $this->find($criteria);

		return $result;
	}

}

