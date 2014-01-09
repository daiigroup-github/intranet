<?php

class ElearningController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/cl1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/* array('allow', // allow admin user to perform 'admin' and 'delete' actions
			  'actions'=>array('*'),
			  'users'=>array('*'),
			  ),
			  array('deny',  // deny all users
			  'users'=>array('*'),
			  ), */
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
		$model = new Elearning('insert');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Elearning']))
		{
			$model->attributes = $_POST['Elearning'];
			$model->createDateTime = new CDbExpression('NOW()');
			$model->updateDateTime = new CDbExpression('NOW()');

			$uploadFile = CUploadedFile::getInstance($model, 'pdfFile');
			if(isset($uploadFile))
			{
				$fileName = uniqid() . '_' . $uploadFile->name;
				$model->pdfFile = '/images/elearning/' . $fileName;
			}
			else
			{
				$model->pdfFile = null;
			}

			if($model->save() && $uploadFile->saveAs(Yii::app()->basePath . '/../images/elearning/' . $fileName))
				;
			$this->redirect(array(
				'view',
				'id'=>$model->elearningId));
		}

		$this->render('create', array(
			'model'=>$model,
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

		if(isset($_POST['Elearning']))
		{
			$model->attributes = $_POST['Elearning'];
			$model->updateDateTime = new CDbExpression('NOW()');
			if($model->save())
				$this->redirect(array(
					'view',
					'id'=>$model->elearningId));
		}

		$this->render('update', array(
			'model'=>$model,
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
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
					'admin'));
	}

	/**
	 * Lists all models.
	  public function actionIndex()
	  {
	  $dataProvider = new CActiveDataProvider('Elearning');
	  $this->render('index', array(
	  'dataProvider' => $dataProvider,
	  ));
	  }
	 */

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new Elearning('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Elearning']))
			$model->attributes = $_GET['Elearning'];

		$this->render('index', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Elearning the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = Elearning::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Elearning $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'elearning-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGenerateExam()
	{
		$this->layout = '//layouts/cl2';
		$elearningExamModel = new ElearningExam;
		$employeeModel = new Employee;

		if(isset($_POST['Employee']) && isset($_POST['ElearningExam']))
		{
			$flag = false;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$i = 0;
				foreach($_POST['Employee']['employeeId'] as $key=> $employeeId)
				{
					$elearningExamModel = new ElearningExam;
					$elearningExamModel->createDateTime = new CDbExpression('NOW()');
					$elearningExamModel->updateDateTime = new CDbExpression('NOW()');
					$elearningExamModel->examDate = $_POST['ElearningExam']['examDate'];
					$elearningExamModel->employeeId = $employeeId;
					$elearningExamModel->createBy = Yii::app()->user->id;

					if(!$elearningExamModel->save())
						$i++;
				}

				if($i == 0)
					$flag = true;

				if($flag)
				{
					$transaction->commit();
					$this->redirect('examByDate');
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				$transaction->rollback();
			}
		}

		$this->render('generateExam', array(
			'employeeModel'=>$employeeModel,
			'elearningExamModel'=>$elearningExamModel));
	}

	public function actionExamByDate()
	{
		$this->layout = '//layouts/cl2';

		$elearningExamModel = new ElearningExam('search');
		$elearningExamModel->unsetAttributes();  // clear any default values
		if(isset($_GET['ElearningExam']))
			$elearningExamModel->attributes = $_GET['ElearningExam'];

		$examDate = ElearningExam::model()->findAll(array(
			'group'=>'examDate'));

		$this->render('examByDate', array(
			'elearningExamModel'=>$elearningExamModel,
			'examDate'=>$examDate));
	}

	/*
	  public function actionAddQuestion()
	  {
	  $models = Elearning::model()->findAll();

	  $flag = false;
	  $transaction = Yii::app()->db->beginTransaction();
	  try
	  {
	  $k = 0;
	  foreach ($models as $key => $model)
	  {
	  for($i=1;$i<=30;$i++)
	  {
	  $questionModel = new ElearningExamQuestion;
	  $questionModel->title = 'Elearning : '.$model->elearningId.' Question '. $i;
	  $questionModel->elearningId = $model->elearningId;

	  if($questionModel->save())
	  {
	  $questionId = Yii::app()->db->getLastInsertId();
	  $isCorrect = rand(1,4);
	  for($j=1;$j<=4;$j++)
	  {
	  $choiceModel = new ElearningExamChoice;
	  $choiceModel->title = 'Elearning : '.$key.' Question : '. $i.' Choice : '.$j;
	  $choiceModel->questionId = $questionId;
	  $choiceModel->isCorrect = ($isCorrect == $j) ? 1 : 0;

	  if(!$choiceModel->save())
	  {
	  $k++;
	  break;
	  }
	  }
	  }
	  if($k>0) break;
	  }
	  }

	  if($k == 0)
	  {
	  $flag = true;
	  }

	  if($flag)
	  {
	  $transaction->commit();
	  }
	  else
	  {
	  $transaction->rollback();
	  }
	  }
	  catch (Exception $e)
	  {
	  throw new Exception($e->getMessage());
	  $transaction->rollback();
	  }
	  }
	 */
}
