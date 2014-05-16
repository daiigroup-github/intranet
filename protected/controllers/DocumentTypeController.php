<?php

class DocumentTypeController extends Controller
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
		$model = new DocumentType;
		$documentTemplateField = new DocumentTemplateField();
		$documentTemplate = new DocumentTemplate();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DocumentType']))
		{
			$model->attributes = $_POST['DocumentType'];

			if(empty($_POST['DocumentType']['customView']))
			{
				$model->customView = null;
			}
			if(empty($_POST['DocumentType']['customAction']))
			{
				$model->customAction = null;
			}
			//if($model->save())
			//$this->redirect(array('admin','id'=>$model->documentTypeId));

			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$flag = 1;
				if($model->save())
				{
					$documentTypeId = Yii::app()->db->lastInsertID;

					$ii = "";
					foreach($_POST['DocumentTemplate']['documentTemplateFieldId'] as $k=> $v)
					{

//						$documentTemplate = new DocumentTemplate();
//						$w = array();
						$documentTemplate->documentTypeId = $documentTypeId;
						if(!empty($v))
						{
							//$ii .= $k.$v. " - ".$_POST['DocumentTemplate']['documentControlTypeId'][$k]. " - ".$_POST['DocumentTemplate']['documentControlDataId'][$k]. " - ".$_POST['DocumentTemplate']['status'][$k]." || ";
							$w['documentTemplateFieldId'] = $v;
							$w['documentControlTypeId'] = $_POST['DocumentTemplate']['documentControlTypeId'][$k];
							$w['documentControlDataId'] = $_POST['DocumentTemplate']['documentControlDataId'][$k];
							$w['status'] = $_POST['DocumentTemplate']['status'][$k];
							$w['isItem'] = 0;

							if(isset($_POST['DocumentTemplate']['editState'][$k]))
							{
								$w['editState'] = $_POST['DocumentTemplate']['editState'][$k];
							}
							else
							{
								$w['editState'] = "";
							}

							if(isset($_POST['DocumentTemplate']['addtState'][$k]))
							{
								$w['addtState'] = $_POST['DocumentTemplate']['addState'][$k];
							}
							else
							{
								$w['addtState'] = "";
							}
							$date_now = new CDbExpression('NOW()');
							$w['createDateTime'] = $date_now;
							$documentTemplate->attributes = $w;
							//throw new Exception($v);
							if(!$documentTemplate->save())
							{
								throw new Exception(1111);
								$flag = 0;
							}
						}
					}

					//throw new Exception($ii);
					//print_r($_POST['DocumentTemplate']);
					foreach($_POST['DocumentTemplate']['items']['documentTemplateFieldId'] as $k=> $v)
					{

						$documentTemplateItem = new DocumentTemplate();
						$r = array(
							);
						$documentTemplateItem->documentTypeId = $documentTypeId;
						if(!empty($v))
						{
							//$ii .=  $v.= " - ".$_POST['DocumentTemplate']['items']['documentControlTypeId'][$k].= " - ".$_POST['DocumentTemplate']['items']['documentControlDataId'][$k].= " - ".$_POST['DocumentTemplate']['items']['status'][$k]." || ";
							$r['documentTemplateFieldId'] = $v;
							if(isset($_POST['DocumentTemplate']['items']['documentControlTypeId'][$k]))
							{
								$r['documentControlTypeId'] = $_POST['DocumentTemplate']['items']['documentControlTypeId'][$k];
							}
							if(isset($_POST['DocumentTemplate']['items']['documentControlDataId'][$k]))
							{
								$r['documentControlDataId'] = $_POST['DocumentTemplate']['items']['documentControlDataId'][$k];
							}
							$r['isItem'] = 1;
							if(isset($_POST['DocumentTemplate']['items']['status'][$k]))
							{
								$r['status'] = $_POST['DocumentTemplate']['items']['status'][$k];
							}
							if(isset($_POST['DocumentTemplate']['items']['documentItemField'][$k]))
							{
								$r['documentItemField'] = $_POST['DocumentTemplate']['items']['documentItemField'][$k];
							}
							if(isset($_POST['DocumentTemplate']['items']['editState'][$k]))
							{
								$r['editState'] = $_POST['DocumentTemplate']['items']['editState'][$k];
							}
							if(isset($_POST['DocumentTemplate']['items']['addState'][$k]))
							{
								$r['addState'] = $_POST['DocumentTemplate']['items']['addState'][$k];
							}

							$date_now = new CDbExpression('NOW()');
							$r['createDateTime'] = $date_now;
							$documentTemplateItem->attributes = $r;
							if(!$documentTemplateItem->save())
							{
								//throw new Exception(2222);
								$flag = 0;
							}
						}
					}
					//throw new Exception($ii);
					if($flag)
					{
						$transaction->commit();
						$this->redirect(array(
							'index'));
					}
				}
				$transaction->rollback();
				//$this->redirect(array('create'));
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}

		$this->render('create', array(
			'model'=>$model,
			'documentTemplate'=>$documentTemplate,
			'documentTemplateField'=>$documentTemplateField,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout = "//layouts/cl1";
		$documentTemplate = new DocumentTemplate("search");
		$model = $this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DocumentType']))
		{
			$model->attributes = $_POST['DocumentType'];
			if(empty($_POST['DocumentType']['customView']))
			{
				$model->customView = null;
			}
			if(empty($_POST['DocumentType']['customAction']))
			{
				$model->customAction = null;
			}
			$documentTemplate->attributes = $_POST['DocumentTemplate'];
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$flag = 1;
				if($model->save())
				{
					//$documentTypeId = Yii::app()->db->lastInsertID;
					$documentTypeId = $model->documentTypeId;
					$rrr = " ";
					foreach($_POST['DocumentTemplate']['documentTemplateFieldId'] as $k=> $v)
					{
						$rrr.=" : " . $v;
						if(!empty($v))
						{
							$documentTemplate = new DocumentTemplate();
							$w = array(
								);
							$w['documentTemplateFieldId'] = $v;
							$w['documentControlTypeId'] = $_POST['DocumentTemplate']['documentControlTypeId'][$k];
							$w['documentControlDataId'] = $_POST['DocumentTemplate']['documentControlDataId'][$k];
							$w['documentTypeId'] = $documentTypeId;
							$w['status'] = $_POST['DocumentTemplate']['status'][$k];
							if(isset($_POST['DocumentTemplate']['documentItemField'][$k]) || !empty($_POST['DocumentTemplate']['documentItemField'][$k]))
							{
								$w['documentItemField'] = $_POST['DocumentTemplate']['documentItemField'][$k];
							}
							$w['isItem'] = 0;
							//$this->writeToFile("c:\wamp\www\print", print_r($_POST['DocumentTemplate']['editState'][$k]),true); throw new Exception(111);
							$w['fieldType'] = $_POST['DocumentTemplate']['fieldType'][$k];
							if(isset($_POST['DocumentTemplate']['editState'][$k]))
							{
								$state = $_POST['DocumentTemplate']['editState'][$k];
								$strState = implode(",", $state);
								$w['editState'] = $strState;
							}

							if(isset($_POST['DocumentTemplate']['addState'][$k]))
							{
								$state = $_POST['DocumentTemplate']['addState'][$k];
								$strState2 = implode(",", $state);
								$w['addState'] = $strState2;
							}

							$date_now = new CDbExpression('NOW()');
							$w['createDateTime'] = $date_now;
							$documentTemplate->attributes = $w;
							if(!$documentTemplate->save())
							{
								throw new Exception(111);
								$flag = 0;
							}
						}
					}
					if(isset($_POST['DocumentTemplate']['oldStatus']))
					{
						foreach($_POST['DocumentTemplate']['oldStatus'] as $k=> $v)
						{
							$documentTemplate = DocumentTemplate::model()->find("documentTypeId =:documentTypeId and id =:id", array(
								":documentTypeId"=>$model->documentTypeId,
								":id"=>$k));
							$documentTemplate->status = $v;
							//$documentTemplate->status = $v;
							//$documentTemplate = $model->documentTemplate;
							//throw new Exception($k);
							//$documentTemplate->setAttributes($_POST['DocumentTemplate']);
							//if(!$documentTemplate->saveAttributes(array('status'=>$v)))
							if(!$documentTemplate->save())
							{
								throw new Exception(2222);
								$flag = 0;
							}
						}
					}
					if(isset($_POST['DocumentTemplate']['oldDocumentControlDataId']))
					{
						foreach($_POST['DocumentTemplate']['oldDocumentControlDataId'] as $k=> $v)
						{
							$documentTemplate = DocumentTemplate::model()->find("documentTypeId =:documentTypeId and id =:id", array(
								":documentTypeId"=>$model->documentTypeId,
								":id"=>$k));
							$documentTemplate->documentControlDataId = $v;
							//$documentTemplate->status = $v;
							//$documentTemplate = $model->documentTemplate;
							//throw new Exception($k);
							//$documentTemplate->setAttributes($_POST['DocumentTemplate']);
							//if(!$documentTemplate->saveAttributes(array('status'=>$v)))
							if(!$documentTemplate->save())
							{
								throw new Exception(2222);
								$flag = 0;
							}
						}
					}

					if(isset($_POST['DocumentTemplate']['oldDocumentControlTypeId']))
					{
						foreach($_POST['DocumentTemplate']['oldDocumentControlTypeId'] as $k=> $v)
						{
							$documentTemplate = DocumentTemplate::model()->find("documentTypeId =:documentTypeId and id =:id", array(
								":documentTypeId"=>$model->documentTypeId,
								":id"=>$k));
							$documentTemplate->documentControlTypeId = $v;
							//$documentTemplate->status = $v;
							//$documentTemplate = $model->documentTemplate;
							//throw new Exception($k);
							//$documentTemplate->setAttributes($_POST['DocumentTemplate']);
							//if(!$documentTemplate->saveAttributes(array('status'=>$v)))
							if(!$documentTemplate->save())
							{
								throw new Exception(2222);
								$flag = 0;
							}
						}
					}

					if(isset($_POST['DocumentTemplate']['oldEditState']))
					{
						foreach($_POST['DocumentTemplate']['oldEditState'] as $k=> $v)
						{
							$documentTemplate = DocumentTemplate::model()->find("documentTypeId =:documentTypeId and id =:id", array(
								":documentTypeId"=>$model->documentTypeId,
								":id"=>$k));

							$strState = implode(",", $v);

							//throw new Exception($v);
							//$w = array('editState'=>$v);
							//$documentTemplate->attributes = $w;
							$documentTemplate->editState = $strState;

							//if(!$documentTemplate->saveAttributes(array('status'=>$v)))
							if(!$documentTemplate->save())
							{
								throw new Exception(2222);
								$flag = 0;
							}
						}
					}
					if(isset($_POST['DocumentTemplate']['oldAddState']))
					{
						if(isset($_POST['DocumentTemplate']['oldAddState']))
						{
							foreach($_POST['DocumentTemplate']['oldAddState'] as $k=> $v)
							{
								$documentTemplate = DocumentTemplate::model()->find("documentTypeId =:documentTypeId and id =:id", array(
									":documentTypeId"=>$model->documentTypeId,
									":id"=>$k));

								$strState = implode(",", $v);

								//throw new Exception($v);
								//$w = array('editState'=>$v);
								//$documentTemplate->attributes = $w;
								$documentTemplate->addState = $strState;

								//if(!$documentTemplate->saveAttributes(array('status'=>$v)))
								if(!$documentTemplate->save())
								{
									throw new Exception(2222);
									$flag = 0;
								}
							}
						}
					}

					if(isset($_POST['DocumentTemplate']['oldFieldType']))
					{
						foreach($_POST['DocumentTemplate']['oldFieldType'] as $k=> $v)
						{
							$documentTemplate = DocumentTemplate::model()->find("documentTypeId =:documentTypeId and id =:id", array(
								":documentTypeId"=>$model->documentTypeId,
								":id"=>$k));


							//throw new Exception($v);
							//$w = array('editState'=>$v);
							//$documentTemplate->attributes = $w;
							$documentTemplate->fieldType = $v;

							//if(!$documentTemplate->saveAttributes(array('status'=>$v)))
							if(!$documentTemplate->save())
							{
								throw new Exception(2222);
								$flag = 0;
							}
						}
					}

					foreach($_POST['DocumentTemplate']['items']['documentTemplateFieldId'] as $k=> $v)
					{

						$documentTemplateItem = new DocumentTemplate();
						$r = array(
							);
						//$documentTemplateItem->documentTypeId = $documentTypeId;
						if(!empty($v))
						{
							$r['documentTypeId'] = $documentTypeId;
							//$ii .=  $v.= " - ".$_POST['DocumentTemplate']['items']['documentControlTypeId'][$k].= " - ".$_POST['DocumentTemplate']['items']['documentControlDataId'][$k].= " - ".$_POST['DocumentTemplate']['items']['status'][$k]." || ";
							$r['documentTemplateFieldId'] = $v;
							if(isset($_POST['DocumentTemplate']['items']['documentControlTypeId'][$k]))
							{
								$r['documentControlTypeId'] = $_POST['DocumentTemplate']['items']['documentControlTypeId'][$k];
							}
							if(isset($_POST['DocumentTemplate']['items']['documentControlDataId'][$k]))
							{
								$r['documentControlDataId'] = $_POST['DocumentTemplate']['items']['documentControlDataId'][$k];
							}
							$r['isItem'] = 1;
							if(isset($_POST['DocumentTemplate']['items']['fieldType'][$k]))
							{
								$r['fieldType'] = $_POST['DocumentTemplate']['items']['fieldType'][$k];
							}
							if(isset($_POST['DocumentTemplate']['items']['status'][$k]))
							{
								$r['status'] = $_POST['DocumentTemplate']['items']['status'][$k];
							}
							if(isset($_POST['DocumentTemplate']['items']['documentItemField'][$k]))
							{
								$r['documentItemField'] = $_POST['DocumentTemplate']['items']['documentItemField'][$k];
							}
							if(isset($_POST['DocumentTemplate']['items']['editState'][$k]))
							{
								$state = $_POST['DocumentTemplate']['items']['editState'][$k];
								$strState = implode(",", $state);
								$r['editState'] = $strState;
							}
							$date_now = new CDbExpression('NOW()');
							$r['createDateTime'] = $date_now;
							$documentTemplateItem->attributes = $r;
							if(!$documentTemplateItem->save())
							{
								throw new Exception(4444);
								$flag = 0;
							}
						}
					}
					if($flag)
					{
						//print_r($_POST['DocumentTemplate']['items']);
						$transaction->commit();
						$this->redirect(array(
							'index'));
					}
				}
				else
				{
					throw new Exception(333);
				}
				$transaction->rollback();
				//$this->redirect(array('create'));
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}

		$this->render('update', array(
			'model'=>$model,
			'documentTemplate'=>$documentTemplate,
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
// 		$dataProvider=new CActiveDataProvider('DocumentType');
// 		$this->render('index',array(
// 			'dataProvider'=>$dataProvider,
// 		));

		$model = new DocumentType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocumentType']))
			$model->attributes = $_GET['DocumentType'];

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
// 		if (Yii::app()->file->set('files/test3.txt')->exists)
// 		    echo 'Bingo-bongo!';
// 		else
// 		    echo 'No-no-no.';


		$model = new DocumentType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocumentType']))
			$model->attributes = $_GET['DocumentType'];

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all Field.
	 */
	public function actionManagefield($documentTypeId)
	{
		$documentTypeModel = $this->loadModel($documentTypeId);
		$model = new DocumentType();
		$model = $model->findFieldbyDocumentTypeId($documentTypeId);


		if(!isset($documentTypeModel->documentTemplates))
		{
			$documentTypeModel->documentTemplates = new DocumentTemplate();
		}

		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocumentType']))
			$model->attributes = $_GET['DocumentType'];

		$this->render('manageField', array(
			'model'=>$model,
			'documentTypeModel'=>$documentTypeModel,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = DocumentType::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'document-type-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAddNewField()
	{
		$model = new DocumentTemplateField;
		// Ajax Validation enabled
		$this->performAjaxValidation($model);
		// Flag to know if we will render the form or try to add
		// new jon.
		$flag = true;
		if(isset($_POST['DocumentTemplateField']))
		{
			$flag = false;
			$model->attributes = $_POST['DocumentTemplateField'];
			$date_now = new CDbExpression('NOW()');
			$model->createDateTime = $date_now;
			if($model->save())
			{
				//Return an <option> and select it
				echo CHtml::tag('option', array(
					'value'=>$model->documentTemplateFieldId,
					'selected'=>true), CHtml::encode($model->documentTemplateFieldName), true);
			}
			else
			{
				$flag = true;
			}
		}
		if($flag)
		{
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
			$this->renderPartial('createDialog', array(
				'model'=>$model,), false, true);
		}
	}

	public function actionGetStateByWorkflowGroup()
	{
		if(isset($_POST["groupId"]))
		{
			$groupId = $_POST["groupId"];

			$states = WorkflowState::model()->findAll('workflowGroupId=:groupId group by currentState', array(
				':groupId'=>$groupId));

			echo CHtml::tag('option', array(
				'value'=>-1), CHtml::encode('ไม่แสดงตอนสร้าง'), true);
			echo CHtml::tag('option', array(
				'value'=>0), CHtml::encode('Workflow'), true);
			foreach($states as $item)
			{
				if($item->currentState > 0)
				{
					echo CHtml::tag('option', array(
						'value'=>$item->currentState), CHtml::encode($item->workflowCurrent->workflowName), true);
				}
			}
		}
		else
		{
			echo CHtml::tag('option', array(
				'value'=>'ไม่พบข้อมูล'), CHtml::encode($groupId), true);
		}
	}

	public function selectedDropdown($editStateString)
	{
		if(isset($editStateString))
		{
			$editStateString = explode(",", $editStateString);
		}
		return $editStateString;
	}

}
