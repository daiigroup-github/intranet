<?php

/**
 * This is the model class for table "document_control_type".
 *
 * The followings are the available columns in table 'document_control_type':
 * @property string $documentControlTypeId
 * @property string $documentControlTypeName
 */
class DocumentControlType extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentControlType the static model class
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
		return 'document_control_type';
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
				'documentControlTypeName',
				'required'),
			array(
				'documentControlTypeName',
				'length',
				'max' => 100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'documentControlTypeId, documentControlTypeName',
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
			);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentControlTypeId' => 'Document Control Type',
			'documentControlTypeName' => 'ประเภทของฟิลด์',
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

		$criteria->compare('documentControlTypeId', $this->documentControlTypeId, true);
		$criteria->compare('documentControlTypeName', $this->documentControlTypeName, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function getAllDocumentControlType()
	{
		$models = DocumentControlType::model()->findAll();

		$w = array(
			'' => 'Choose..');

		foreach ($models as $model)
		{
			$w[$model->documentControlTypeId] = $model->documentControlTypeName;
		}

		return $w;
	}

}