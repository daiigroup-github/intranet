<?php

/**
 * This is the model class for table "document_control_data_item".
 *
 * The followings are the available columns in table 'document_control_data_item':
 * @property string $documentControlDataItemId
 * @property string $documentControlDataId
 * @property string $documentControlDataItemUseId
 * @property string $documentControlDataItemValue
 */
class DocumentControlDataItem extends CActiveRecord
{

	public $oldDocumentControlDataItemUseId;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentControlDataItem the static model class
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
		return 'document_control_data_item';
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
				'documentControlDataId, documentControlDataItemValue',
				'required'),
			array(
				'documentControlDataId, documentControlDataItemUseId, oldDocumentControlDataItemUseId',
				'length',
				'max'=>20),
			array(
				'documentControlDataItemValue',
				'length',
				'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'documentControlDataItemId, documentControlDataId, documentControlDataItemUseId, documentControlDataItemValue, oldDocumentControlDataItemUseId',
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
			'documentControlDataItemId'=>'Document Control Data Item',
			'documentControlDataId'=>'Document Control Data',
			'documentControlDataItemUseId'=>'Document Control Data Use Item',
			'documentControlDataItemValue'=>'Document Control Data Item Value',
			'oldDocumentControlDataItemUseId'=>'Old Document Control Data Use Item',
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

		$criteria->compare('documentControlDataItemId', $this->documentControlDataItemId, true);
		$criteria->compare('documentControlDataId', $this->documentControlDataId, true);
		$criteria->compare('documentControlDataItemUseId', $this->documentControlDataItemUseId, true);
		$criteria->compare('documentControlDataItemValue', $this->documentControlDataItemValue, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findAllItemByDocumentControlDataId($documentControlDataId)
	{
		$criteria = new CDbCriteria();
		$criteria->compare("documentControlDataId", $documentControlDataId);
		return $this->findAll($criteria);
	}

}
