<?php

class GroupController extends Controller
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
		$model = new Group;
		$employeeModel = new Employee;
		$groupMemberModel = new GroupMember;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
// 		if(isset($_POST['Group']))
// 		{
// 			$model->attributes=$_POST['Group'];
// 			if($model->save())
// 				$this->redirect(array('view','id'=>$model->groupId));
// 		}

		if (isset($_POST["Group"]) && isset($_POST["Employee"]))
		{
			$model->attributes = $_POST['Group'];
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$flag = 1;
				if ($model->save())
				{
					$groupId = Yii::app()->db->lastInsertID;

					foreach ($_POST['Employee']['employeeId'] as $k => $v)
					{
						if (!$v)
							continue;

						$gm['employeeId'] = $v;
						$gm['groupId'] = $groupId;
						$gm['status'] = 1;

						$groupMemberModel = new GroupMember;
						$groupMemberModel->attributes = $gm;

						if (!$groupMemberModel->save())
						{
							$flag = 0;
							break;
						}
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
						'index',
						'id' => $groupId));
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
			'employeeModel' => $employeeModel,
			'groupMemberModel' => $groupMemberModel,
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
		$employeeModel = new Employee;
		$groupMemberModel = new GroupMember;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST["Group"]) && isset($_POST["Employee"]))
		{
			$transaction = Yii::app()->db->beginTransaction();
			try
			{
				$model->attributes = $_POST['Group'];
				$flag = 1;
				if ($model->save() && $groupMemberModel->deleteAll('groupId=:groupId', array(
						':groupId' => $id)))
				{
					foreach ($_POST['Employee']['employeeId'] as $k => $v)
					{
						if (!$v)
							continue;

						$gm['employeeId'] = $v;
						$gm['groupId'] = $id;
						$gm['status'] = 1;

						$groupMemberModel = new GroupMember;
						$groupMemberModel->attributes = $gm;

						if (!$groupMemberModel->save())
						{
							$flag = 0;
							break;
						}
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
						'index',
						'id' => $id));
				}

				$transaction->rollback();
			}
			catch (Exception $e)
			{
				$transaction->rollback();
			}
		}

		$this->render('update', array(
			'model' => $model,
			'employeeModel' => $employeeModel,
			'groupMemberModel' => $groupMemberModel,
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
// 		$dataProvider=new CActiveDataProvider('Group');
// 		$this->render('index',array(
// 			'dataProvider'=>$dataProvider,
// 		));

		$model = new Group('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Group']))
			$model->attributes = $_GET['Group'];

		$this->render('index', array(
			'model' => $model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Group('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Group']))
			$model->attributes = $_GET['Group'];

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
		$model = Group::model()->findByPk($id);
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
