<?php

class WorkflowGroupController extends Controller
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
		$model = $this->loadModel($id);

		/* $workflowStateModel = new WorkflowState();
		  $workflowStateModel->workflowGroupId = $id; */
		$workflowStateModel = WorkflowState::model()->getAllStateByWorkflowGroupId($id);
		$this->render('view', array(
			'model' => $model,
			'dataProvider' => $workflowStateModel,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new WorkflowGroup;

		$workflowStateModel = new WorkflowState;
		$workflowStatusModel = new WorkflowStatus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['WorkflowGroup']))
		{
			$model->attributes = $_POST['WorkflowGroup'];
			//if($model->save())
			//$this->redirect(array('view','id'=>$model->workflowGroupId));

			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$flag = true;

				$model->save();
				$workflowGroupId = Yii::app()->db->lastInsertID;

				foreach ($_POST['WorkflowState']['currentState'] as $k => $v)
				{
					$workflowStateModel = new WorkflowState;
					$w = array(
						);

					$w['currentState'] = $v;
					$w['nextState'] = $_POST['WorkflowState']['nextState'][$k];
					$w['workflowStatusId'] = $_POST['WorkflowState']['workflowStatusId'][$k];
					$w['workflowStateName'] = $_POST['WorkflowState']['workflowStateName'][$k];
					$w['requireConfirm'] = $_POST['WorkflowState']['requireConfirm'][$k];
					$w['workflowGroupId'] = $workflowGroupId;

					$workflowStateModel->attributes = $w;

					if (!$workflowStateModel->save())
					{
						$flag = FALSE;
						break;
					}
				}

				if ($flag)
				{
					//print_r($_POST['WorkflowState']);
					$transaction->commit();
					$this->redirect(array(
						'index'));
				}

				$transaction->rollback();
			}
			catch (Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}

		$this->render('create', array(
			'model' => $model,
			'workflowStateModel' => $workflowStateModel,
			'workflowStatusModel' => $workflowStatusModel,
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['WorkflowState']))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$flag = true;
				$w = array(
					);

				foreach ($_POST['WorkflowState']['ordered'] as $k => $v)
				{
					if ($v)
					{
						$workflowStateModel = WorkflowState::model()->findByPk($v);
					}
					else
					{
						$workflowStateModel = new WorkflowState;
						$w['workflowGroupId'] = $id;
					}

					if (!$_POST['WorkflowState']['workflowStateName'][$k])
						break;

					$w['currentState'] = $_POST['WorkflowState']['currentState'][$k];
					$w['nextState'] = $_POST['WorkflowState']['nextState'][$k];
					$w['workflowStatusId'] = $_POST['WorkflowState']['workflowStatusId'][$k];
					$w['workflowStateName'] = $_POST['WorkflowState']['workflowStateName'][$k];
					$w['requireConfirm'] = $_POST['WorkflowState']['requireConfirm'][$k];
					$w['ordered'] = $k;

					$workflowStateModel->attributes = $w;

					if (!$workflowStateModel->save())
					{
						$flag = FALSE;
						break;
					}
				}

				if ($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'index'));
				}

				$transaction->rollback();
			}
			catch (Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}

		$workflowStateModel = new WorkflowState;
		$workflowStatusModel = new WorkflowStatus;

		$this->render('update', array(
			'model' => $model,
			'workflowStateModel' => $workflowStateModel,
			'workflowStatusModel' => $workflowStatusModel,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
						'admin'));
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
// 		$dataProvider=new CActiveDataProvider('WorkflowGroup');
// 		$this->render('index',array(
// 			'dataProvider'=>$dataProvider,
// 		));

		$model = new WorkflowGroup('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['WorkflowGroup']))
			$model->attributes = $_GET['WorkflowGroup'];

		$this->render('index', array(
			'model' => $model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new WorkflowGroup('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['WorkflowGroup']))
			$model->attributes = $_GET['WorkflowGroup'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = WorkflowGroup::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'workflow-group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
