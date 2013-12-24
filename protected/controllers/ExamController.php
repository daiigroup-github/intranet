<?php

class ExamController extends Controller
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
	  public function accessRules()
	  {
	  return array(
	  array(
	  'allow',
	  // allow all users to perform 'index' and 'view' actions
	  'actions' => array(
	  'index',
	  'view',
	  'addQuestion',
	  'exam'),
	  'users' => array(
	  '@'),
	  ),
	  array(
	  'allow',
	  // allow authenticated user to perform 'create' and 'update' actions
	  'actions' => array(
	  'create',
	  'update'),
	  'users' => array(
	  '@'),
	  ),
	  array(
	  'allow',
	  // allow admin user to perform 'admin' and 'delete' actions
	  'actions' => array(
	  'admin',
	  'delete'),
	  'users' => array(
	  '@'),
	  ),
	  array(
	  'deny', // deny all users
	  'users' => array(
	  '*'),
	  ),
	  );
	  }
	 */

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Exam;
		$examQuestionModel = new ExamQuestion();
		$examChoiceModel = new ExamChoice();

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if (isset($_POST['Exam']) && isset($_POST['ExamQuestion']) && isset($_POST['ExamChoice']))
		{
			$model->attributes = $_POST['Exam'];

			$flag = true;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				if ($model->save())
				{
					$examTitleId = Yii::app()->db->lastInsertID;

					//Question
					foreach ($_POST['ExamQuestion'] as $qId => $examQuestion)
					{
						$examQuestionModel = new ExamQuestion();
						$examQuestionModel->attributes = $examQuestion;

						if (!$examQuestionModel->save())
						{
							$flag = false;
							break;
						}

						$examQuestionId = Yii::app()->db->lastInsertID;

						$examTitleExamQuestionModel = new ExamExamQuestion();
						$examTitleExamQuestionModel->examId = $examTitleId;
						$examTitleExamQuestionModel->examQuestionId = $examQuestionId;

						if (!$examTitleExamQuestionModel->save())
						{
							$flag = false;
							break;
						}

						if ($examQuestion['questionType'] == 2)
							continue;

						//Choice
						foreach ($_POST['ExamChoice'][$qId] as $examChoice)
						{

							$examChoiceModel = new ExamChoice();
							$examChoiceModel->attributes = $examChoice;

							if (!$examChoiceModel->save())
							{
								$flag = false;
								break;
							}

							$examChoiceId = Yii::app()->db->lastInsertID;

							$examQuestionExamChoiceModel = new ExamQuestionExamChoice();
							$examQuestionExamChoiceModel->examQuestionId = $examQuestionId;
							$examQuestionExamChoiceModel->examChoiceId = $examChoiceId;

							if (!$examQuestionExamChoiceModel->save())
							{
								$flag = false;
								break;
							}
						}

						if (!$flag)
							break;
					}
				}
				else
				{
					$flag = false;
				}

				if ($flag)
				{
					$transaction->commit();
					$this->redirect(array(
						'view',
						'id' => $model->examId));
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

		$this->render('create', array(
			'model' => $model,
			'examQuestionModel' => $examQuestionModel,
			'examChoiceModel' => $examChoiceModel,
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

		if (isset($_POST['Exam']))
		{
			$model->attributes = $_POST['Exam'];
			if ($model->save())
				$this->redirect(array(
					'view',
					'id' => $model->examId));
		}

		$this->render('update', array(
			'model' => $model,));
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
		//$dataProvider=new CActiveDataProvider('Exam');
		$model = new Exam('search');
		$this->render('index', array(
			'model' => $model,));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Exam('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['Exam']))
			$model->attributes = $_GET['Exam'];

		$this->render('admin', array(
			'model' => $model,));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = Exam::model()->findByPk($id);
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'exam-title-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAddQuestion()
	{
		if (isset($_POST['ExamQuestion']) && isset($_POST['ExamChoice']))
		{
			$result = true;
			$qId = $_POST['qId'];
			$res = '';
			$errorMsg = '';

			if (empty($_POST['ExamQuestion']['title']))
			{
				$result = false;
				$errorMsg = 'กรุณาใส่คำถาม';
			}
			else
			{
				$res = '<div class="alert alert-info">';
				$res .= '<a href="#" class="close" data-dismiss="alert">×</a>';
				$res .= '<h3>' . $_POST['ExamQuestion']['title'] . '</h3>';
				$res .= '<input type="hidden" name="ExamQuestion[' . $qId . '][title]" value="' . $_POST['ExamQuestion']['title'] . '" />';
				$res .= '<blockquote><small>' . $_POST['ExamQuestion']['description'] . '</small></blockquote>';
				$res .= '<input type="hidden" name="ExamQuestion[' . $qId . '][description]" value="' . $_POST['ExamQuestion']['description'] . '" />';
				$res .= '<input type="hidden" name="ExamQuestion[' . $qId . '][questionType]" value="' . $_POST['ExamQuestion']['questionType'] . '" />';

				$res .= '<ul>';

				if ($_POST['ExamQuestion']['questionType'] == 1) //mutiple choice
				{
					foreach ($_POST['ExamChoice']['title'] as $k => $choices)
					{
						if (empty($_POST['ExamChoice']['title'][$k]) && empty($_POST['ExamChoice']['value'][$k]))
						{
							$result = false;
							$errorMsg = 'กรุณากรอกข้อมูลคำตอบให้ครบถ้วน';
							break;
						}

						$res .= '<li>' . $_POST['ExamChoice']['title'][$k] . ' : ' . $_POST['ExamChoice']['value'][$k];
						$res .= '<input type="hidden" name="ExamChoice[' . $qId . '][' . $k . '][title]" value="' . $_POST['ExamChoice']['title'][$k] . '" />';
						$res .= '<input type="hidden" name="ExamChoice[' . $qId . '][' . $k . '][value]" value="' . $_POST['ExamChoice']['value'][$k] . '" />';
						$res .= '</li>';
					}
				}
				else if ($_POST['ExamQuestion']['questionType'] == 2) //range
				{
					//$this->writeToFile('/tmp/exam', print_r($_POST['ExamQuestion'], true));
					if (empty($_POST['ExamQuestion']['startRange']) || empty($_POST['ExamQuestion']['stopRange']))
					{
						$result = false;
						$errorMsg = 'กรุณากรอกข้อมูลคำตอบให้ครบถ้วน';
					}
					else
					{
						$res .= '<li>Start : ' . $_POST['ExamQuestion']['startRange'] . '</li>';
						$res .= '<li>Stop : ' . $_POST['ExamQuestion']['stopRange'] . '</li>';
						$res .= '<input type="hidden" name="ExamQuestion[' . $qId . '][startRange]" value="' . $_POST['ExamQuestion']['startRange'] . '" />';
						$res .= '<input type="hidden" name="ExamQuestion[' . $qId . '][stopRange]" value="' . $_POST['ExamQuestion']['stopRange'] . '" />';
					}
				}

				$res .= '</ul>';
				$res .= '</div>';
			}

			echo CJSON::encode(array(
				'result' => $result,
				'errorMsg' => $errorMsg,
				'div' => $res,
			));
			Yii::app()->end();
		}

		if (Yii::app()->request->isAjaxRequest)
		{
			$firstShow = $_POST['firstShow'];
			$qId = $_POST['qId'];

			$examQuestionModel = new ExamQuestion();
			$examChoiceModel = new ExamChoice();

			Yii::app()->clientScript->scriptMap['jquery.js'] = false;

			echo CJSON::encode(array(
				'result' => true,
				'div' => $this->renderPartial('_addQuestionForm', array(
					'examQuestionModel' => $examQuestionModel,
					'examChoiceModel' => $examChoiceModel,
					'qId' => $qId,
					), true, $firstShow)
			));

			Yii::app()->end();
		}
	}

	public function actionExam()
	{
		$this->layout = '//layouts/cl1';
		$model = $this->loadModel($_GET['examId']);

		$this->render('exam', array(
			'model' => $model));
	}

}
