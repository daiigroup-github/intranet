<?php

class ManageController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/cl2';

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
				'allow',
				// 'actions'=>array(
				// 	'*'),
				'users'=>array(
					'@'),
				'expression'=>'in_array(Yii::app()->user->name, array("kbw", "nsy", "npr"))',),
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
			array(
				'deny', // deny all users
				'users'=>array(
					'*'),
			),
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
		$model = new FitAndFast;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

		if(isset($_POST['FitAndFast']))
		{
			$model->attributes = $_POST['FitAndFast'];

			$model->statusJan = (isset($_POST['FitAndFast']['targetJan']) && empty($_POST['FitAndFast']['targetJan'])) ? 1 : 0;
			$model->statusFeb = (isset($_POST['FitAndFast']['targetFeb']) && empty($_POST['FitAndFast']['targetFeb'])) ? 1 : 0;
			$model->statusMar = (isset($_POST['FitAndFast']['targetMar']) && empty($_POST['FitAndFast']['targetMar'])) ? 1 : 0;
			$model->statusApr = (isset($_POST['FitAndFast']['targetApr']) && empty($_POST['FitAndFast']['targetApr'])) ? 1 : 0;
			$model->statusMay = (isset($_POST['FitAndFast']['targetMay']) && empty($_POST['FitAndFast']['targetMay'])) ? 1 : 0;
			$model->statusJun = (isset($_POST['FitAndFast']['targetJun']) && empty($_POST['FitAndFast']['targetJun'])) ? 1 : 0;
			$model->statusJul = (isset($_POST['FitAndFast']['targetJul']) && empty($_POST['FitAndFast']['targetJul'])) ? 1 : 0;
			$model->statusAug = (isset($_POST['FitAndFast']['targetAug']) && empty($_POST['FitAndFast']['targetAug'])) ? 1 : 0;
			$model->statusSep = (isset($_POST['FitAndFast']['targetSep']) && empty($_POST['FitAndFast']['targetSep'])) ? 1 : 0;
			$model->statusOct = (isset($_POST['FitAndFast']['targetOct']) && empty($_POST['FitAndFast']['targetOct'])) ? 1 : 0;
			$model->statusNov = (isset($_POST['FitAndFast']['targetNov']) && empty($_POST['FitAndFast']['targetNov'])) ? 1 : 0;
			$model->statusDec = (isset($_POST['FitAndFast']['targetDec']) && empty($_POST['FitAndFast']['targetDec'])) ? 1 : 0;

			if($model->save())
				$this->redirect(array(
					'view',
					'id'=>$model->fitAndFastId));
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

		if(isset($_POST['FitAndFast']))
		{
			$model->attributes = $_POST['FitAndFast'];
			if($model->save())
				$this->redirect(array(
					'view',
					'id'=>$model->fitAndFastId));
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
	 */
	public function actionIndex()
	{
		$model = new FitAndFast('search');

//		if(isset($_GET['year']))
//		{
//			$model->forYear = $_GET['year'];
//		}
//		else
//		{
//			$model->forYear = date('Y');
//		}

		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['FitAndFast']))
		{
			$model->attributes = $_GET['FitAndFast'];
		}
//default show this year
		$model->forYear = (isset($model->forYear) && !empty($model->forYear)) ? $model->forYear : date('Y');

		$this->render('index', array(
			'model'=>$model,));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new FitAndFast('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FitAndFast']))
			$model->attributes = $_GET['FitAndFast'];

		$this->render('admin', array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return FitAndFast the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model = FitAndFast::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param FitAndFast $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'fit-and-fast-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionImport()
	{
		if(isset($_FILES['file']) && !empty($_FILES['file']))
		{
			$lines = file($_FILES['file']['tmp_name']);
			$i = 0;
			$j = 0;
			/*
			  $sumGrade = array(
			  's'=>0,
			  'S'=>0,
			  'SS'=>0,
			  'F'=>0,
			  'percent'=>0);
			 */

			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				foreach($lines as $line_num=> $line)
				{
					if($i > 3)
					{
						$fitfast = explode('|', $line);

						if(isset($fitfast[1]) && !empty($fitfast[1]))
						{
//echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . $fitfast[2] . "<br />\n";
//							echo print_r($fitfast, true) . '<br />';

							$this->writeToFile('/tmp/fitfast', print_r($fitfast, true));

							$employee = Employee::model()->find('employeeCode = ' . $fitfast[1]);

							$model = new FitAndFast;
							$model->employeeId = $employee->employeeId;
							$model->createDateTime = new CDbExpression('NOW()');
							$model->updateDateTime = new CDbExpression('NOW()');
							$model->title = $fitfast[2];
							$model->type = ($fitfast[3] == 'Performance') ? 1 : 2;
							$model->forYear = $fitfast[4];
							$model->targetJan = $fitfast[5];
							$model->statusJan = !empty($fitfast[5]) ? 1 : 0;
							$model->targetFeb = $fitfast[6];
							$model->statusFeb = !empty($fitfast[6]) ? 1 : 0;
							$model->targetMar = $fitfast[7];
							$model->statusMar = !empty($fitfast[7]) ? 1 : 0;
							$model->targetApr = $fitfast[8];
							$model->statusApr = !empty($fitfast[8]) ? 1 : 0;
							$model->targetMay = $fitfast[9];
							$model->statusMay = !empty($fitfast[9]) ? 1 : 0;
							$model->targetJun = $fitfast[10];
							$model->statusJun = !empty($fitfast[10]) ? 1 : 0;
							$model->targetJul = $fitfast[11];
							$model->statusJul = !empty($fitfast[11]) ? 1 : 0;
							$model->targetAug = $fitfast[12];
							$model->statusAug = !empty($fitfast[12]) ? 1 : 0;
							$model->targetSep = $fitfast[13];
							$model->statusSep = !empty($fitfast[13]) ? 1 : 0;
							$model->targetOct = $fitfast[14];
							$model->statusOct = !empty($fitfast[14]) ? 1 : 0;
							$model->targetNov = $fitfast[15];
							$model->statusNov = !empty($fitfast[15]) ? 1 : 0;
							$model->targetDec = $fitfast[16];
							$model->statusDec = !empty($fitfast[16]) ? 1 : 0;
//							$model->sumGrade = serialize($sumGrade);

							if(!$model->save())
							{
								print_r($model->errors);
								$j++;
								break;
							}
						}
					}

					$i++;
				}

				if(!$j)
				{
					$transaction->commit();
					$this->redirect($this->createUrl('index'));
					Yii::app()->end();
				}
				else
				{
					$transaction->rollback();
				}
			}
			catch(Exception $e)
			{
				$transaction->rollback();
				throw new Exception($e->getMessage());
			}
		}
		$this->render('import');
	}

}
