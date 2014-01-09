<?php

/**
 * This is the model class for table "document_control_data".
 *
 * The followings are the available columns in table 'document_control_data':
 * @property string $documentControlDataId
 * @property string $documentControlDataName
 * @property string $dataModel
 * @property string $dataMethod
 * @property string $fieldId
 * @property string $fieldValue
 */
class DocumentControlData extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentControlData the static model class
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
		return 'document_control_data';
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
				'documentControlDataName',
				'required'),
			array(
				'documentControlDataName',
				'length',
				'max'=>100),
			array(
				'fieldId, fieldValue',
				'length',
				'max'=>200),
			array(
				'dataModel, dataMethod',
				'length',
				'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'documentControlDataId, documentControlDataName, dataModel, dataMethod, fieldId, fieldValue',
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
			'documentControlDataItem'=>array(
				self::HAS_MANY,
				'DocumentControlDataItem',
				'documentControlDataItemId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentControlDataId'=>'Document Control Data',
			'documentControlDataName'=>'ชื่อประเภทของฟิลด์',
			'dataModel'=>'Data Model',
			'dataMethod'=>'Data Method',
			'fieldId'=>'Field Id',
			'fieldValue'=>'Field Value',
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

		$criteria->compare('documentControlDataId', $this->documentControlDataId, true);
		$criteria->compare('documentControlDataName', $this->documentControlDataName, true);
		$criteria->compare('dataModel', $this->dataModel, true);
		$criteria->compare('dataMethod', $this->dataMethod, true);
		$criteria->compare('fieldId', $this->fieldId, true);
		$criteria->compare('fieldValue', $this->fieldValue, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			/* 'sort' => array(
			  'defaultOrder' => 't.createDateTime DESC',
			  ), */
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function getAllDocumentControlData()
	{
		$models = DocumentControlData::model()->findAll();

		$w = array(
			);

		foreach($models as $model)
		{
			$w[$model->documentControlDataId] = $model->documentControlDataName;
		}

		return $w;
	}

}
