<?php

class EmployeeController extends Controller
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
		$model = new Employee;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employee']))
		{
			$model->attributes = $_POST['Employee'];

			$model->username = $model->genUsername();
			$model->email = $model->genEmail();
			$model->employeeCode = $model->genEmployeeCode();
			$model->password = $model->hashPassword($model->username, $model->employeeCode);
			$model->proDate = $model->genProDate($model->startDate, $_POST['Employee']['isSale']);

			if($model->save())
			{
				$emailController = new EmailSend();
				$website = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/Employee/View/" . Yii::app()->db->lastInsertID;
				$toEmails = array(
					"kamon.p@daiigroup.com"=>1,
					"daii-its@daiigroup.com"=>1,
					"daiichi-hr@daiigroup.com"=>1,
					"daiichi-administration@daiigroup.com"=>0);

				$nameThai = "คุณ" . $model->fnTh . "  " . $model->lnTh;
				$nameEng = $model->fnEn . "  " . $model->lnEn;
				foreach($toEmails as $toEmail=> $canView)
				{
					$emailController->mailNewEmployee($model->employeeCode, $nameThai, $nameEng, $model->position, $model->company->companyNameTh, $website, $canView, $toEmail, $model->username);
				}
				$this->redirect(array(
					'view',
					'id'=>$model->employeeId));
			}
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

		if(isset($_POST['Employee']))
		{
			$model->attributes = $_POST['Employee']; //$this->writeToFile('/tmp/emp', print_r($model->attributes, true));
			if($model->save())
			//$this->redirect(array('view','id'=>$model->employeeId));
				$this->redirect(array(
					'index'));
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
	// public function actionIndex()
	// {
	// $dataProvider=new CActiveDataProvider('Employee');
	// $this->render('index',array(
	// 'dataProvider'=>$dataProvider,
	// ));
	// }

	/**
	 * Manages all models.
	 */
	//public function actionAdmin()
	public function actionIndex()
	{
		$modelName = 'Employee';
		$model = new $modelName('search');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employee']))
		{
			$model->attributes = $_GET['Employee'];
		}

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
		$model = Employee::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	public function loadEmployeeModel($employeeId)
	{
		$model = Employee::model()->find('employeeId=' . $employeeId);
		if($model === NULL)
			throw new CHttpException(404, 'The requested page does not exist.');

		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'employee-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	//Custom
	public function actionMileage($id)
	{
		$model = $this->loadEmployeeModel($id);

		//default start and end of current month
		$startDate = date('Y-m') . '-01';
		$endDate = Controller::lastDateOfThisMonth();

		$dataProvider = Mileage::mileageDailyWithEmployeeId($model->employeeId);

		$this->render('mileage_daily', array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}

	public function actionMileageWithEmployeeId($id)
	{
		$model = $this->loadEmployeeModel($id);

		$dataProvider = Mileage::mileageWithEmployeeId($id, $_GET['createDate']);

		$this->render('mileage', array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}

	public function actionSale()
	{
		$model = new Employee('search');
		$model->unsetAttributes();

		if(isset($_GET['Employee']))
		{
			$model->attributes = $_GET['Employee'];
		}

		$mgr = $this->loadModel(Yii::app()->user->id);
		$emp['Employee']['managerId'] = $mgr->employeeId;
		$emp['Employee']['companyId'] = $mgr->companyId;
		$emp['Employee']['isSale'] = 1;
		$emp['Employee']['status'] = 1;

		$model->attributes = $emp['Employee'];
		$this->render('index', array(
			'model'=>$model,
		));
	}

	public function actionEngineer()
	{
		$model = new Employee('search');
		$model->unsetAttributes();

		if(isset($_GET['Employee']))
		{
			$model->attributes = $_GET['Employee'];
		}

		$mgr = $this->loadModel(Yii::app()->user->id);
		$emp['Employee']['managerId'] = $mgr->employeeId;
		$emp['Employee']['companyId'] = $mgr->companyId;
		$emp['Employee']['isEngineer'] = 1;
		$emp['Employee']['status'] = 1;

		$model->attributes = $emp['Employee'];
		$this->render('index', array(
			'model'=>$model,
		));
	}

	public function isManager($user, $rule)
	{
		if(in_array(strtoupper($user->name), Employee::model()->getAllManager()))
			return true;
		else
			return false;
	}

	public function actionChangePassword()
	{
		$model = new ChangePassword();

		if(isset($_POST['ChangePassword']))
		{
			$employeeModel = Employee::model()->findByPk(Yii::app()->user->id);

			if($employeeModel->password === $employeeModel->hashPassword($employeeModel->username, $_POST['ChangePassword']['oldPassword']))
			{
				if($model->validatePasswordFormat($_POST['ChangePassword']['password']))
				{
					$emp['password'] = $employeeModel->hashPassword($employeeModel->username, $_POST['ChangePassword']['password']);
					$employeeModel->attributes = $emp;

					if($employeeModel->save(false))
					{
						$this->redirect(Yii::app()->createUrl('/home'));
					}
					else
					{
						$model->addError('oldPassword', 'ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่');
					}
				}
				else
				{
					$model->addError('password', 'รหัสผ่านจะต้องมีตัวอักษรพิมพ์ใหญ่อย่างน้อย 1 ตัว ตัวอักษรพิมพ์เล็กอย่างน้อย 1 ตัว  ตัวเลขอย่างน้อย 1 ตัว และความยาวอย่างน้อย 8 ตัวอักษร');
				}
			}
			else
			{
				//error old password
				$model->addError('oldPassword', 'รหัสผ่านเดิมไม่ถูกต้อง');
			}
		}

		$this->render('changePassword', array(
			'model'=>$model));
	}

	//Extension Manage
	public function actionExtension()
	{
		$model = new Employee('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employee']))
		{
			$model->attributes = $_GET['Employee'];
		}

		$this->render('extension', array(
			'model'=>$model,
		));
	}

	public function actionExtensionAdmin()
	{
		$model = new Employee('search');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employee']))
		{
			$model->attributes = $_GET['Employee'];
		}

		$this->render('extensionAdmin', array(
			'model'=>$model,
		));
	}

	public function actionExtensionUpdate($id)
	{
		$model = $this->loadModel($id);

		if(isset($_POST['Employee']))
		{
			$model->attributes = $_POST['Employee']; //$this->writeToFile('/tmp/emp', print_r($model->attributes, true));
			if($model->save(false))
			//$this->redirect(array('view','id'=>$model->employeeId));
				$this->redirect(array(
					'extensionAdmin'));
		}

		$this->render('extensionUpdate', array(
			'model'=>$model,
		));
	}

	public function actionToggleLock($id)
	{
		$model = $this->loadModel($id);
		if($model->status == 1)
		{
			$model->status = 3;
		}
		else if($model->status == 3)
		{
			$model->status = 1;
		}
		if($model->save())
		{
			$this->redirect(array(
				"view",
				"id"=>$id));
		}
	}

	//Extension Manage
}
