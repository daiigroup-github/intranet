<?php

class NoticeController extends Controller
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
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */

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
		$model = new Notice;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Notice']))
		{
			$dateNow = new CDbExpression('NOW()');
			$model->attributes = $_POST['Notice'];
			$model->employeeId = Yii::app()->user->Id;
			$model->createDateTime = $dateNow;
			$model->updateDateTime = $dateNow;

			$image = CUploadedFile::getInstanceByName("Notice[imageUrl]");
			if(!empty($image))
			{
				$imageUrl = 'images/notice/' . time() . '-' . $image->name;
				$imagePath = '/../' . $imageUrl;
				$v = Yii::app()->baseUrl . '/' . $imageUrl;
				$image->saveAs(Yii::app()->getBasePath() . $imagePath);
				$model->imageUrl = $v;
			}


			if($model->save())
				$this->redirect(array(
					'admin'));
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

		if(isset($_POST['Notice']))
		{
			$dateNow = new CDbExpression('NOW()');
			$model->attributes = $_POST['Notice'];
			$model->updateDateTime = $dateNow;

			$image = CUploadedFile::getInstanceByName("Notice[imageUrl]");
			if(!empty($image))
			{
				$imageUrl = 'images/notice/' . time() . '-' . $image->name;
				$imagePath = '/../' . $imageUrl;
				$v = Yii::app()->baseUrl . '/' . $imageUrl;
				$image->saveAs(Yii::app()->getBasePath() . $imagePath);
				$model->imageUrl = $v;
			}
			else
			{
				$oldImage = $_POST["oldImage"];
				$model->imageUrl = $oldImage;
			}

			if($model->save())
				$this->redirect(array(
					'admin'));
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
		/* if(Yii::app()->request->isPostRequest)
		  { */
		// we only allow deletion via POST request
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
					'admin'));
		/* }
		  else
		  throw new CHttpException(400,'Invalid request. Please do not repeat this request again.'); */
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Notice');
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Notice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Notice']))
			$model->attributes = $_GET['Notice'];

		$this->render('admin', array(
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
		$model = Notice::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'notice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
