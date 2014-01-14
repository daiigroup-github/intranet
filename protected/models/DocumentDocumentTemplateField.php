<?php

/**
 * This is the model class for table "document_document_template_field".
 *
 * The followings are the available columns in table 'document_document_template_field':
 * @property string $id
 * @property string $documentId
 * @property string $documentTemplateFieldId
 * @property string $value
 */
class DocumentDocumentTemplateField extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentDocumentTemplateField the static model class
	 */
	public $errorText;
	public $oldFieldFile;

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'document_document_template_field';
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
				'documentId, documentTemplateFieldId, value',
				'required'),
			array(
				'documentId, documentTemplateFieldId',
				'length',
				'max' => 20),
			array(
				'value',
				'length',
				'max' => 2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, documentId, documentTemplateFieldId, value',
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'documentId' => 'Document',
			'documentTemplateFieldId' => 'Document Template Field',
			'value' => 'Value',
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
		$criteria->compare('documentId', $this->documentId, true);
		$criteria->compare('documentTemplateFieldId', $this->documentTemplateFieldId, true);
		$criteria->compare('value', $this->value, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

}

