<?php

class MemoController extends Controller
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
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$memoToList = null;
		if ($model->createBy == Yii::app()->user->id)
		{
			$memoToList = MemoTo::model()->findAll("memoId =:memoId", array(
				":memoId" => $id));
		}
		else
		{
			$this->employeeIdReadedMemo($id);
		}
		$this->render('view', array(
			'model' => $model,
			'memoToList' => $memoToList
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$dateNow = new CDbExpression('NOW()');
		$model = new Memo;
		$employeeModel = new Employee();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Memo']) && isset($_POST["Employee"]))
		{
			$model->attributes = $_POST['Memo'];
			$image = CUploadedFile::getInstanceByName("Memo[image]");
			if (isset($image) || !empty($image))
			{
				$file_array = explode(".", $image->name);
				$fileType = $file_array[count($file_array) - 1];
				$imageUrl = 'images/document/' . time() . '-' . $this->guid() . "." . $fileType;
				//$imageUrl = 'images/document/'.time().'-'.$image->name;
				$imagePath = '/../' . $imageUrl;
				$v = Yii::app()->baseUrl . '/' . $imageUrl;

				$image->saveAs(Yii::app()->getBasePath() . $imagePath);
			}
			$model->image = isset($v) ? $v : null;
			$model->createBy = Yii::app()->user->id;
			$model->createDateTime = $dateNow;
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$flag = 1;
				//$model->createBy 
				if ($model->save())
				{
					$memoId = Yii::app()->db->lastInsertID;
					foreach ($_POST['Employee']['employeeId'] as $k => $v)
					{
						if (!$v)
							continue;
						$gm['memoId'] = $memoId;
						$gm['employeeId'] = $v;
						$gm['status'] = 1;
						$gm['createDateTime'] = $dateNow;

						$memTo = new MemoTo();
						$memTo->attributes = $gm;

						if (!$memTo->save())
						{
							$flag = 0;
							break;
						}
						else
						{
							$emailController = new EmailSend();
							$website = "http://" . Yii::app()->request->getServerName() . Yii::app()->baseUrl . "/index.php/Memo/view/" . $memoId;
							$createBy = Employee::model()->findByPk(Yii::app()->user->id);
							$emailName = $createBy->username;
							$To = Employee::model()->findByPk($v);
							$toEmail = $To->email . "@daiigroup.com";
							$emailController->mailNewMemo($emailName, $website, $toEmail);
						}
					}
					$memoLog = new MemoLog;
					$memoLog->memoId = $memoId;
					$memoLog->employeeId = Yii::app()->user->id;
					$memoLog->remark = "create memo";
					$memoLog->status = 1;
					$memoLog->createDateTime = $dateNow;
					if (!$memoLog->save())
					{
						$flag = 0;
					}
				}
				else
				{
					$flag = 0;
				}

				if ($flag)
				{

					$transaction->commit();
					$this->redirect(array(
						'outbox'));
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
			'employeeModel' => $employeeModel
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
		$employeeModel = new Employee();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Memo']))
		{
			$model->attributes = $_POST['Memo'];
			if ($model->save())
				$this->redirect(array(
					'admin'));
		}

		$this->render('update', array(
			'model' => $model,
			'employeeModel' => $employeeModel
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
		$dataProvider = new CActiveDataProvider('Memo');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Memo('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Memo']))
			$model->attributes = $_GET['Memo'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	public function actionInbox()
	{
		$model = new Memo('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Memo']))
			$model->attributes = $_GET['Memo'];

		$this->render('inbox', array(
			'model' => $model,
		));
	}

	public function actionOutbox()
	{
		$model = new Memo('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Memo']))
			$model->attributes = $_GET['Memo'];

		$this->render('outbox', array(
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
		$model = Memo::model()->findByPk($id);
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'memo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function employeeIdReadedMemo($memoId)
	{
		$dateNow = new CDbExpression('NOW()');
		$transaction = Yii::app()->db->beginTransaction();
		try
		{
			$flag = 1;
			$memoTo = MemoTo::model()->find("memoId =:memoId AND employeeId =:employeeId", array(
				':memoId' => $memoId,
				':employeeId' => Yii::app()->user->id));
			if (count($memoTo) > 0)
			{
				$memoTo->status = 2;
				$memoTo->updateDateTime = $dateNow;
				if (!$memoTo->save())
				{
					$flag = 0;
				}
				$memoLog = new MemoLog;
				$memoLog->memoId = $memoId;
				$memoLog->employeeId = Yii::app()->user->id;
				$memoLog->remark = "readed memo";
				$memoLog->status = 1;
				$memoLog->createDateTime = $dateNow;
				if (!$memoLog->save())
				{
					$flag = 0;
				}
			}
			else
			{
				$flag = 0;
			}
			if ($flag)
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

	public function checkIsRead($data, $row)
	{
		$memoTo = MemoTo::model()->find("memoId =:memoId AND employeeId = :employeeId", array(
			':memoId' => $data->memoId,
			':employeeId' => Yii::app()->user->id));
		if ($memoTo->status == 1)
		{
			$result = 'ยังไม่ได้อ่าน';
		}
		else
		{
			$result = 'อ่านแล้ว';
		}
		return $result;
	}

	public function guid()
	{
		if (function_exists('com_create_guid'))
		{
			return com_create_guid();
		}
		else
		{
			mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
			$charid = strtoupper(md5(uniqid(rand(), true)));
			$hyphen = chr(45); // "-"
			$uuid = chr(123)// "{"
				. substr($charid, 0, 8) . $hyphen
				. substr($charid, 8, 4) . $hyphen
				. substr($charid, 12, 4) . $hyphen
				. substr($charid, 16, 4) . $hyphen
				. substr($charid, 20, 12)
				. chr(125); // "}"
			return $uuid;
		}
	}

}
