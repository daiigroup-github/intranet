<?php

/**
 * This is the model class for table "document_template_field".
 *
 * The followings are the available columns in table 'document_template_field':
 * @property string $documentTemplateFieldId
 * @property string $documentTemplateFieldName
 * @property integer $status
 * @property string $createDateTime
 *
 * The followings are the available model relations:
 * @property DocumentDocumentTemplateField[] $documentDocumentTemplateFields
 */
class DocumentTemplateField extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentTemplateField the static model class
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
		return 'document_template_field';
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
				'documentTemplateFieldName , status, createDateTime',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'documentTemplateFieldName',
				'length',
				'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'documentTemplateFieldId, documentTemplateFieldName , status, createDateTime',
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
			'documentDocumentTemplateFields'=>array(
				self::HAS_MANY,
				'DocumentDocumentTemplateField',
				'documentTemplateFieldId'),
			'documentTemplate'=>array(
				self::HAS_MANY,
				'DocumentTemplate',
				array(
					'documentTemplateFieldId'=>'documentTemplateFieldId')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentTemplateFieldId'=>'Document Template Field',
			'documentTemplateFieldName'=>'ชื่อฟิลด์',
			'status'=>'Status',
			'createDateTime'=>'Create Date Time',
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

		$criteria->compare('documentTemplateFieldId', $this->documentTemplateFieldId, true);
		$criteria->compare('documentTemplateFieldName', $this->documentTemplateFieldName, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('createDateTime', $this->createDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>20
			),
		));
	}

	public function getAllDocumentTemplateField()
	{
		$models = DocumentTemplateField::model()->findAll();

		$w = array(
			''=>'Choose..');

		foreach($models as $model)
		{
			$w[$model->documentTemplateFieldId] = $model->documentTemplateFieldName;
		}

		return $w;
	}

}
