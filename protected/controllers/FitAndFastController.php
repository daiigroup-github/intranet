<?php

class FitAndFastController extends Controller
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
			/*
			  array(
			  'allow', // allow all users to perform 'index' and 'view' actions
			  'actions'=>array(
			  'index',
			  'view'),
			  'users'=>array(
			  '*'),
			  ),
			  array(
			  'allow', // allow authenticated user to perform 'create' and 'update' actions
			  'actions'=>array(
			  'create',
			  'update'),
			  'users'=>array(
			  '@'),
			  ),
			  array(
			  'allow', // allow admin user to perform 'admin' and 'delete' actions
			  'actions'=>array(
			  'admin',
			  'delete'),
			  'users'=>array(
			  '@'),
			  ),
			  array(
			  'deny', // deny all users
			  'users'=>array(
			  '*'),
			  ),
			 *
			 */
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
			$model->createDateTime = new CDbExpression('NOW()');
			$model->updateDateTime = new CDbExpression('NOW()');

			if($model->save())
				$this->redirect(array(
					'view',
					'id'=>$model->fitAndFastId));
		}

		$this->render('create', array(
			'model'=>$model,));
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
		/*
		  $dataProvider = new CActiveDataProvider('FitAndFast');
		  $this->render('index', array(
		  'dataProvider'=>$dataProvider,
		  ));
		 *
		 */
		$data = array();
		$i = 0;
		foreach(Company::model()->findAll() as $companyModel)
		{
			$criteria = new CDbCriteria();
			$criteria->condition = 'companyId=:companyId AND status=1';
			$criteria->params = array(
				':companyId'=>$companyModel->companyId);
			$criteria->group = 'companyDivisionId';

			$companyDivisions = Employee::model()->findAll($criteria);

			if(!empty($companyDivisions))
			{
				$data[$i]['name'] = $companyModel->companyNameTh;
				$data[$i]['companyId'] = $companyModel->companyId;
				//echo $companyModel->companyNameTh . '<br />';

				$j = 0;
				foreach($companyDivisions as $c)
				{
					//echo $c->companyDivision->description . '<br />';

					$data[$i]['division'][$j]['name'] = $c->companyDivision->description;
					$data[$i]['division'][$j]['divisionId'] = $c->companyDivision->companyDivisionId;

					$j++;
				}
				//echo '<hr />';
				$i++;
			}
		}

		$this->render('index', array(
			'data'=>$data));
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

	public function actionDivision($id1, $id2) //id1 = companyId, id2 = divisionId
	{
		$companyId = $id1;
		$companyDivisionId = $id2;
		$data = array();
		$i = 0;

		$companyModel = Company::model()->find('companyId=' . $companyId);
		$data['company'] = $companyModel->companyNameTh;

		$companyDivisionModel = CompanyDivision::model()->find('companyDivisionId=' . $companyDivisionId);
		$data['division'] = $companyDivisionModel->description;

		$employeeModels = Employee::model()->findAll(array(
			'condition'=>'companyId=:companyId AND companyDivisionId=:companyDivisionId AND status=1',
			'params'=>array(
				'companyId'=>$companyId,
				'companyDivisionId'=>$companyDivisionId
			)
		));

		foreach($employeeModels as $employeeModel)
		{
			$data['employee'][$i]['name'] = $employeeModel->fnTh . ' ' . $employeeModel->lnTh;
			$data['employee'][$i]['employeeId'] = $employeeModel->employeeId;

			$i++;
		}

		$this->render('division', array(
			'data'=>$data));
	}

	public function actionEmployee($id)
	{
		$fitAndFastModels = FitAndFast::model()->findAll('employeeId=:employeeId', array(
			':employeeId'=>$id));

		$data = array();

		$i = 0;
		foreach($fitAndFastModels as $fitAndFastModel)
		{
			$data[$i]['fitAndFastId'] = $fitAndFastModel->fitAndFastId;
			$data[$i]['title'] = $fitAndFastModel->title;
			$data[$i]['description'] = $fitAndFastModel->description;

			$data[$i]['targetJan'] = $fitAndFastModel->targetJan;
			$data[$i]['actualJan'] = $fitAndFastModel->actualJan;
			$data[$i]['gradeJan'] = $fitAndFastModel->gradeJan;

			$data[$i]['targetFeb'] = $fitAndFastModel->targetFeb;
			$data[$i]['actualFeb'] = $fitAndFastModel->actualFeb;
			$data[$i]['gradeFeb'] = $fitAndFastModel->gradeFeb;

			$data[$i]['targetMar'] = $fitAndFastModel->targetMar;
			$data[$i]['actualMar'] = $fitAndFastModel->actualMar;
			$data[$i]['gradeMar'] = $fitAndFastModel->gradeMar;

			$data[$i]['targetApr'] = $fitAndFastModel->targetApr;
			$data[$i]['actualApr'] = $fitAndFastModel->actualApr;
			$data[$i]['gradeApr'] = $fitAndFastModel->gradeApr;

			$data[$i]['targetMay'] = $fitAndFastModel->targetMay;
			$data[$i]['actualMay'] = $fitAndFastModel->actualMay;
			$data[$i]['gradeMay'] = $fitAndFastModel->gradeMay;

			$data[$i]['targetJun'] = $fitAndFastModel->targetJun;
			$data[$i]['actualJun'] = $fitAndFastModel->actualJun;
			$data[$i]['gradeJun'] = $fitAndFastModel->gradeJun;

			$data[$i]['targetJul'] = $fitAndFastModel->targetJul;
			$data[$i]['actualJul'] = $fitAndFastModel->actualJul;
			$data[$i]['gradeJul'] = $fitAndFastModel->gradeJul;

			$data[$i]['targetAug'] = $fitAndFastModel->targetAug;
			$data[$i]['actualAug'] = $fitAndFastModel->actualAug;
			$data[$i]['gradeAug'] = $fitAndFastModel->gradeAug;

			$data[$i]['targetSep'] = $fitAndFastModel->targetSep;
			$data[$i]['actualSep'] = $fitAndFastModel->actualSep;
			$data[$i]['gradeSep'] = $fitAndFastModel->gradeSep;

			$data[$i]['targetOct'] = $fitAndFastModel->targetOct;
			$data[$i]['actualOct'] = $fitAndFastModel->actualOct;
			$data[$i]['gradeOct'] = $fitAndFastModel->gradeOct;

			$data[$i]['targetNov'] = $fitAndFastModel->targetNov;
			$data[$i]['actualNov'] = $fitAndFastModel->actualNov;
			$data[$i]['gradeNov'] = $fitAndFastModel->gradeNov;

			$data[$i]['targetDec'] = $fitAndFastModel->targetDec;
			$data[$i]['actualDec'] = $fitAndFastModel->actualDec;
			$data[$i]['gradeDec'] = $fitAndFastModel->gradeDec;

			$i++;
		}

		$employeeModel = Employee::model()->findByPk($id);

		$this->render('employee', array(
			'data'=>$data,
			'companyId'=>$employeeModel->companyId,
			'companyDivisionId'=>$employeeModel->companyDivisionId,
			'employeeName'=>$employeeModel->fnTh . ' ' . $employeeModel->lnTh
		));
	}

}
