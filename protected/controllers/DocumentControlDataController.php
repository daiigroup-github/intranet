<?php

class DocumentControlDataController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/cl2';

	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
			'rights',
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/* public function accessRules()
	  {
	  return array(
	  array('allow',  // allow all users to perform 'index' and 'view' actions
	  'actions'=>array('index','view'),
	  'users'=>array('*'),
	  ),
	  array('allow', // allow authenticated user to perform 'create' and 'update' actions
	  'actions'=>array('create','update'),
	  'users'=>array('@'),
	  ),
	  array('allow', // allow admin user to perform 'admin' and 'delete' actions
	  'actions'=>array('admin','delete'),
	  'users'=>array('admin'),
	  ),
	  array('deny',  // deny all users
	  'users'=>array('*'),
	  ),
	  );
	  } */

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new DocumentControlData;
		$documentControlDataItem = new DocumentControlDataItem();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DocumentControlData']))
		{
			$model->attributes = $_POST['DocumentControlData'];
			/* if($model->save())
			  $this->redirect(array('view','id'=>$model->documentControlDataId)); */
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$flag = 1;
				if($model->save())
				{
					$documentControlDataId = Yii::app()->db->lastInsertID;

					foreach($_POST['DocumentControlDataItem']['documentControlDataItemValue'] as $k=> $v)
					{

						$documentControlDataItem = new DocumentControlDataItem();
						$w = array(
							);
						$documentControlDataItem->documentControlDataId = $documentControlDataId;
						if(isset($_POST['DocumentControlDataItem']['documentControlDataItemUseId'][$k]))
						{
							$w['documentControlDataItemUseId'] = $_POST['DocumentControlDataItem']['documentControlDataItemUseId'][$k];
						}

						$w['documentControlDataItemValue'] = $v;

						$documentControlDataItem->attributes = $w;
						/* if(!$documentControlDataItem->save())
						  {
						  $flag = 0;
						  } */
						$documentControlDataItem->save();
						/* $documentTemplateFieldId = Yii::app()->db->lastInsertID;
						  $documentTemplate = new DocumentTemplate();
						  $documentTemplate->documentTypeId = $documentTypeId;
						  $documentTemplate->documentTemplateFieldId = $documentTemplateFieldId;
						  $documentTemplate->save(); */
					}
					if($flag)
					{
						$transaction->commit();
						$this->redirect(array(
							'index'));
					}
				}
				$transaction->rollback();
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}

		$this->render('create', array(
			'model'=>$model,
			'documentControlDataItem'=>$documentControlDataItem,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$documentControlDataItem = new DocumentControlDataItem();
		$documentControlDataItemOld = null;
		if(empty($model->dataModel))
		{
			$documentControlDataItemOld = DocumentControlDataItem::model()->findAll("documentControlDataId =:documentControlDataId", array(
				":documentControlDataId"=>$id));
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['DocumentControlData']))
		{
			$model->attributes = $_POST['DocumentControlData'];
			if($model->save())
			{
				$documentControlDataId = $id;


				foreach($_POST['DocumentControlDataItem']['documentControlDataItemValue'] as $k=> $v)
				{

					$documentControlDataItem = new DocumentControlDataItem();
					$documentControlDataItem->documentControlDataId = $documentControlDataId;
					$documentControlDataItem->documentControlDataItemValue = $v;
					if(isset($_POST['DocumentControlDataItem']['documentControlDataItemUseId'][$k]))
					{
						$w['documentControlDataItemUseId'] = $_POST['DocumentControlDataItem']['documentControlDataItemUseId'][$k];
					}
					$w['documentControlDataItemValue'] = $v;

					/* if(!$documentControlDataItem->save())
					  {
					  $flag = 0;
					  } */
					$documentControlDataItem->save();
					/* $documentTemplateFieldId = Yii::app()->db->lastInsertID;
					  $documentTemplate = new DocumentTemplate();
					  $documentTemplate->documentTypeId = $documentTypeId;
					  $documentTemplate->documentTemplateFieldId = $documentTemplateFieldId;
					  $documentTemplate->save(); */
				}
				if(isset($_POST['documentControlDataItem']['update']))
				{
					foreach($_POST["documentControlDataItem"]['update']["documentControlDataItemValue"] as $k=> $v)
					{

						$docControlItem = DocumentControlDataItem::model()->findByPk($k);
						if(!empty($v))
						{
							if(isset($_POST['documentControlDataItem']['update']['documentControlDataItemUseId'][$k]))
							{
								$docControlItem->documentControlDataItemUseId = $_POST['documentControlDataItem']['update']['documentControlDataItemUseId'][$k];
							}
							$docControlItem->documentControlDataItemValue = $v;
							$docControlItem->save();
						}
						else
						{
							$docControlItem->delete();
						}
					}
				}

				$this->redirect(array(
					'index'));
			}
		}

		$this->render('update', array(
			'model'=>$model,
			'documentControlDataItem'=>$documentControlDataItem,
			'documentControlDataItemOld'=>$documentControlDataItemOld
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
						'admin'));
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionOldIndex()
	{
		$dataProvider = new CActiveDataProvider('DocumentControlData');
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new DocumentControlData('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocumentControlData']))
			$model->attributes = $_GET['DocumentControlData'];

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = DocumentControlData::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'document-control-data-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
