<?php

class CustomerController extends Controller
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
			'model' => $this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Customer;
		$customerSale = new CustomerSale();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$dateNow = new CDbExpression('NOW()');
		if (isset($_POST['Customer']))
		{
			$model->attributes = $_POST['Customer'];
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$flag = true;
				if ($model->save())
				{
					$customerId = Yii::app()->db->lastInsertID;
					if (isset($_POST["CustomerSale"]["sales"]))
					{
						$saleExistingList = " ";
						foreach ($_POST["CustomerSale"]["sales"] as $sale)
						{
							$customerSale = new CustomerSale();
							$customerSale->customerId = $customerId;
							$customerSale->saleId = $sale;
							$saleModel = Employee::model()->findByPk($sale);
							$checkExistingSaleCompany = CustomerSale::model()->find("customerId = :customerId AND companyValue =:companyValue", array(
								":customerId" => $customerId,
								":companyValue" => $saleModel->company->companyValue));
							$customerSale->companyValue = $saleModel->company->companyValue;
							$customerSale->createDateTime = $dateNow;
							if (!$customerSale->save())
							{
								$flag = false;
							}
							if ($checkExistingSaleCompany)
							{
								$saleExistingList .= " " . $saleModel->username . " ";
								$flag = false;
								$customerSale->addError("saleId", "ผู้แทนขาย" . $saleExistingList . "ซ้ำในบริษัทเดียวกัน");
							}
						}
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
						'id' => $model->customerId));
				}
				else
				{

					$transaction->rollback();
				}
			}
			catch (Exception $ex)
			{
				$transaction->rollback();
				throw new Exception($ex->getMessage());
			}
		}

		$this->render('create', array(
			'model' => $model,
			'customerSale' => $customerSale,
		));
	}

	public function actionMobile()
	{
		$res = array(
			);
		$customer = new Customer();
		$dateNow = date("Y-m-d H:i:s");
		$flag = true;
		$customerId = null;
		$errorMsg = "";

		if (isset($_POST["Customer"]))
		{

			/* send from IPHONE
			 * [Customer] => Array
			  (
			  [customerLnTh] => b
			  [customerCompany] => c
			  [email] => e
			  [phone] => 1234
			  [customerFnTh] => a
			  ) */
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$customer->createDateTime = $dateNow;
				$customer->attributes = $_POST["Customer"];

				if (!$customer->save())
				{
					$flag = false;
					$errorMsg = "ไม่สามารถ บันทึก Customer ได้";
				}
				else
				{
					$customerId = Yii::app()->db->lastInsertID;

					$customerSale = new CustomerSale();
					$customerSale->customerId = $customerId;
					$customerSale->saleId = Yii::app()->user->id;
					$saleModel = Employee::model()->findByPk(Yii::app()->user->id);
					$checkExistingSaleCompany = CustomerSale::model()->find("customerId = :customerId AND companyValue =:companyValue", array(
						":customerId" => $customerId,
						":companyValue" => $saleModel->company->companyValue));
					$customerSale->companyValue = $saleModel->company->companyValue;
					$customerSale->createDateTime = $dateNow;
					if ($checkExistingSaleCompany)
					{
						$saleExistingList .= " " . $saleModel->username . " ";
						$flag = false;
						$errorMsg = "ผู้แทนขาย ซ้ำในบริษัทเดียวกัน";
					}
					if (!$customerSale->save())
					{
						$flag = false;
						$errorMsg = "ไม่สามารถบันทึก Customer Sale ได้";
					}
				}

				if ($flag)
				{
					$transaction->commit();
					$res["result"] = true;
					if (isset($customerId))
					{
						$res["customerId"] = $customerId;
					}
				}
				else
				{
					$res["result"] = false;
					$res["error"] = $errorMsg;
				}
			}
			catch (Exception $ex)
			{
				$transaction->rollback();
				$res["result"] = false;
				$res["error"] = $ex->getMessage();
			}
		}
		else
		{
			$res["error"] = "no detect POST[Customer]";
		}


		$this->jsonEncode($res);
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

		if (isset($_POST['Customer']))
		{
			$model->attributes = $_POST['Customer'];
			if ($model->save())
				$this->redirect(array(
					'view',
					'id' => $model->customerId));
		}
		$customerSale = new CustomerSale();
		$this->render('update', array(
			'model' => $model,
			'customerSale' => $customerSale,
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
// 		$dataProvider=new CActiveDataProvider('Customer');
// 		$this->render('index',array(
// 			'dataProvider'=>$dataProvider,
// 		));

		$model = new Customer('search');
		$model->unsetAttributes();  // clear any default values

		if (isset($_GET['Customer']))
			$model->attributes = $_GET['Customer'];

		$this->render('index', array(
			'model' => $model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Customer('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Customer']))
			$model->attributes = $_GET['Customer'];

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
		$model = Customer::model()->findByPk($id);
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
