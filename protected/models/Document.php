<?php

/**
 * This is the model class for table "document".
 *
 * The followings are the available columns in table 'document':
 * @property string $documentId
 * @property string $documentCode
 * @property string $documentTypeId
 * @property string $employeeId
 * @property string $createDateTime
 * @property string $updateDateTime
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property StockTransaction $document
 * @property DocumentType $documentType
 */
class Document extends CActiveRecord
{

	public $maxCode;
	public $currentStatus;
	public $statusName;
	public $isFinished;
	//Search
	public $startDate;
	public $endDate;
	public $isOwner;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Document the static model class
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
		return 'document';
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
				'documentCode, documentTypeId, employeeId, createDateTime',
				'required'),
			array(
				'status',
				'numerical',
				'integerOnly'=>true),
			array(
				'documentCode, documentTypeId, employeeId',
				'length',
				'max'=>20),
			array(
				'updateDateTime, isOwner',
				'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'documentId, documentCode, documentTypeId, employeeId, createDateTime, updateDateTime, status, startDate, endDate',
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
				'StockTransaction',
				'documentId'),
			'documentType'=>array(
				self::BELONGS_TO,
				'DocumentType',
				'documentTypeId'),
			'documentWorkflow'=>array(
				self::BELONGS_TO,
				'DocumentWorkflow',
				array(
					'documentId'=>'documentId')),
			'employee'=>array(
				self::BELONGS_TO,
				'Employee',
				'employeeId'),
			'documentItem'=>array(
				self::HAS_MANY,
				'DocumentItem',
				array(
					'documentId'=>'documentId')),
			'documentDocumentTemplateField'=>array(
				self::HAS_MANY,
				'DocumentDocumentTemplateField',
				'documentId'),
			'workflowLog'=>array(
				self::HAS_MANY,
				'WorkflowLog',
				'documentId',
				'order'=>'workflow_log.workflowLogId DESC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentId'=>'เอกสาร',
			'documentCode'=>'เลขที่เอกสาร',
			'documentTypeId'=>'ประเภทเอกสาร',
			'employeeId'=>'พนักงาน',
			'createDateTime'=>'วันที่สร้าง',
			'updateDateTime'=>'วันที่ปรับปรุง',
			'status'=>'สถานะ',
			'creator'=>'ผู้สร้างเอกสาร',
			'waitProcess'=>"รอดำเนินการ"
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

		$criteria->compare('documentId', $this->documentId, true);
		$criteria->compare('t.documentCode', strtoupper($this->documentCode), true);
		$criteria->compare('documentTypeId', $this->documentTypeId, true);
		$criteria->compare('employeeId', $this->employeeId, true);
		$criteria->compare('createDateTime', $this->createDateTime, true);
		$criteria->compare('updateDateTime', $this->updateDateTime, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function searchAdmin()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;
		$criteria->select = "t.documentId , t.documentTypeId , t.documentCode , t.createDateTime , t.employeeId";
		$criteria->join = " LEFT JOIN document_workflow dw ON dw.documentId = t.documentId ";
		$criteria->join .= " LEFT OUTER JOIN group_member gm ON gm.groupId = dw.groupId ";
		$criteria->compare('t.documentCode', strtoupper($this->documentCode), true);
		//$criteria->compare('t.createDateTime', $this->createDateTime, true);
		if(!empty($this->startDate))
			$criteria->compare('t.createDateTime', ">= $this->startDate", true);
		if(!empty($this->endDate))
			$criteria->compare('t.createDateTime', "<= $this->endDate", true);
		if($this->isOwner)
		{
			$criteria->compare('t.employeeId', Yii::app()->user->id);
		}
		$criteria->compare('t.documentTypeId', $this->documentTypeId);
		$criteria->group = 't.documentId';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>50
			),
		));
	}

	public function searchDraft($employeeId)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		if(!isset($employeeId))
		{
			Yii::app()->getController()->redirect(Yii::app()->createUrl("home"));
		}
		$criteria = new CDbCriteria;
		$criteria->join = " LEFT JOIN document_workflow dw ON dw.documentId = t.documentId ";
		$criteria->join .= " LEFT OUTER JOIN group_member gm ON gm.groupId = dw.groupId ";
		$criteria->compare('t.documentCode', strtoupper($this->documentCode), true);
		$criteria->compare('t.documentTypeId', $this->documentTypeId, true);
		//$criteria->compare('t.createDateTime', $this->createDateTime, true);
		if(!empty($this->startDate))
			$criteria->compare('t.createDateTime', ">= $this->startDate", true);
		if(!empty($this->endDate))
			$criteria->compare('t.createDateTime', "<= $this->endDate", true);
		$criteria->addCondition("(dw.employeeId =$employeeId OR gm.employeeId in ($employeeId)) AND dw.currentState = 0 AND t.status = 1 ");

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function searchInbox($employeeId)
	{

		if(!isset($employeeId))
		{
			Yii::app()->getController()->redirect(Yii::app()->createUrl("home"));
		}
		$criteria = new CDbCriteria;
		$criteria->select = "t.documentId , t.documentTypeId , t.documentCode , t.createDateTime , t.employeeId";
		$criteria->join = " LEFT JOIN document_workflow dw ON dw.documentId = t.documentId ";
		$criteria->join .= " LEFT OUTER JOIN group_member gm ON gm.groupId = dw.groupId ";
		$criteria->compare('t.documentCode', strtoupper($this->documentCode), true);
		//$criteria->compare('t.createDateTime', $this->createDateTime, true);
		if(!empty($this->startDate))
			$criteria->compare('t.createDateTime', ">= $this->startDate", true);
		if(!empty($this->endDate))
			$criteria->compare('t.createDateTime', "<= $this->endDate", true);
		$criteria->compare('t.documentTypeId', $this->documentTypeId, true);
		$criteria->addCondition("(dw.employeeId =$employeeId OR gm.employeeId in ($employeeId)) AND dw.currentState != 0 AND t.status = 1");
		//$criteria->params = array(':employeeId' => $employeeId, ':employeeId' => $employeeId);
		$criteria->group = "t.documentId";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function searchOutbox($employeeId)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		if(!isset($employeeId))
		{
			Yii::app()->getController()->redirect(Yii::app()->createUrl("home"));
		}
		$criteria = new CDbCriteria;

		$criteria->join = " JOIN document_workflow dw ON dw.documentId = t.documentId ";
		$criteria->compare('dw.isFinished', 0);
		$criteria->compare('t.documentCode', strtoupper($this->documentCode), true);
		$criteria->compare('t.documentTypeId', $this->documentTypeId, true);
		//$criteria->compare('t.createDateTime', $this->createDateTime, true);
		if(!empty($this->startDate))
			$criteria->compare('t.createDateTime', ">= $this->startDate", true);
		if(!empty($this->endDate))
			$criteria->compare('t.createDateTime', "<= $this->endDate", true);
		$criteria->compare('t.employeeId', $employeeId);
		$criteria->compare('t.documentTypeId', $this->documentTypeId, true);
		$criteria->compare('dw.currentState', "<> 0");
		$criteria->compare('t.status', 1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function searchHistory($employeeId)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		if(!isset($employeeId))
		{
			Yii::app()->getController()->redirect(Yii::app()->createUrl("home"));
		}
		$criteria = new CDbCriteria;
		$criteria->select = 'wfl.createDateTime, t.documentTypeId, t.documentCode, t.documentId ,dw.isFinished as isFinished , t.employeeId ';
		$criteria->join = "INNER JOIN workflow_log wfl ON wfl.documentId = t.documentId ";
		$criteria->join .= " LEFT OUTER JOIN group_member gm ON gm.groupId = wfl.groupId ";
		$criteria->join .= " JOIN document_workflow dw ON dw.documentId = t.documentId ";
		$criteria->addCondition("(wfl.employeeId =$employeeId OR gm.employeeId in ($employeeId)) AND t.status = 1");
		$criteria->compare('t.documentCode', strtoupper($this->documentCode), true);
		//$criteria->compare('wfl.employeeId', $employeeId);
		$criteria->compare('documentTypeId', $this->documentTypeId);
		if(!empty($this->startDate))
			$criteria->compare('t.createDateTime', ">= $this->startDate", true);
		if(!empty($this->endDate))
			$criteria->compare('t.createDateTime', "<= $this->endDate", true);

		if($this->isOwner)
		{
			$criteria->compare('t.employeeId', Yii::app()->user->id);
		}
		$criteria->group = 'wfl.documentId';
		$criteria->order = 'wfl.createDateTime DESC ,t.documentCode DESC';

		if(isset($this->startDate) && isset($this->endDate))
			$criteria->addBetweenCondition('DATE(wfl.createDateTime)', $this->startDate, $this->endDate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.createDateTime DESC',
			),
			'pagination'=>array(
				'pageSize'=>30
			),
		));
	}

	public function findMaxCode($documentmentType)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->select = 'max(RIGHT(documentCode,4)) as maxCode';
		$criteria->compare("documentTypeId", $documentmentType->documentTypeId);

		$result = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
		return $result->data[0]->maxCode;
	}

	public function findAllFieldByDocumentId($documentId)
	{
		$criteria = new CDbCriteria;
		$criteria->join = "LEFT JOIN document_document_template_field df ON df.documentId = t.documentId";
		$criteria->compare("t.document_id", $documentId);

		$result = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function findCurrentStatusByDocumentId($documentId)
	{
		$criteria = new CDbCriteria;
		$criteria->select = "w.workflowName as currentStatus , ws2.workflowStatusName as statusName";
		$criteria->join = " LEFT JOIN workflow_log wl ON wl.documentId = t.documentId ";
		$criteria->join .= " LEFT JOIN workflow_state ws ON ws.workflowStateId = wl.workflowStateId ";
		$criteria->join .= " LEFT JOIN workflow w ON w.workflowId = ws.currentState ";
		$criteria->join .= " LEFT JOIN workflow_status ws2 ON ws2.workflowStatusId = ws.workflowStatusId ";
		$criteria->compare("t.documentId", $documentId);
		//$criteria->condition = "wl.workflowLogId is not null";
		$criteria->order = "wl.workflowLogId DESC";

		$result = $this->findAll($criteria);

		//throw new Exception($result[0]->statusName);
		return $result[0];
	}

	public function getAllSubView()
	{
		$basePath = Yii::app()->basePath;
		//$items['subView'] = $this->getAllSubViewInPath($basePath.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'document');
		//$items['modules'] = $this->getControllersInModules($basePath);
		//return $items;
		return $this->getAllSubViewInPath($basePath . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'document');
	}

	protected function getAllSubViewInPath($path)
	{
		//$path = Yii::app()->basePath.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'document';
		//$items['controllers'] = $this->getControllersInPath($basePath);
		$subViews = array(
			);
		$subViews[null] = "Choose..";
		if(file_exists($path) === true)
		{
			$controllerDirectory = scandir($path);
			foreach($controllerDirectory as $entry)
			{
				if(substr($entry, 0, 3))
				{
					$entryPath = $path . DIRECTORY_SEPARATOR . $entry;
					if(strpos(strtolower($entry), 'sub') !== false)
					{
						$name = substr($entry, 3, -4);
						/* $subViews[ strtolower($name) ] = array(
						  'name'=>$name,
						  'file'=>$entry,
						  'path'=>$entryPath,
						  ); */
						//$subViews[ strtolower($name) ] = $name;
						$subViews["sub" . $name] = $name;
					}

					/* if( is_dir($entryPath)===true )
					  foreach( $this->getAllSubViewInPath($entryPath) as $subViewName=>$subview )
					  $subViews[ $subViewName ] = $subview; */
				}
			}
		}
		else
		{
			throw new Exception("The path is not existing!!");
		}
		return $subViews;
	}

	public function findDocumentByDocumentCode($documentTypeCodePrefix, $today = null)
	{
		$criteria = new CDbCriteria();
		$criteria->join = "LEFT JOIN document_type dt ON t.documentTypeId = dt.documentTypeId ";
		$criteria->condition = "dt.documentCodePrefix = :documentCodePrefix AND t.employeeId = :employeeId";
		if(isset($today))
		{
			$criteria->condition .= " AND t.createDateTime >= CURDATE() ";
		}
		$criteria->params = array(
			":documentCodePrefix"=>$documentTypeCodePrefix,
			":employeeId"=>Yii::app()->user->id);
		$criteria->order = "t.createDateTime DESC";

		$result = $this->findAll($criteria);
		if(count($result) > 0)
		{
			return $result;
		}
		else
		{
			return null;
		}
	}

	public function behaviors()
	{
		return array(
			'ERememberFiltersBehavior'=>array(
				'class'=>'application.components.ERememberFiltersBehavior',
				'defaults'=>array(
				),
				/* optional line */
				'defaultStickOnClear'=>false /* optional line */
			),);
	}

}
