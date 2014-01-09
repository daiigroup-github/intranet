<?php

class StockDetailController extends Controller
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
		$model = new StockDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		//generate MAX CODE
		$max_code = $model->findMaxCode();
		$max_code +=1;
		/* $codeLen = strlen($max_code);
		  $max_code +=1;
		  $len2 = strlen($max_code);
		  $len = $codeLen - $len2;
		  $str = "";
		  for ($i=0;$i<$len;$i++)
		  {
		  $str .= "0";
		  }
		  $model->stockDetailCode = $str .= $max_code; */
		$model->stockDetailCode = str_pad($max_code, 4, "0", STR_PAD_LEFT);
		//generate MAX CODE

		if(isset($_POST['StockDetail']))
		{

			$model->attributes = $_POST['StockDetail'];
			$date_now = new CDbExpression('NOW()');
			$model->createDateTime = $date_now;
			if($model->save())
				$this->redirect(array(
					'index'));
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

		if(isset($_POST['StockDetail']))
		{
			$model->attributes = $_POST['StockDetail'];
			if($model->save())
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
	public function actionOldIndex()
	{
		$dataProvider = new CActiveDataProvider('StockDetail');
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model = new StockDetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StockDetail']))
			$model->attributes = $_GET['StockDetail'];

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
		$model = StockDetail::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'stock-detail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
