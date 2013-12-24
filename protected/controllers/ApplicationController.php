<?php

class ApplicationController extends Controller
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
			array(
				'allow', // allow all users to perform 'index' and 'view' actions
				'actions' => array(
					'index',
					'view'),
				'users' => array(
					'*'),
			),
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array(
					'create',
					'update'),
				'users' => array(
					'@'),
			),
			array(
				'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array(
					'admin',
					'delete'),
				'users' => array(
					'admin'),
			),
			/* array('deny',  // deny all users
			  'users'=>array('*'),
			  ), */
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the id of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$dateNow = new CDbExpression('NOW()');
		$exam = Exam::model()->find("title = 'ใบประเมิณสัมภาษณ์งาน'");
		$appInter = ApplicationInterview::model()->find("applicationId =:id AND managerId =:managerId", array(
			":id" => $id,
			":managerId" => Yii::app()->user->id));
		if (isset($_POST["Exam"]))
		{
			$total = 0;
			$appInterId = null;
			if (isset($_GET["appInterId"]))
			{
				$appInterId = $_GET["appInterId"];
			}
			//Save result in table application_interview_score
			foreach ($_POST["Exam"]["SelectChoice"] as $k => $v)
			{

				$question = ExamQuestion::model()->findByPk($k);
				$score = new ApplicationInterviewScore();
				$score->applicationInterviewId = $appInterId;
				if (isset($_POST["Exam"]["examId"]))
				{
					$score->examId = $_POST["Exam"]["examId"];
				}
				$score->managerId = Yii::app()->user->id;
				$score->questionId = $k;
				$score->questionWeight = $question->weight;
				//$score->choiceId = not thing because question type is range;
				$score->choiceValue = $v;
				$score->status = 1;
				$score->createDateTime = $dateNow;
				if (is_numeric($v))
				{
					$total +=$v * $question->weight;
				}
				if (!$score->save())
				{
					echo "error";
				}
				else
				{
					echo "success";
				}
			}
			//Save result in table application_interview_score
			//save score result in table application_interview
			$appInterview = ApplicationInterview::model()->find("id = :Id ", array(
				":Id" => $appInterId));
			if (isset($appInterview) && count($appInterview) > 0)
			{
				if (isset($appInterview->score))
				{
					// return ว่า ประเมิณแล้ว					
				}
				else
				{
					$appInterview->scoreDateTime = $dateNow;
					$appInterview->score = $total;
					$appInterview->save();
				}
			}
			//save score result in table application_interview

			$this->redirect(array(
				'interview'));
		}
		$this->render('view', array(
			'model' => $model,
			'exam' => $exam,
			'appInter' => $appInter
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new EmployeeInfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['EmployeeInfo']))
		{
			$model->attributes = $_POST['EmployeeInfo'];
			if ($model->save())
				$this->redirect(array(
					'view',
					'id' => $model->id));
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the id of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['EmployeeInfo']))
		{
			$model->attributes = $_POST['EmployeeInfo'];
			if ($model->save())
				$this->redirect(array(
					'view',
					'id' => $model->id));
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the id of the model to be deleted
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
		/*
		  $dataProvider=new CActiveDataProvider('EmployeeInfo');
		  $this->render('index',array(
		  'dataProvider'=>$dataProvider,
		  ));
		 */
		$model = new EmployeeInfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['EmployeeInfo']))
		{
			if (isset($_POST["EmployeeInfo"]["citizenFlag"]))
			{
				if ($_POST["EmployeeInfo"]["citizenFlag"] == 0)
				{
					if (!empty($_POST["EmployeeInfo"]["citizenId"]))
					{
						if ($model->checkIsExistingCitizenId($_POST["EmployeeInfo"]["citizenId"]))
						{
							$model->addError("citizenId", "มีเลขที่บัตรประชาชนในระบบแล้ว");
							$citizenFlag = 0;
						}
						else
						{
							$citizenFlag = 1;
							$model->citizenId = $_POST["EmployeeInfo"]["citizenId"];
						}
					}
					else
					{
						$citizenFlag = 0;
						$model->addError("citizenId", "รูปแบบรหัสบัตรประชาชนไม่ถูกต้อง");
					}
				}
				else
				{
					$citizenFlag = 0;
				}
			}
			else
			{
				$citizenFlag = 1;
				$model->attributes = $_POST['EmployeeInfo'];
				$model->status = EmployeeInfo::STATUS_APP_CREATE;
				if ($model->save())
				{
					$this->redirect(array(
						'admin'));
				}
				else
				{
					$model->accept = 0;
				}
			}
		}
		else
		{
			$citizenFlag = 0;
		}

		$this->render('index', array(
			'model' => $model,
			'citizenFlag' => $citizenFlag
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout = "//layouts/cl2";
		$model = new EmployeeInfo('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['EmployeeInfo']))
			$model->attributes = $_GET['EmployeeInfo'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	public function actionJobInterview()
	{
		$this->layout = "//layouts/cl2";
		$model = new EmployeeInfo('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['EmployeeInfo']))
			$model->attributes = $_GET['EmployeeInfo'];

		$this->render('jobInterview', array(
			'model' => $model,
		));
	}

	public function actionSelectInterviewer($id)
	{
		$application = EmployeeInfo::model()->findByPk($id);
		$oldAppInter = ApplicationInterview::model()->findAll("applicationId =:applicationId", array(
			":applicationId" => $id));
		$applicationInterview = new ApplicationInterview();

		if (isset($_POST["ApplicationInterview"]))
		{
			$flag = true;
			if (!empty($_POST["ApplicationInterview"]["interviewDate"]))
			{

				foreach ($_POST["Employee"]["managerId"] as $k => $v)
				{
					if ($v != '0')
					{
						$appInterview = new ApplicationInterview();
						$appInterview->interviewDate = $_POST["ApplicationInterview"]["interviewDate"];
						if (isset($_POST["EmployeeInfo"]["id"]) && !empty($_POST["EmployeeInfo"]["id"]))
						{
							$appInterview->applicationId = $_POST["EmployeeInfo"]["id"];
						}
						$appInterview->managerId = $v;

						foreach ($_POST["ApplicationInterview"]["isHeadManager"] as $a => $b)
						{
							if (!empty($b))
							{
								if ($b == $v)
								{
									$appInterview->isHeadManager = 1;
								}
								else
								{
									$appInterview->isHeadManager = 0;
								}
							}
						}
						$appInterview->status = EmployeeInfo::STATUS_APP_INTERVIEW;
						if (!$appInterview->save())
						{
							$flag = false;
						}
						else
						{
							$app = EmployeeInfo::model()->find("id=:id", array(
								":id" => $id));
							$app->status = EmployeeInfo::STATUS_APP_INTERVIEW;
							$app->save(false);
						}
					}
				}

				$ceoResult = ApplicationInterview::model()->find("managerId = 1 AND applicationId =:appId", array(
					"appId" => $_POST["EmployeeInfo"]["id"]));
				if (!isset($ceoResult))
				{
					$ceo = new ApplicationInterview();
					$ceo->applicationId = $_POST["EmployeeInfo"]["id"];
					$ceo->interviewDate = "";
					$ceo->managerId = 1;
					$ceo->isHeadManager = 0;
					$ceo->status = EmployeeInfo::STATUS_APP_INTERVIEW;
					$ceo->save();
				}




				if ($flag)
				{
					//----- begin new code --------------------
					if (!empty($_GET['asDialog']))
					{
						//Close the dialog, reset the iframe and update the grid
						echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
						Yii::app()->end();
					}
					else
					{
						$this->redirect(array(
							'admin'));
					}
				}
			}
			else
			{
				if (Yii::app()->request->isAjaxRequest)
				{
					echo CJSON::encode(array(
						'status' => 'remark',
						'div' => "กรุณากรอกเหตุผลเพื่อลบเอกสาร"
					));
					exit;
				}
				else
					$this->redirect(array(
						'admin'));
			}
		}

		//----- begin new code --------------------
		if (!empty($_GET['asDialog']))
		{
			$this->layout = '//layouts/iframe';
		}
		//----- end new code -------------------

		$this->render('_selectInterviewerForm', array(
			'model' => $application,
			'applicationInterview' => $applicationInterview,
			'oldAppInter' => $oldAppInter));
	}

	public function actionInterview()
	{
		$this->layout = "//layouts/cl2";
		$applicationInterview = new ApplicationInterview();
		$this->render('interviewerList', array(
			'model' => $applicationInterview,));
	}

	public function actionWaitSendCeo($id)
	{
		$model = $this->loadModel($id);
		$dateNow = new CDbExpression('NOW()');
		$exam = Exam::model()->find("title = 'ใบประเมิณสัมภาษณ์งาน'");
		$appInter = ApplicationInterview::model()->findAll("applicationId =:id", array(
			":id" => $id));
		if (isset($_POST["ApplicationInterview"]["applicationId"]))
		{
			$applicationId = $_POST["ApplicationInterview"]["applicationId"];
			$empInfo = EmployeeInfo::model()->findByPk($applicationId);
			$empInfo->status = 2;
			if ($empInfo->save(false))
			{
				$appInterView = ApplicationInterview::model()->find("applicationId = :applicationId AND managerId = 1", array(
					":applicationId" => $applicationId));
				$appInterView->status = 2;
				if ($appInterView->save())
				{
					$this->redirect("interview");
				}
			}
		}
		$this->render('waitSendCeo', array(
			'model' => $model,
			'exam' => $exam,
			'appInter' => $appInter,
		));
	}

	public function actionInterviewToCeo()
	{
		$this->layout = "//layouts/cl2";
		$model = new EmployeeInfo('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['EmployeeInfo']))
			$model->attributes = $_GET['EmployeeInfo'];

		$this->render('interviewToCeoList', array(
			'model' => $model,
		));
	}

	public function actionCeo()
	{
		$this->layout = "//layouts/cl2";
		$applicationInterview = new ApplicationInterview();
		$this->render('interviewerList', array(
			'model' => $applicationInterview,));
	}

	public function changeApplicationStatus($statusToChange)
	{
		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the id of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = EmployeeInfo::model()->findByPk($id);
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'employee-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
