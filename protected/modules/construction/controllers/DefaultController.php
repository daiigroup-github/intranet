<?php

class DefaultController extends MasterConstructionController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new ConstructionProject;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['ConstructionProject']))
		{
			$model->attributes = $_POST['ConstructionProject'];
			$model->createDateTime = new CDbExpression('NOW()');
			$model->updateDateTime = new CDbExpression('NOW()');
			if ($model->save())
			{
//				$this->redirect(array('view','id'=>$model->projectId));
//				$_SESSION['project'] = $_POST['ConstructionProject'];
				$this->redirect(array(
					'createProcess',
					'id' => $model->projectId));
			}
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	public function modelAttributes($model, $array)
	{
		$c = array(
			);

		for ($i = 0; $i < sizeof($array); $i++)
		{
			foreach ($model->attributes as $attr => $v)
			{
				if (isset($array[$attr][$i]))
					$c[$i][$attr] = $array[$attr][$i];
			}
		}
		return $c;
	}

	public function actionCreateProcess($id)
	{
		$processModel = new ConstructionProcess;
		$processArray = NULL;

		if (isset($_POST['ConstructionProcess']))
		{
			$processArray = $this->modelAttributes($processModel, $_POST['ConstructionProcess']);
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$flag = true;

				foreach ($processArray as $v)
				{
					$processModel = new ConstructionProcess;
					$v['projectId'] = $id;
					$processModel->attributes = $v;

					if (!$processModel->save())
					{
						$flag = false;
						break;
					}
				}

				if ($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'createProcessSub',
						'id' => $id));
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch (Exception $e)
			{
				//echo $exc->getTraceAsString();
				$transaction->rollback();
			}
		}

		$this->pageHeader = 'Process';
		$this->render('createProcess', array(
			'processModel' => $processModel,
			'processArray' => $processArray));
	}

	public function actionCreateProcessSub($id)
	{
		$processSubModel = new ConstructionProcessSub;
		$this->pageHeader = 'Process Sub';

		$projectModel = ConstructionProject::model()->findByPk($id);

		if (isset($_POST['ConstructionProcessSub']))
			$this->render('createProcessSub', array(
				'projectModel' => $projectModel,
				'processSubModel' => $processSubModel));
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

		if (isset($_POST['ConstructionProject']))
		{
			$model->attributes = $_POST['ConstructionProject'];
			if ($model->save())
				$this->redirect(array(
					'view',
					'id' => $model->projectId));
		}

		$this->pageHeader = 'แก้ไข : ' . $model->name . ' #' . $model->projectId;

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
					'admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
//		$dataProvider=new CActiveDataProvider('ConstructionProject');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
		$model = new ConstructionProject('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ConstructionProject']))
			$model->attributes = $_GET['ConstructionProject'];

		$this->pageHeader = 'Qtech Project';

		$this->render('index', array(
			'model' => $model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new ConstructionProject('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['ConstructionProject']))
			$model->attributes = $_GET['ConstructionProject'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
